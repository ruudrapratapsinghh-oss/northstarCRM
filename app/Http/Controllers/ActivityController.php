<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use Illuminate\Http\Request;

class ActivityController extends Controller
{
    public function index()
    {
        $activities = Activity::latest()->get();
        return view('activities.index', compact('activities'));
    }

    public function create()
    {
        return view('activities.create');
    }

    public function store(Request $request)
    {
        Activity::create($request->all());
        return redirect()->route('activities.index')->with('success', 'Activity Added');
    }

    public function edit($id)
    {
        $activity = Activity::findOrFail($id);
        return view('activities.edit', compact('activity'));
    }

    public function update(Request $request, $id)
    {
        $activity = Activity::findOrFail($id);
        $activity->update($request->all());

        return redirect()->route('activities.index')->with('success', 'Updated');
    }

    public function destroy($id)
    {
        Activity::findOrFail($id)->delete();
        return back()->with('success', 'Deleted');
    }
}