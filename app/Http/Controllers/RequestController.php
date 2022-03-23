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
            'title' => ['bail', 'required', 'max:255'],
            'community_id' => ['required'],
            'link' => ['nullable', 'url']
        ]);

        $newRequest = new ModelsRequest();
        $newRequest->title = $request->title;
        $newRequest->content = $request->content;
        $newRequest->link = $request->link;
        $newRequest->community_id = $request->community_id;
        $newRequest->user_id = $request->user()->id;

        $newRequest->save();

        return redirect('/');
    }

    public function delete(Request $req, $id)
    {
        $request = ModelsRequest::find($id);

        $request->delete();

        return redirect('/');
    }
}
