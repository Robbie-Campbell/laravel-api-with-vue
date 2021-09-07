<?php

namespace App\Http\Controllers;

use App\Models\Game;
use Illuminate\Http\Request;

class GameController extends Controller
{

    public function index()
    {
        return Game::all();
    }

    public function store(Request $request)
    {
        $game = Game::create($this->validateRequest());
        if ($request->image) {
            $fileName = $request->file('image')->store('/public');
            $game->image = "storage/" . explode("/", $fileName)[1];
        }
        else {
            $game->image = null;
        }
        $game->save();
        return ['message' => 'Post Created'];
    }

    public function show($id)
    {
        $game = Game::find($id);

        return empty($game) ? 'No Game found with that id' : $game;
    }

    public function update(Request $request, $id)
    {
        $game = Game::find($id);
        $game->title = $request->input('title');
        $game->description = $request->input('description');
        $game->image = $request->input('image');
        $game->save();
        return $game;
    }

    public function destroy($id)
    {
        $game = Game::find($id);
        $game->delete();
        return $game;
    }

    private function validateRequest() : array{
        return request()->validate([
            'title' => 'required',
            'description' => 'required'
        ]);
    }
}
