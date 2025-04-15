<?php

namespace App\Http\Controllers;

use App\Models\Alternative;
use Illuminate\Http\Request;

class AlternativeController extends Controller
{
    public function index()
    {
        $alternatives = Alternative::all();
        return view('alternatives.index', compact('alternatives'));
    }

    public function create()
    {
        return view('alternatives.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        Alternative::create($request->all());

        return redirect()->route('alternatives.index')->with('success', 'Alternative created successfully.');
    }

    public function edit(Alternative $alternative)
    {
        return view('alternatives.edit', compact('alternative'));
    }

    public function update(Request $request, Alternative $alternative)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $alternative->update($request->all());

        return redirect()->route('alternatives.index')->with('success', 'Alternative updated successfully.');
    }

    public function destroy(Alternative $alternative)
    {
        $alternative->delete();

        return redirect()->route('alternatives.index')->with('success', 'Alternative deleted successfully.');
    }
}
