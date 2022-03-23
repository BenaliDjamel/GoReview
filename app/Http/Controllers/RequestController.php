<?php

namespace App\Http\Controllers;

use App\Models\Community;
use App\Models\Request as ModelsRequest;
use Illuminate\Http\Request;
use Inertia\Inertia;

class RequestController extends Controller
{

    public function index(Request $request)
    {

        return Inertia::render('Request/Index', [

            'requests' => $request->user()->requests()->with('comments')->get(),

        ]);
    }

    public function create(Request $request)
    {
        return Inertia::render('Request/CreateRequest', [
            'communities' => Community::all(['id', 'name'])
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'content' => ['bail', 'required', 'min:40'],
            'community_id' => ['required'],
            'link' => ['nullable', 'url']
        ]);

        $newRequest = new ModelsRequest();
        $newRequest->content = $request->content;
        $newRequest->link = $request->link;
        $newRequest->community_id = $request->community_id;
        $newRequest->user_id = $request->user()->id;

        $newRequest->save();

        return redirect('/');
    }
}
