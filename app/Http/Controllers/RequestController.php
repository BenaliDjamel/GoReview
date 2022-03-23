<?php

namespace App\Http\Controllers;

use App\Models\Community;
use App\Models\Request as RequestModel;
use Illuminate\Http\Request;
use Inertia\Inertia;

class RequestController extends Controller
{

    public function index(Request $request)
    {

        return Inertia::render('Request/Index', [

            'requests' => $request->user()->requests()->with(['reviews'])->get(),
        ]);
    }
    public function view(Request $req, $id)
    {
        $request = RequestModel::with(['reviews.user', 'community:id,name'])
            ->where('id', $id)->first();

        return Inertia::render('Request/ViewRequest', [
            'request' => $request

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

        $newRequest = new RequestModel();
        $newRequest->title = $request->title;
        $newRequest->content = $request->content;
        $newRequest->link = $request->link;
        $newRequest->community_id = $request->community_id;
        $newRequest->user_id = $request->user()->id;

        $newRequest->save();

        return redirect('/');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'content' => ['bail', 'required', 'min:40'],
            'title' => ['bail', 'required', 'max:255'],
            'community_id' => ['required'],
            'link' => ['nullable', 'url']
        ]);

        $newRequest =  RequestModel::find($id);
        $newRequest->title = $request->title;
        $newRequest->content = $request->content;
        $newRequest->link = $request->link;
        $newRequest->community_id = $request->community_id;
        $newRequest->user_id = $request->user()->id;

        $newRequest->save();

        return redirect('/requests');
    }

    public function edit(Request $req, $id)
    {
        return Inertia::render('Request/EditRequest', [
            'request' => RequestModel::find($id),
            'communities' => Community::all(['id', 'name'])
        ]);
    }

    public function delete(Request $req, $id)
    {
        $request = RequestModel::find($id);

        $request->delete();

        return redirect('/');
    }
}
