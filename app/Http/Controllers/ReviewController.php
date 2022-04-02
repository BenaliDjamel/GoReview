<?php

namespace App\Http\Controllers;

use App\Models\Request as RequestModel;

use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{

    public function store(Request $req, $id)
    {

        $req->validate([
            'content' => ['bail', 'required', 'min:40'],
        ]);
        
        $requested = RequestModel::findOrFail($id);

        $review = new Review();
        $review->content = $req->content;
        $review->request_id = $requested->id;
        $review->user_id = $req->user()->id;

        $review->save();

        return redirect()->route('request.view', ['id' => $requested->id]);
    }

    public function update(Request $req, $id, $requestId)
    {

        $requested = RequestModel::findOrFail($requestId);

        $req->validate([
            'content' => ['bail', 'required', 'min:40'],
        ]);

        $review =  Review::findOrFail($id);
        $review->content = $req->content;

        $review->save();

        return redirect()->route('request.view', ['id' => $requested->id]);
    }

    public function delete($id, $requestId)
    {
        $review = Review::findOrFail($id);
        $review->delete();

        return redirect()->route('request.view', ['id' => $requestId]);
    }
}
