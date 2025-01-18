<?php

namespace App\Http\Controllers;

use App\Models\Team;
use Illuminate\Http\Request;

use function Pest\Laravel\json;

class LeaderboardController extends Controller
{
    public function index(){
        $teams = Team::orderBy('total_score', 'desc')->get();

        $data = [
            'teams' => $teams
        ];

        return view('leaderboard', $data);
    }

    public function leaderboard(){
        $teams = Team::orderBy('total_score', 'desc')->get();

        $data = [
            'teams' => $teams
        ];

        return view('leaderboard-score', $data);
    }

    public function detail($id)
    {
        $team = Team::with(['scores.game'])->find($id);

        if (!$team) {
            return response()->json(['message' => 'Team not found'], 404);
        }

        $scores = $team->scores->map(function ($score) {
            return [
                'game_id' => $score->game->id,
                'game_name' => $score->game->name,
                'score' => $score->score,
            ];
        });

        $data = [
            'id' => $team->id,
            'name' => $team->name,
            'total_score' => $team->total_score,
            'scores' => $scores,
        ];

        return response()->json($data, 200);
    }
}
