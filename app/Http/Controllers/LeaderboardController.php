<?php

namespace App\Http\Controllers;

use App\Models\Team;
use Illuminate\Http\Request;

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
}
