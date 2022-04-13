<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AdminController extends Controller
{
    public function index()
    {
        return Inertia::render('AdminPanel', [
            'users' => User::all()
        ]);
    }

    public function delete($id)
    {
        $user = User::find($id);
        $user->delete();

        return redirect()->back();
    }
}
