<?php

namespace App\Http\Controllers\MasterData\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class PostController extends Controller
{


    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
                'password' => ['required', 'confirmed', Password::defaults()],
            ]);
            $user = new User();
            $user->name = $request->input('name') ?? null;
            $user->email = $request->input('email') ?? null;
            $user->password = Hash::make($request->input('password') ?? null);
            $user->save();


            DB::commit();
            return redirect()->route('user.index')->with('success', 'Data Berhasil Disimpan!');
        } catch (\Exception $e) {
            DB::rollBack();
            // dd($e->getMessage());
            return redirect()->route('user.index')->with('error', 'Data Gagal Disimpan: ' . $e->getMessage());
        }
    }

    public function update($id, Request $request)
    {
        DB::beginTransaction();
        try {
            $user = User::find($id);
            $user->name = $request->input('name') ?? null;
            $user->email = $request->input('email') ?? null;
            $user->update();


            DB::commit();
            return redirect()->route('user.index')->with('success', 'Data Berhasil Disimpan!');
        } catch (\Exception $e) {
            DB::rollBack();
            // dd($e->getMessage());
            return redirect()->route('user.index')->with('error', 'Data Gagal Disimpan: ' . $e->getMessage());
        }
    }

    public function ubahStatus(Request $request, string $id)
    {
        DB::beginTransaction();
        try {
            $user = User::find($id);
            $user->is_active = $request->input('status') ?? null;
            $user->update();

            DB::commit();
            return response()->json(['message' => 'Data Berhasil Diupdate!']);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['message' => 'Data Gagal Diupdate: ' . $e->getMessage()]);
        }
    }
    public function resetPassword(Request $request, string $id)
    {
        DB::beginTransaction();
        try {
            $user = User::find($id);
            $user->password = Hash::make($request->input('password') ?? 12345678);
            $user->update();

            DB::commit();
            return response()->json(['message' => 'Data Berhasil Reset Passowrd! Password:12345678']);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['message' => 'Data Gagal Reset Passowrd: ' . $e->getMessage()]);
        }
    }
}
