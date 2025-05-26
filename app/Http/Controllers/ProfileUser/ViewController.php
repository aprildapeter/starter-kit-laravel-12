<?php

namespace App\Http\Controllers\ProfileUser;

use App\Http\Controllers\Controller;
use App\Models\User;

class ViewController extends Controller
{
    public function index($id)
    {
        $data['user'] = User::find($id);
        return view('profile.index', $data);
    }
}
