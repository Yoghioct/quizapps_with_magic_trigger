<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\Team;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){
        $users = User::all()->count();
        $teams = Team::all()->count();
        $totalScore = Team::sum('total_score');
        $games = Game::all()->count();

        $data = [
            'users' => $users,
            'teams' => $teams,
            'games' => $games,
            'totalScore' => $totalScore,
        ];

        return view('dashboard', $data);

    }
}
