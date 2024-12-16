<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\Score;
use App\Models\Team;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PhpParser\Node\Expr\FuncCall;

class ScoreController extends Controller
{
    public function index(){
        $teams = Team::all();
        $games = Game::all();

        $data = [
            'teams' => $teams,
            'games' => $games,
        ];

        return view('score', $data);

    }

    public function store(Request $request)
    {
        $request->validate([
            'team_id' => 'required|exists:teams,id',
            'game_id' => 'required|exists:games,id',
            'score' => 'required|integer',
        ]);

        Score::create([
            'team_id' => $request->team_id,
            'game_id' => $request->game_id,
            'score' => $request->score,
            'updated_by' => Auth::id(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        return redirect()->back()->with('success', 'Score added successfully!');
    }

    public function data(){
        $scores = Score::with(['team', 'game', 'user'])->get();

        $data = [
            'scores' => $scores,
        ];

        return view('data-score', $data);
    }

    public function destroy($id)
    {
        $score = Score::findOrFail($id);
        $score->delete();

        return redirect()->route('data-score')->with('success', 'Score deleted successfully!');
    }

    public function edit($id)
    {
        $score = Score::with(['team', 'game', 'user'])->findOrFail($id);
        $teams = Team::all();
        $games = Game::all();

        $data = [
            'score' => $score,
            'teams' => $teams,
            'games' => $games,
        ];

        return view('edit-score', $data);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'score' => 'required|integer',
        ]);

        $score = Score::findOrFail($id);
        $score->update([
            'score' => $request->score,
            'updated_by' => Auth::id(),
            'updated_at' => Carbon::now(),
        ]);

        return redirect()->route('data-score')->with('success', 'Score updated successfully!');
    }

}
