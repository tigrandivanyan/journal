<?php

namespace App\Http\Controllers;

use App\BallJournalEventType;
use Illuminate\Http\Request;
use App\BallJournal;
use App\BallJournalBallCondition;
use App\Studio;
use App\Entrie;
use Illuminate\Support\Facades\Auth;


class BallJournalController extends Controller
{

    public function indexVue(){
        return view('ball_journal_view.index');
    }



























    public function getOneEntryJsonFormat(Request $request)
    {
       $entry = BallJournal::with('type', 'user', 'user.ballTechnician', 'studio','ballCondition')->find($request->entryId);
       return $entry;
    }



    public function checkIfBallSetIsInactive($request){

        $targetedBallSet =  BallJournal::where('ball_set_number', $request->ball_set_number)->latest()->first();

        if(isset($targetedBallSet) && $targetedBallSet->ball_set_status ===  0 ){
            return true;
        }else{
            return false;
        }
    }

    public function index(Request $request, $typeId = null){

        $query =  BallJournal::with('type', 'user', 'user.ballTechnician', 'studio','ballCondition');

        if(isset($request->entry_filter_ball_set_number)){
            $ballSetNumber = $request->entry_filter_ball_set_number;
            $query->where('ball_set_number',$ballSetNumber);

        }elseif(isset($request->entry_filter_event_type)){
            $eventType = $request->entry_filter_event_type;
            $myArray = explode(',', $eventType);
            $query->whereIn('event_type_id',$myArray);

        }elseif(isset($request->entry_filter_time_interval_start) && isset($request->entry_filter_time_interval_end)){
            $timeIntervalStart = $request->entry_filter_time_interval_start;
            $timeIntervalEnd = $request->entry_filter_time_interval_end;
            $query->whereBetween('date', [$timeIntervalStart, $timeIntervalEnd]);

        }elseif(isset($request->entry_filter_studio)){
            $studioName = $request->entry_filter_studio;
            $query->where('studio_id', $studioName);
        }


        if(Auth::check()) {
            $user = Auth::user();
            if ($user->isAn('ball-technician-admin')) {
                $allEntries = $query->orderBy('created_at', 'desc')->paginate(25);
            }else {
                $allEntries = $query->orderBy('created_at', 'desc')->take(10)->get();
            }
        }


        $allAnnouncements =  BallJournal::where('announcement', 1)->latest()->get();
        $allBallConditions =  BallJournalBallCondition::all();
        $allStudios =  Studio::whereIn('id', [1, 6, 7, 9])->get();  // select only studious with balls
        $eventTypes =  BallJournalEventType::all();
        if($typeId){

            $ballJournalEntryOperatorEntryIdArray = BallJournal::where('created_at', '>=', \Carbon\Carbon::now()->subHours(1))
            ->pluck('operator_journal_entrie_id')->toArray();
            $nevArray = array_values($ballJournalEntryOperatorEntryIdArray);
            $nevArray = array_filter($nevArray, function($value) { return $value !== null; });


            $ballJournalEntry = BallJournal::with('type')->find($typeId);
            $operatorJournalEntries = Entrie::with('user','studio','type')
                    ->where('description_type_id', 7)
                    ->where('created_at', '>=', \Carbon\Carbon::now()->subHours(1))
                    ->whereNotIn('id', $nevArray)
                ->get();


            return view('ball_journal_view.layout', compact('allEntries', 'allStudios', 'allBallConditions', 'allAnnouncements', 'eventTypes', 'ballJournalEntry','operatorJournalEntries'));
        }else {
            return view('ball_journal_view.layout', compact('allEntries', 'allStudios', 'allBallConditions', 'allAnnouncements', 'eventTypes'));
        }
    }

    public function removeAnnouncementStatus(Request $request, $id){
        $ballJournalEntry = BallJournal::find($id);
        $ballJournalEntry->update([
            'announcement' => '0'
        ]);
        return back();
    }

    public function completeEventForBallSetChange(Request $request, $id){


        $this->validate($request, [
            'time' => 'required|date_format:H:i',
            'operator_journal_entrie_id' => 'required|integer',
        ]);

        $ballJournalEntry = BallJournal::find($id);
        $ballJournalEntry->update([
            'time' => $request->time,
            'operator_journal_entrie_id'=>$request->operator_journal_entrie_id,
            'entry_completion_status' => 1
        ]);

        return redirect(route('ball-journal-index'));

    }


    public function showTechnicianInstruction(){
        return view('ball_journal_view.partials.technician_instruction');
    }


    public function ballSetChangeStore(Request $request){

       if($this->checkIfBallSetIsInactive($request)){
           return back()->withErrors('Вы выбрали комплект шаров, который сейчас не активен. Вначале поменяйте статус комплекта.');
       }else{

       $this->validate($request, [
            'date' => 'required|date|date_format:Y-m-d',
            'time' => 'date_format:H:i',
            'studio_id' => 'required|integer',
            'event_type_id' => 'required',
            'description' => 'string'
        ]);

        $dataToStore = [
               'ball_technician_id' => auth()->user()->id,
               'date'=>$request->date,
               'studio_id'=>$request->studio_id,
               'ball_set_number'=>$request->ball_set_number,
               'event_type_id'=>$request->event_type_id,
               'description'=>$request->description,
           ];

           if($request->time == ''){
               $dataToStore['time'] = null;
               $dataToStore['entry_completion_status'] = 0;
           }else{
               $dataToStore['time'] = $request->time;
           }

       $createdEntry = BallJournal::create($dataToStore);

           if($request->entry_id){
               BallJournal::find($request->entry_id)->update(['binded_edited_entry_id' => $createdEntry->id]);
           }

        return back();
       }
    }


    public function ballChangeStore(Request $request){

        if($this->checkIfBallSetIsInactive($request)){
            return back()->withErrors('Вы выбрали конплект шаров, который сейчас не активен. Вначале поменяйте статус комплекта.');
        }else{

            $this->validate($request, [
                'studio_id' => 'required|integer',
                'ball_set_number' => 'required|integer',
                'ball_number' => 'required|integer',
                'ball_change_reason' => 'required|integer',
                'event_type_id' => 'required|string'
            ]);


            $createdEntry = BallJournal::create([
                'studio_id'=>$request->studio_id,
                'ball_set_number'=>$request->ball_set_number,
                'ball_number'=>$request->ball_number,
                'ball_change_reason'=>$request->ball_change_reason,
                'ball_technician_id' => auth()->user()->id,
                'event_type_id'=>$request->event_type_id,
                'date'=> date("Y-m-d"),
                'time'=> date("H:i:s"),
            ]);

            if($request->entry_id){
               BallJournal::find($request->entry_id)->update(['binded_edited_entry_id' => $createdEntry->id]);
            }

            return back();

        }
    }




    public function technicalMessageStore(Request $request){

        $this->validate($request, [
            'event_type_id' => 'required',
            'description' => 'required|string'
        ]);


        $createdEntry = BallJournal::create([
            'description'=>$request->description,
            'announcement'=>$request->announcement,
            'ball_technician_id' => auth()->user()->id,
            'event_type_id'=>$request->event_type_id,
            'date'=> date("Y-m-d"),
            'time'=> date("H:i:s"),
        ]);

        if($request->entry_id){
            BallJournal::find($request->entry_id)->update(['binded_edited_entry_id' => $createdEntry->id]);
        }

        return back();
    }

    public function ballSetStatusChangeStore(Request $request){


            $this->validate($request, [
                'studio_id' => 'required|integer',
                'ball_set_number' => 'required|integer',
                'ball_set_status' => 'required|integer',
                'event_type_id' => 'required',
            ]);


            BallJournal::create([
                'studio_id'=>$request->studio_id,
                'ball_set_number'=>$request->ball_set_number,
                'ball_set_status'=>$request->ball_set_status,

                'ball_technician_id' => auth()->user()->id,
                'event_type_id'=>$request->event_type_id,
                'date'=> date("Y-m-d"),
                'time'=> date("H:i:s"),
            ]);

            return back();

    }


    public function ballSetShuffleStore(Request $request){


        $this->validate($request, [
            'event_type_id' => 'required',
            'description' => 'required|string',
        ]);


        BallJournal::create([
            'description'=>$request->description,
            'ball_technician_id' => auth()->user()->id,
            'event_type_id'=>$request->event_type_id,
            'date'=> date("Y-m-d"),
            'time'=> date("H:i:s"),
        ]);

        return back();
    }




}
