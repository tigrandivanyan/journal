<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Entrie;
use App\Email;
use Mail;

class EmailController extends Controller
{
    public function index()
    {
        $emails = Email::all();
        return view('admin_panel_view.email.email_list', compact('emails'));
    }


    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:40',
            'email' => 'required|email|max:40'
        ]);

        if ($request->status && $request->status == 1) {
            $status = 1;
        } else {
            $status = 0;
        }

        Email::create([
            'name' => trim($request->name),
            'email' => trim($request->email),
            'status' => $status
        ]);

        return back();
    }


    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|string|max:40',
            'email' => 'required|email|max:40'
        ]);

        if ($request->status && $request->status == 1) {
            $status = 1;
        } else {
            $status = 0;
        }

        Email::where('id', $id)->update([
            'name' => trim($request->name),
            'email' => trim($request->email),
            'status' => $status
        ]);

        return back();
    }


    public function destroy($id)
    {
        Email::find($id)->delete();
        return back();
    }


}
