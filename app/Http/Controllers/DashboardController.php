<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\models\Pengajuan;

class DashboardController extends Controller
{
    /**
     * Menghitung summary jumlah pengajuan, total pengajuan yang di approve, dan total pengajuan yang di reject untuk user yang login.
     * Jika user adalah verifikator atau direktur, maka akan ditampilkan total pengajuan yang di approve dan ditolak.
     *
     * @return array
     */
    public function index()
    {
        $user = Auth::user();
        $totalPengajuan = Pengajuan::where('user_id', $user->id)->count();
        $totalApproved = Pengajuan::where('user_id', $user->id)->where('status', 'approve')->count();
        $totalRejected = Pengajuan::where('user_id', $user->id)->where('status', 'rejected to user')->count();

        if ($user->role == 'verifikator') {
            $totalPengajuan = Pengajuan::count();
            $totalApproved = Pengajuan::where('status', 'approve')->orWhere('status', 'waiting to approve direktur')->count();
            $totalRejected = Pengajuan::where('status', 'rejected to verifikator')->count();
        }
        if ($user->role == 'direktur' || $user->role == 'super admin') {
            $totalPengajuan = Pengajuan::count();
            $totalApproved = Pengajuan::where('status', 'approve')->count();
            $totalRejected = Pengajuan::where('status', 'rejected to verifikator')->count();
        }

        $summary = [
            'totalPengajuan' => $totalPengajuan,
            'totalApproved' => $totalApproved,
            'totalRejected' => $totalRejected,
        ];

        return view('pages.dashboard', compact('summary'));
    }
}
