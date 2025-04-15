<?php

namespace App\Http\Controllers;

use App\Services\SAWService;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class RankingController extends Controller
{
    protected $sawService;

    public function __construct(SAWService $sawService)
    {
        $this->sawService = $sawService;
    }

    public function index()
    {
        try {
            $ranking = $this->sawService->calculateRanking();
        } catch (\Exception $e) {
            return redirect()->back()->withErrors($e->getMessage());
        }

        return view('ranking.index', compact('ranking'));
    }

    public function exportPdf()
    {
        try {
            $ranking = $this->sawService->calculateRanking();
        } catch (\Exception $e) {
            return redirect()->back()->withErrors($e->getMessage());
        }

        $pdf = Pdf::loadView('ranking.pdf', compact('ranking'));
        return $pdf->download('ranking.pdf');
    }
}
