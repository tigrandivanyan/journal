<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Information;

class InformationController extends Controller
{
    public function techInstruction()
    {
        return view('admin_panel_view.information.tech-instruction');
    }


    public function instruction()
    {
        $instruction = Information::where('name', 'instruction')->first();
        return view('admin_panel_view.information.instruction', compact('instruction'));
    }

    public function updateInstruction(Request $request)
    {
        $this->validate(request(), [
            'content' => 'required|string'
        ]);

        Information::where('name', 'instruction')->update([
            'content' => $request->get('content')
        ]);
        \Cache::forget('journalViewData.information');

        return back()->withErrors(['Изменения сохранены']);
    }


    public function notification()
    {
        $notification = Information::where('name', 'notification')->first();
        return view('admin_panel_view.information.notification', compact('notification'));
    }


    public function updateNotification(Request $request)
    {
        $this->validate(request(), [
            'content' => 'string',
            'expiration' => 'date'
        ]);

        Information::where('name', 'notification')->update([
            'content' => $request->get('content'),
            'expiration' => $request->expiration
        ]);
        \Cache::forget('journalViewData.information');

        return back()->withErrors(['Изменения сохранены']);
    }


    public function notice()
    {
        $notice = Information::where('name', 'notice')->first();
        return view('admin_panel_view.information.notice', compact('notice'));
    }


    public function updateNotice(Request $request)
    {
        $this->validate(request(), [
            'content' => 'string'
        ]);

        Information::where('name', 'notice')->update([
            'content' => $request->get('content')
        ]);
        \Cache::forget('journalViewData.information');

        return back()->withErrors(['Изменения сохранены']);
    }
}
