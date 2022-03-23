<?php

namespace App\Http\Controllers;
use App\Models\Request as RequestModel;

use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    
    public function store(Request $req, $id)
    {

        $requested = RequestModel::findOrFail($id);

        $req->validate([
            'content' => ['bail', 'required', 'min:40'],
        ]);

        $review = new Review();
        $review->content = $req->content;
        $review->request_id = $requested->id;
        $review->user_id = $req->user()->id;

        $review->save();

        return redirect()->route('request.view', ['id' => $requested->id]);
    }
}
