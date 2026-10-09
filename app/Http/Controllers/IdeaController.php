<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreIdeaRequest;
use App\Models\Idea;
use Auth;
use Illuminate\Http\Request;

class IdeaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        $ideas = Auth::user()->ideas()->when($request->status, function ($query, $status) {
            return $query->where('status', $status);
        })->latest()->get();

        return view('ideas.index', [
            'ideas' => $ideas,
            'statusCounts' => Idea::statusCounts(Auth::user()),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('ideas.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreIdeaRequest $request)
    {
        //
        // dd($request->validated());
        $data = $request->validated();
        Auth::user()->ideas()->create($data);

        return redirect()->route('ideas.index')->with('success', 'successfully created ideas');

    }

    /**
     * Display the specified resource.
     */
    public function show(Idea $idea)
    {
        //
        return view('ideas.show', [
            'idea' => $idea,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Idea $idea)
    {
        //
        return view('ideas.edit', [
            'idea' => $idea,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Idea $idea)
    {
        //
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'status' => 'required|in:pending,in_progress,completed',
        ]);
        $idea->update($request->all());

        return redirect()->route('ideas.index')->with('success', 'successfully edited ');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Idea $idea)
    {
        //
        $idea->delete();

        return redirect()->route('ideas.index')->with('success', 'Idea deleted successfully');
    }
}
