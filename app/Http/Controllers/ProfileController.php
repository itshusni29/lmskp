<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    /**
     * Tampilkan profil pengguna yang login.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Ambil data pengguna yang sedang login
        $user = Auth::user();
        
        // Periksa role pengguna dan render view sesuai role
        if ($user->role == 'admin') {
            return view('pages.profile.show', compact('user'));
        } elseif ($user->role == 'manager') {
            return view('pages.profile.manager_show', compact('user'));
        } elseif ($user->role == 'trainer') {
            return view('pages.profile.trainer_show', compact('user'));
        } elseif ($user->role == 'participant') {
            return view('pages.profile.student_show', compact('user'));
        } else {
            // Default view untuk pengguna yang tidak teridentifikasi
            return view('pages.profile.guest_show', compact('user'));
        }
    }
}
