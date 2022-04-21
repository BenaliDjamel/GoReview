<?php

namespace App\Http\Controllers;

use App\Models\Community;
use App\Models\User;
use Inertia\Inertia;
use Illuminate\Support\Str;
use App\Models\Request as RequestModel;

class AdminController extends Controller
{
    public function index()
    {
        return Inertia::render('Admin/Users', [
            'users' => User::select(['id', 'name', 'email'])->paginate(1)
        ]);
    }

    public function requests()
    {
        return Inertia::render('Admin/Requests', [
            'requests' => RequestModel::with('user')->paginate(1)
            ->withQueryString()
            ->through(function ($request) {
                return [
                    'id' => $request->id,
                    'title' => Str::of($request->title)->limit(80),
                    'closed' => $request->closed,
                    'user' => $request->user,
                ];
            })
        ]);
    }

    public function communities()
    {
        return Inertia::render('Admin/Communities', [
            'communities' => Community::select(['id', 'name'])->paginate(1)
        ]);
    }

    public function deleteUser($id)
    {
        $user = User::find($id);
        $user->delete();

        return redirect()->back();
    }

    public function closeRequest($id)
    {
        $user = RequestModel::find($id);
        $user->closed = 1;

        $user->save();

        return redirect()->back();
    }

    public function deleteRequest($id)
    {
        $user = RequestModel::find($id);
        $user->delete();

        return redirect()->back();
    }

    public function deleteCommunity($id)
    {
        $user = Community::find($id);
        $user->delete();

        return redirect()->back();
    }
    public function EditCommunity($id)
    {
        return Inertia::render('Admin/EditCommunity', [
            'community' => Community::where('id', $id)->get(),
        ]);
    }
}
