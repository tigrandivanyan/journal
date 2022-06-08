<?php

namespace App\Http\Controllers;

use App\Events\TimeBreakAdded;
use App\Events\TimeBreakRemoved;
use App\Operator;
use App\Services\TimeBreaks\TimeBreakFactory;
use App\Studio;
use App\TimeBreak as TimeBreakDb;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TimeBreakController extends Controller
{
    public function partialIndex($studioName)
    {
        $studios = \App\Studio::orderBy('order')->get();
        $studiosWithTimeBreak = [];
        foreach ($studios as $studio) {
            $studiosWithTimeBreak[] = (object)[
                'id' => $studio->id,
                'name' => $studio->name_ru,
                'operators_inside' => $studio->getOperatorsInsideAttribute(),
                'chefs_inside' => $studio->getChefsInsideAttribute()
            ];
        }
        return view('partial.time-break', compact('studiosWithTimeBreak', 'studioName'));
    }

    /**
     * "Занять"
     * @param Request $request
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function store(Request $request, $studioName)
    {
        //todo: remove user cannot add timebreak
        return redirect()->back();

        //@todo: add some rules
        $this->validate($request, [
            'studio' => 'required',
            'timeStart' => 'required',
        ]);

        if ($timeStart = $request->get('timeStart')) {
            $timeStart = new Carbon($timeStart);
        }
        $studio = Studio::where('name_eng', $studioName)->first();
        $operator = auth()->user();
        if (!$operator) {
            return redirect()->back()->withErrors(['Вы не выбрали оператора']);
        }
        $timeBreak = new TimeBreakDb([
            'studio' => $studio->name_eng,
            'start' => $timeStart,
            'end' => $timeStart->copy()->addMinutes(15)
        ]);
        $timeBreak->operator()->associate($operator);
        $timeBreak->studio()->associate($studio);
        //@todo: check if time is free
        $timeBreak->save();
        event(new TimeBreakAdded($timeBreak));
        return redirect()->back();
    }
    public function destroy(Request $request, $studioName, $id)
    {
        //todo: remove user cannot add timebreak
        return redirect()->back();
        //@todo: check permissions
        $timeBreak = TimeBreakDb::find($id);
        if ($timeBreak && !$timeBreak->started) {
            event(new TimeBreakRemoved($timeBreak));
            $timeBreak->delete();
        } else {
            return redirect()->back()->withErrors(['Вы не можете удалить начатую запись']);
        }
        return redirect()->back();
    }
}
