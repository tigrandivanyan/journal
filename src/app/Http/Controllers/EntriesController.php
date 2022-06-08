<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \Carbon\Carbon;

use App\Entrie;
use App\DescriptionType;


use App\Http\Requests\Entry\EntryStoreRequest;
use App\Http\Requests\Entry\EntryUpdateRequest;

use App\Repositories\EntryRepository;


class EntriesController extends Controller
{


    public function store(EntryStoreRequest $request)  // store new entry to DB
    {
        $result = $request->persist();
        return $result ? back() : back()->withErrors('Произошла ошибка, повторите попытку!');
    }


    public function update(EntryUpdateRequest $request)  // update entry
    {
        $result = $request->persist();
        return $result ? back() : back()->withErrors('Произошла ошибка, повторите попытку!');
    }


    public function unalertEntry($studioName, Entrie $entrie)
    {
        $entrie->update(['announcement_del' => Carbon::now(), 'announcement' => 0 ]);
        return redirect()->route('studio.filter', $studioName);
    }


    public function filter(EntryRepository $entryRepository, Request $request, $studioName)
    {
       return $entryRepository->filter($request, $studioName);
    }



    public function api_entry_types_for_filtering(){
        $eventTypes =  DescriptionType::all();
        return $eventTypes;
    }


    public function showInBackend(Request $request, $studio)
    {// :todo this one too ust be changet to the occurred to

        $firstEntryDate = Entrie::where('studio_id', $studio)->oldest()->pluck('occurred_at')->first(); // needed to limit filtering dates in view(date:from)

        $query = Entrie::where('studio_id', $studio);

        if($request->input('entry_filter_event_type')){
            $eventType = $request->entry_filter_event_type;
            $myArray = explode(',', $eventType);
            $query->whereIn('description_type_id',$myArray);

        }elseif(isset($request->entry_filter_time_interval_start) && isset($request->entry_filter_time_interval_end)) {
            $timeIntervalStart = $request->entry_filter_time_interval_start;
            $timeIntervalEnd = $request->entry_filter_time_interval_end;
            $query->whereBetween('occurred_at', [$timeIntervalStart, $timeIntervalEnd]);
        }

        $entries = $query->latest()->paginate(20);

        $eventTypes =  DescriptionType::all();
        return view('admin_panel_view.events.entries', compact('entries', 'eventTypes', 'studio', 'firstEntryDate'));
    }



    /**
     *  display one particular entry in separate view
     *  should be available for unsigned users
     *  should be used by bingo-boom tech support
     *  currently is not in use
     *  only display the view
     */
    public function showOneEntryDisplayView(){
        return view('main_view.entry.show_one_entry.show_one_entry');
    }

    /**
     *  display one particular entry in separate view
     *  should be available for unsigned users
     *  should be used by bingo-boom tech support
     *  currently is not in use
     *  retrieves object of the entry or null, if the entry not found
     */
   public function showOneEntryGetObject(EntryRepository $entryRepository, $entryId){
       return $entryRepository->showOneEntry($entryId);
    }




}
