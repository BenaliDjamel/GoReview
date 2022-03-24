<?php

namespace App\Http\Controllers;

use App\Models\Like;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    public function store(Request $request, $id)
    {
        $like = new Like();
        $like->user_id = $request->user()->id;
        $like->review_id = $id;

        $like->save();

        return redirect()->back();
    }

    public function delete(Request $request, $id)
    {
        $like = Like::where([
            ['user_id',  $request->user()->id],
            ['review_id', $id],
        ])->first();

        $like->delete();

        return redirect()->back();
    }
}
