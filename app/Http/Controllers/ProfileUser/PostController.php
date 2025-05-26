<?php

namespace App\Http\Controllers\ProfileUser;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Password;

class PostController extends Controller
{
    public function update($id, Request $request)
    {
        DB::beginTransaction();
        try {
            $user = User::find($id);
            $user->name = $request->input('name') ?? null;
            $user->email = $request->input('email') ?? null;
            $user->update();


            DB::commit();
            return redirect()->route('dashboard.index')->with('success', 'Data Berhasil Disimpan!');
        } catch (\Exception $e) {
            DB::rollBack();
            // dd($e->getMessage());
            return redirect()->route('dashboard.index')->with('error', 'Data Gagal Disimpan: ' . $e->getMessage());
        }
    }

    public function ubahPassword(Request $request, string $id)
    {
        DB::beginTransaction();
        try {
            $request->validate([
                'current_password' => ['required', 'current_password'],
                'password_new' => ['required', 'confirmed', Password::defaults()],
            ]);
            $user = User::find($id);
            $user->password = Hash::make($request->input('password_new') ?? 12345678);
            $user->update();

            DB::commit();
            return redirect()->route('dashboard.index')->with('success', 'Data Berhasil Disimpan!');
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['message' => 'Data Gagal Disimpan: ' . $e->getMessage()]);
        }
    }
}
