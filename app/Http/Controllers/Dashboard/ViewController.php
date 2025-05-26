<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Pengaturan;
use App\Models\Transaksi;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ViewController extends Controller
{
    public function index()
    {
        $start = Carbon::today()->startOfDay();
        $end = Carbon::today()->endOfDay();

        return view('dashboard');
    }
}
