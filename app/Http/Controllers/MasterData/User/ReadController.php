<?php

namespace App\Http\Controllers\MasterData\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReadController extends Controller
{
    public function data()
    {
        $user = User::orderBy('id', 'desc')->get();

        return datatables()
            ->of($user)
            ->addIndexColumn()
            ->addColumn('status', function ($user) {
                $status = ($user->is_active == 1) ? '<span class="badge badge-success">Aktif</span>' : '<span class="badge badge-danger">Tidak Aktif</span>';
                return $status;
            })
            ->addColumn('aksi', function ($user) {
                $tombolStatus = $user->is_active == 1 ? '<button onclick="nonAktifUser(`' . route('user.ubah-status', $user->id) . '`)" class="btn btn-sm rounded-circle btn-outline-danger" data-toggle="tooltip" title="Non Aktifkan User"><i class="fas fa-user-slash"></i></button>' : '<button onclick="aktifUser(`' . route('user.ubah-status', $user->id) . '`)" class="btn btn-sm rounded-circle btn-outline-success" data-toggle="tooltip" title="Aktifkan User"><i class="fas fa-user"></i></button>';
                $resetPassword = '<button onclick="resetPassword(`' . route('user.reset-password', $user->id) . '`)" class="btn btn-sm rounded-circle btn-outline-primary" data-toggle="tooltip" title="Reset Password"><i class="fas fa-key"></i></button>';
                return '
                <a href="' . route('user.edit', $user->id) . '" class="btn btn-sm rounded-circle btn-outline-info"  data-bs-toggle="tooltip" data-bs-placement="top" title="edit user"><i class="fas fa-pencil-alt"></i> </a>
                ' . $tombolStatus.$resetPassword;
            })
            ->rawColumns(['aksi', 'status'])
            ->make(true);
    }
}
