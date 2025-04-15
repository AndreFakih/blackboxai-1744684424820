<?php

namespace App\Services;

use App\Models\Alternative;
use App\Models\Criteria;
use App\Models\Score;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Collection;

class SAWService
{
    /**
     * Calculate the SAW ranking for all alternatives.
     *
     * @return array
     *
     * Manual Calculation Example:
     * Suppose we have 3 criteria with weights: C1=0.5 (benefit), C2=0.3 (cost), C3=0.2 (benefit)
     * Alternatives A1 and A2 with scores:
     * A1: C1=80, C2=200, C3=90
     * A2: C1=70, C2=150, C3=95
     *
     * Step 1: Normalize scores
     * For benefit criteria: normalized = score / max_score
     * For cost criteria: normalized = min_score / score
     *
     * Step 2: Multiply normalized scores by weights and sum
     *
     * Step 3: Rank alternatives by total score descending
     */
    public function calculateRanking(): array
    {
        // Check cache first
        if (Cache::has('saw_ranking')) {
            return Cache::get('saw_ranking');
        }

        $criteria = Criteria::all();
        $alternatives = Alternative::all();

        if ($criteria->isEmpty() || $alternatives->isEmpty()) {
            throw new \Exception('Criteria or alternatives data is incomplete.');
        }

        // Prepare max and min values for normalization
        $maxValues = [];
        $minValues = [];

        foreach ($criteria as $criterion) {
            $scores = Score::where('criteria_id', $criterion->id)->pluck('value');
            if ($scores->isEmpty()) {
                throw new \Exception("Scores for criterion '{$criterion->name}' are missing.");
            }
            $maxValues[$criterion->id] = $scores->max();
            $minValues[$criterion->id] = $scores->min();
        }

        // Calculate normalized scores and total scores
        $results = [];

        foreach ($alternatives as $alternative) {
            $totalScore = 0;
            foreach ($criteria as $criterion) {
                $score = Score::where('alternative_id', $alternative->id)
                    ->where('criteria_id', $criterion->id)
                    ->value('value');

                if (is_null($score)) {
                    throw new \Exception("Score for alternative '{$alternative->name}' and criterion '{$criterion->name}' is missing.");
                }

                if ($criterion->type === 'benefit') {
                    $normalized = $score / $maxValues[$criterion->id];
                } else { // cost
                    $normalized = $minValues[$criterion->id] / $score;
                }

                $totalScore += $normalized * $criterion->weight;
            }
            $results[] = [
                'alternative' => $alternative->name,
                'score' => round($totalScore, 4),
            ];
        }

        // Sort descending by score
        usort($results, function ($a, $b) {
            return $b['score'] <=> $a['score'];
        });

        // Cache the results for 10 minutes
        Cache::put('saw_ranking', $results, 600);

        return $results;
    }

    /**
     * Clear the cached ranking.
     */
    public function clearCache(): void
    {
        Cache::forget('saw_ranking');
    }
}
