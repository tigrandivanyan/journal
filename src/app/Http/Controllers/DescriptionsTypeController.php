<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DescriptionType;


class DescriptionsTypeController extends Controller
{
    public function index()
    {
        $descriptionTypes = DescriptionType::all();
        return view('admin_panel_view.events.descriptions_types', compact('descriptionTypes'));
    }


    public function store(Request $request)
    {
        $this->validate($request, [
            'eng_name' => 'required|string|max:40',
            'ru_name' => 'required|string|max:40',
            'allow_to_edit' => 'required|numeric'
        ]);

        DescriptionType::create([
            'ru_name' => trim($request->ru_name),
            'eng_name' => trim($request->eng_name),
            'allow_to_edit' => $request->allow_to_edit
        ]);
        return back();
    }


    public function update(Request $request)
    {
        $this->validate($request, [
            'type_id' => 'required|numeric',
            'eng_name' => 'required|string|max:40',
            'ru_name' => 'required|string|max:40',
            'allow_to_edit' => 'required|numeric'
        ]);

        DescriptionType::where('id', $request->type_id)->update([
            'ru_name' => trim($request->ru_name),
            'eng_name' => trim($request->eng_name),
            'allow_to_edit' => $request->allow_to_edit
        ]);

        return back();
    }


    public function destroy(Request $request)
    {
        DescriptionType::find($request->type_id)->delete();
        return back();
    }

    public function mailingSettings(){
        $descriptionTypes = DescriptionType::all();
        return view('admin_panel_view.events.descriptions_types_mailing_configuration', compact('descriptionTypes'));
    }

    public function mailingSettingsUpdate(Request $request){
        DescriptionType::where('id', $request->type_id)->update([
            'email' => $request->email
        ]);
        \Session::flash('message', 'Изменения сохранены!');
        return back();
    }
}
