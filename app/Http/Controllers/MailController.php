<?php

namespace App\Http\Controllers;

use App\Models\Mail;
use Illuminate\Http\Request;

class MailController extends Controller
{
    public function index(Request $request)
{
    $query = Mail::query();

    if ($request->search) {
        $query->where('subject', 'like', '%' . $request->search . '%')
              ->orWhere('to', 'like', '%' . $request->search . '%');
    }

    $mails = $query->latest()->paginate(5);

    return view('mails.index', compact('mails'));
}

    public function create()
    {
        return view('mails.create');
    }

    public function store(Request $request)
    {
        Mail::create($request->only(['to','subject','message']));
        return redirect()->route('mails.index')->with('success','Mail Saved');
    }

    public function edit($id)
    {
        $mail = Mail::findOrFail($id);
        return view('mails.edit', compact('mail'));
    }

    public function update(Request $request, $id)
    {
        $mail = Mail::findOrFail($id);
        $mail->update($request->only(['to','subject','message']));
        return redirect()->route('mails.index')->with('success','Updated');
    }

    public function destroy($id)
    {
        Mail::findOrFail($id)->delete();
        return back()->with('success','Deleted');
    }
}