<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Description;
use App\DescriptionType;
use App\Studio;

class DescriptionController extends Controller
{
    public function index()
    {
        $descriptions = Description::all()->sortBy('frequency');
        $studios = Studio::all();
        $descriptionTypes = DescriptionType::all();

        return view('admin_panel_view.events.descriptions', compact('descriptions', 'studios', 'descriptionTypes'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'frequency' => 'required|numeric|max:100',
            'type_id' => 'required|string|max:100',
            'text' => 'required|string',
            'studio_id' => 'required|string|max:100'
        ]);

        //Description::create($request->only(['frequency','type_id','text','studio_id']));

        Description::create([
            'frequency' => trim($request->frequency),
            'studio_id' => trim($request->studio_id),
            'type_id' => trim($request->type_id),
            'text' => trim($request->text)
        ]);

        return back();
    }


    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'frequency' => 'required|numeric|max:100',
            'type_id' => 'required|string|max:100',
            'text' => 'required|string'
        ]);

        Description::where('id', $id)->update([
            'frequency' => trim($request->frequency),
            'type_id' => trim($request->type_id),
            'text' => trim($request->text)
        ]);

        return back();
    }


    public function destroy($id)
    {
        Description::find($id)->delete();
        return back();
    }
}
