<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\TableTennisGame;
use App\Models\TableTennisStreak;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\User;

class TableTennisController extends Controller
{
    public function index()
    {
        // yesterday date 
        $startDate = date('Y-m-d', strtotime('-1 days'));
        // last 30th (30 days) date from now 
        $endDate = date('Y-m-d', strtotime('-31 days'));

        $score_list = TableTennisGame::select(['id', 'user_1_id', 'user_1_score', 'user_2_id', 'user_2_score', 'win_margin'])
            ->with('user1', 'user2')->orderByDesc('win_margin')->whereDate('created_at', '>', $endDate)->get();

        $longest_streak = TableTennisStreak::with('user1', 'user2')->orderByDesc('streak')->get();

        return response()->json(['success' => true, 'error' => null, 'body' => ['tableTennis_games' => $score_list, 'longest_streak' => $longest_streak]]);
    }


    public function save(Request $request)
    {
        $user_1 = User::find($request->user()->id);
        $user_2 = User::find($request->user_2_id);
        if (!$user_1) {
            return response()->json(['success' => false, 'error' => "User 1 Not found", 'body' => []]);
        }
        if (!$user_2) {
            return response()->json(['success' => false, 'error' => "User 2 Not found", 'body' => []]);
        }
        if ($request->user()->id == $request->user_2_id) {
            return response()->json(['success' => false, 'error' => "Users should be different", 'body' => []]);
        }
        $validator = Validator::make($request->all(), [
            'user_2_id' => 'required',
            'user_1_score' => 'required',
            'user_2_score' => 'required',
        ]);

        $record = TableTennisGame::where('user_1_id', $request->user()->id)->where('user_2_id', $request->user_2_id)->get();
        if ($validator->passes()) {
            $margin = $request->user_1_score - $request->user_2_score;
            $win_margin = explode('-', $margin);

            $game_date = [
                'user_1_id' => $request->user()->id,
                'user_2_id' => $request->user_2_id,
                'user_1_score' => $request->user_1_score,
                'user_2_score' => $request->user_2_score,
                'win_margin' => last($win_margin),
            ];

            if (isset($request->id)) {
                $game_date['updated_by'] = Auth::user()->id;
                TableTennisGame::where('id', $request->id)->update($game_date);
            } else {
                $game_date['created_by'] = Auth::user()->id;
                TableTennisGame::create($game_date);

                $streakUpdate = TableTennisStreak::where([
                    ['user_1_id', '=', $request->user()->id],
                    ['user_2_id', '=', $request->user_2_id]
                ])->orwhere([
                    ['user_2_id', '=', $request->user()->id],
                    ['user_1_id', '=', $request->user_2_id]
                ])->get();

                if (count($record) < 1 && count($streakUpdate) < 1) {

                    if ($request->user_1_score > $request->user_2_score) {
                        $streak = [
                            'user_1_wins' => 1,
                            'user_2_wins' => 0,
                        ];
                    }

                    if ($request->user_1_score < $request->user_2_score) {
                        $streak = [
                            'user_1_wins' => 0,
                            'user_2_wins' => 1,
                        ];
                    }

                    $streak['user_1_id'] = $request->user()->id;
                    $streak['user_2_id'] = $request->user_2_id;
                    $streak['streak'] = 1;

                    TableTennisStreak::create($streak);
                } else {

                    $streakData = TableTennisStreak::where([
                        ['user_1_id', '=', $request->user()->id],
                        ['user_2_id', '=', $request->user_2_id]
                    ])->orwhere([
                        ['user_2_id', '=', $request->user()->id],
                        ['user_1_id', '=', $request->user_2_id]
                    ])->get();

                    if (($request->user_1_score > $request->user_2_score) && ($streakData->first()->user_1_id == $request->user()->id)) {
                        $streak['user_1_wins'] = $streakData->first()->user_1_wins + 1;
                    }
                    if (($request->user_2_score > $request->user_1_score) && ($streakData->first()->user_1_id == $request->user_2_id)) {
                        $streak['user_1_wins'] = $streakData->first()->user_1_wins + 1;
                    }

                    if (($request->user_2_score < $request->user_1_score) && ($streakData->first()->user_2_id == $request->user()->id)) {
                        $streak['user_2_wins'] = $streakData->first()->user_2_wins + 1;
                    }
                    if (($request->user_1_score < $request->user_2_score) && ($streakData->first()->user_2_id == $request->user_2_id)) {
                        $streak['user_2_wins'] = $streakData->first()->user_2_wins + 1;
                    }

                    TableTennisStreak::where([
                        ['user_1_id', '=', $request->user()->id],
                        ['user_2_id', '=', $request->user_2_id]
                    ])->orwhere([
                        ['user_2_id', '=', $request->user()->id],
                        ['user_1_id', '=', $request->user_2_id]
                    ])->update($streak);

                    $updateStreak = TableTennisStreak::where([
                        ['user_1_id', '=', $request->user()->id],
                        ['user_2_id', '=', $request->user_2_id]
                    ])->orwhere([
                        ['user_2_id', '=', $request->user()->id],
                        ['user_1_id', '=', $request->user_2_id]
                    ])->get();
                    $diff = $updateStreak->first()->user_1_wins - $updateStreak->first()->user_2_wins;
                    $win_streak = explode('-', $diff);

                    TableTennisStreak::where([
                        ['user_1_id', '=', $request->user()->id],
                        ['user_2_id', '=', $request->user_2_id]
                    ])->orwhere([
                        ['user_2_id', '=', $request->user()->id],
                        ['user_1_id', '=', $request->user_2_id]
                    ])->update([
                        'streak' => last($win_streak)
                    ]);
                }

                return response()->json(['success' => true, 'error' => null, 'body' => ['message' => 'Score Added Successfully']]);
            }
        } else {
            return response()->json(['success' => false, 'error' => $validator->errors(), 'body' => []]);
        }
    }
}
