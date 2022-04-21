<?php

namespace App\Http\Controllers;

use App\Models\Community;
use App\Models\Request as RequestModel;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CommunityController extends Controller
{

    public function index()
    {
        return Inertia::render('Community/Index', [

            'communities' => Community::select(['id', 'name', 'description'])
                ->withCount('requests')->get(),

        ]);
    }


    public function create()
    {
        return Inertia::render('Community/CreateCommunity');
    }

    public function feed($id)
    {

        return Inertia::render('Community/Feed', [
            /* 'community' => Community::where('id', $id)
                ->with(['requests.user', 'requests.community', 'requests.reviews'])
                ->first(), */

                'requests' => RequestModel::where('community_id', $id)
                ->with(['user:id,name', 'reviews.user', 'community:id,name'])
                ->paginate(1)
                ->withQueryString()
                ->through(function ($request) {
                        return [
                            "id" => $request->id,
                            "user_id" => $request->user_id,
                            "community_id" => $request->community_id,
                            "content" => $request->content,
                            "title" => $request->title,
                            "link" => $request->link,
                            "closed" => $request->closed,
                            "created_at" => $request->created_at->format('F d, Y'),
                            "user" => $request->user,
                            "reviews" => $request->reviews,
                            "community" => $request->community,
                           
                        ];
                    }),

            'communities' =>  Community::select(['id', 'name'])->withCount('requests')
                ->take(5)
                ->orderBy('requests_count', 'DESC')
                ->get(),
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['bail', 'required', 'min:2', 'max:15'],
            'description' => ['required', 'min:20', 'max:300']
        ]);

        $community = new Community();
        $community->name = $request->name;
        $community->description = $request->description;

        $community->save();

        return redirect()->route('community.index');
    }

    public function delete($id)
    {
        $community = Community::findOrFail($id);
        $community->delete();

        return redirect()->back();
    }
}
