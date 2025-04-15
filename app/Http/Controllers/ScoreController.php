<?php

namespace App\Http\Controllers;

use App\Models\Alternative;
use App\Models\Criteria;
use App\Models\Score;
use Illuminate\Http\Request;
use App\Services\SAWService;

class ScoreController extends Controller
{
    protected $sawService;

    public function __construct(SAWService $sawService)
    {
        $this->sawService = $sawService;
    }

    public function index()
    {
        $alternatives = Alternative::all();
        $criteria = Criteria::all();

        // Load scores grouped by alternative and criteria
        $scores = Score::all()->groupBy('alternative_id');

        return view('scores.index', compact('alternatives', 'criteria', 'scores'));
    }

    public function create()
    {
        $alternatives = Alternative::all();
        $criteria = Criteria::all();

        return view('scores.create', compact('alternatives', 'criteria'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'scores' => 'required|array',
            'scores.*.alternative_id' => 'required|exists:alternatives,id',
            'scores.*.criteria_id' => 'required|exists:criteria,id',
            'scores.*.value' => 'required|numeric|min:0',
        ]);

        foreach ($data['scores'] as $scoreData) {
            Score::updateOrCreate(
                [
                    'alternative_id' => $scoreData['alternative_id'],
                    'criteria_id' => $scoreData['criteria_id'],
                ],
                ['value' => $scoreData['value']]
            );
        }

        // Clear cached ranking after scores update
        $this->sawService->clearCache();

        return redirect()->route('scores.index')->with('success', 'Scores saved successfully.');
    }
}
