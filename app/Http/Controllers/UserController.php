<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * @return View
     */
    public function index()
    {
        $users = User::orderBy('name', 'asc')->get();

        return view('user.index', compact('users'));
    }
}
