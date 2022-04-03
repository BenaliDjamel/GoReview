<?php

namespace App\Http\Controllers;

use App\Models\Community;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CommunityController extends Controller
{
    public function feed(Request $request, $id)
    {

        return Inertia::render('Community/Feed', [
            'community' => Community::where('id', $id)
                ->with(['requests.user', 'requests.community', 'requests.reviews'])
                ->first(),
                
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
        ]);

        $community = new Community();
        $community->name = $request->name;

        $community->save();

        return redirect()->back();
    }

    public function delete($id)
    {
        $community = Community::findOrFail($id);
        $community->delete();

        return redirect()->back();
    }
}
