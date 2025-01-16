<?php

namespace App\Http\Controllers;

// Models
use App\Models\Entree;
use App\Models\Depense;
use App\Models\User;



class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $entries_sum = Entree::sum('mt_a');
        $outings_sum = Depense::where('nbr_approuve', 2)->sum('mt');
        $users_sum = User::where('user', 'user')->count();
        $balance = $entries_sum-$outings_sum;

        return view('dashboard', compact('entries_sum', 'outings_sum', 'users_sum', 'balance'));
    }
}
