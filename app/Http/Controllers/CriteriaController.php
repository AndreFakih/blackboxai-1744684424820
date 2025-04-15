<?php

namespace App\Http\Controllers;

use App\Models\Criteria;
use Illuminate\Http\Request;

class CriteriaController extends Controller
{
    public function index()
    {
        $criteria = Criteria::all();
        return view('criteria.index', compact('criteria'));
    }

    public function create()
    {
        return view('criteria.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|in:benefit,cost',
            'weight' => 'required|numeric|min:0',
        ]);

        Criteria::create($request->all());

        return redirect()->route('criteria.index')->with('success', 'Criteria created successfully.');
    }

    public function edit(Criteria $criteria)
    {
        return view('criteria.edit', compact('criteria'));
    }

    public function update(Request $request, Criteria $criteria)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|in:benefit,cost',
            'weight' => 'required|numeric|min:0',
        ]);

        $criteria->update($request->all());

        return redirect()->route('criteria.index')->with('success', 'Criteria updated successfully.');
    }

    public function destroy(Criteria $criteria)
    {
        $criteria->delete();

        return redirect()->route('criteria.index')->with('success', 'Criteria deleted successfully.');
    }
}
