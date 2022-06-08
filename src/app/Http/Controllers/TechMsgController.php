<?php

namespace App\Http\Controllers;

use App\TechMsg;
use App\Studio;
use App\Description;
use Illuminate\Http\Request;

class TechMsgController extends Controller
{
    public function index()
    {
        $studios = Studio::all();
        $techMsg = TechMsg::all()->sortBy('order');
        $descriptions = Description::all()->sortBy('frequency');
        return view('admin_panel_view.information.tech_msg', compact('techMsg', 'studios', 'descriptions'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'studio_id' => 'required|numeric|max:100',
            'order' => 'required|numeric|max:100',
            'name_ru' => 'required|string|max:100',
            'name_eng' => 'required|string|max:100',
            'description_id' => 'required|string|max:100'
        ]);

        TechMsg::create([
            'studio_id' => trim($request->studio_id),
            'order' => trim($request->order),
            'tech_msg_name_ru' => trim($request->name_ru),
            'tech_msg_name_eng' => trim($request->name_eng),
            'corr_description_id' => trim($request->description_id)
        ]);

        return back();
    }


    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'order' => 'required|numeric|max:100',
            'name_ru' => 'required|string|max:100',
            'name_eng' => 'required|string|max:100',
            'description_id' => 'required|string|max:100'
        ]);

        TechMsg::where('id', $id)->update([
            'order' => trim($request->order),
            'tech_msg_name_ru' => trim($request->name_ru),
            'tech_msg_name_eng' => trim($request->name_eng),
            'corr_description_id' => trim($request->description_id)
        ]);

        return back();
    }


    public function destroy($id)
    {
        TechMsg::find($id)->delete();
        return back();
    }
}
