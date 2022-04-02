<?php

namespace App\Http\Controllers;

use App\Models\Community;
use App\Models\Request as RequestModel;
use Illuminate\Database\Eloquent\Builder;
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

    public function feed()
    {

        $requests = RequestModel::with(['user:id,name', 'reviews.user', 'community:id,name'])->get();

        return Inertia::render('Request/Feed', [

            'requests' => $requests,

            'communities' => Community::select(['id', 'name'])->withCount('requests')
                ->take(5)
                ->orderBy('requests_count', 'DESC')
                ->get(),
        ]);
    }

    public function view(Request $req, $id)
    {
        $request = RequestModel::with(['reviews.user', 'reviews.likes',  'community:id,name'])
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

        return redirect('/requests');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'content' => ['bail', 'required', 'min:40'],
            'title' => ['bail', 'required', 'max:255'],
            'community_id' => ['required'],
            'link' => ['nullable', 'url']
        ]);

        $updatedRequest =  RequestModel::find($id);
        $updatedRequest->title = $request->title;
        $updatedRequest->content = $request->content;
        $updatedRequest->link = $request->link;
        $updatedRequest->community_id = $request->community_id;
        $updatedRequest->user_id = $request->user()->id;

        $updatedRequest->save();

        return redirect('/requests');
    }

    public function closeRequest($id)
    {
        $updatedRequest =  RequestModel::find($id);
        $updatedRequest->closed = 1;
        $updatedRequest->save();

        return redirect()->route('request.view', ['id' => $updatedRequest->id]);
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

        return redirect('/requests');
    }
}
