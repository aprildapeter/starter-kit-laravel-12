<?php

namespace App\Http\Controllers\MasterData\User;

use App\Http\Controllers\Controller;
use App\Models\User;

class ViewController extends Controller
{
    public function index()
    {
        return view('master-data.user.index');
    }

    public function create()
    {
        return view('master-data.user.create');
    }

    public function edit($id)
    {
        $data['user'] = User::find($id);
        return view('master-data.user.edit', $data);
    }
}
