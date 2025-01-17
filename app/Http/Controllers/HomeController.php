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

    // Function to reorder days to start from Monday
    function reorderDaysFromMonday($days) {
        // Shift keys: 1 = Sunday, 2 = Monday, ..., 7 = Saturday
        $mondayFirstOrder = [2, 3, 4, 5, 6, 7, 1];
        $reorderedDays = [];
        foreach ($mondayFirstOrder as $index) {
            $reorderedDays[] = $days[$index] ?? 0; // Ensure missing days are set to 0
        }
        return $reorderedDays;
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

        $currentYear = date('Y'); // Get the current year

        // Initialize all months and days of the week with 0
        $months = array_fill(1, 12, 0); // Keys: 1 (January) to 12 (December)
        $days_of_week = array_fill(1, 7, 0); // Keys: 1 (Sunday) to 7 (Saturday)

        // Sum of entries per month (array of values)
        $entries_per_month = Entree::selectRaw('SUM(mt_a) as total, MONTH(created_at) as month')
            ->whereYear('created_at', $currentYear)
            ->groupBy('month')
            ->orderBy('month')
            ->get()
            ->pluck('total', 'month') // Use 'pluck' to get an associative array with month as key
            ->toArray();

        $entries_per_month = array_replace($months, $entries_per_month); // Fill missing months with 0

        // Sum of entries per day of the week (array of values)
        $entries_per_day_of_week = Entree::selectRaw('SUM(mt_a) as total, DAYOFWEEK(created_at) as day_of_week')
            ->whereYear('created_at', $currentYear)
            ->groupBy('day_of_week')
            ->orderBy('day_of_week')
            ->get()
            ->pluck('total', 'day_of_week') // Use 'pluck' to get an associative array with day_of_week as key
            ->toArray();

        $entries_per_day_of_week = $this->reorderDaysFromMonday(array_replace($days_of_week, $entries_per_day_of_week)); // Reorder and fill missing days

        // Sum of outings per month (array of values)
        $outings_per_month = Depense::selectRaw('SUM(mt) as total, MONTH(created_at) as month')
            ->whereYear('created_at', $currentYear)
            ->where('nbr_approuve', 2)
            ->groupBy('month')
            ->orderBy('month')
            ->get()
            ->pluck('total', 'month') // Use 'pluck' to get an associative array with month as key
            ->toArray();

        $outings_per_month = array_replace($months, $outings_per_month); // Fill missing months with 0

        // Sum of outings per day of the week (array of values)
        $outings_per_day_of_week = Depense::selectRaw('SUM(mt) as total, DAYOFWEEK(created_at) as day_of_week')
            ->whereYear('created_at', $currentYear)
            ->where('nbr_approuve', 2)
            ->groupBy('day_of_week')
            ->orderBy('day_of_week')
            ->get()
            ->pluck('total', 'day_of_week') // Use 'pluck' to get an associative array with day_of_week as key
            ->toArray();

        $outings_per_day_of_week = $this->reorderDaysFromMonday(array_replace($days_of_week, $outings_per_day_of_week)); // Reorder and fill missing days

        $entries_per_month = array_values($entries_per_month);
        $entries_per_day_of_week = $entries_per_day_of_week;
        $outings_per_month = array_values($outings_per_month);
        $outings_per_day_of_week = $outings_per_day_of_week;

        // Calculate balance per month
        $balance_per_month = [];
        foreach ($entries_per_month as $key => $value) {
            $balance_per_month[$key] = $value - ($outings_per_month[$key] ?? 0);
        }

        // Calculate balance per day of the week
        $balance_per_day_of_week = [];
        foreach ($entries_per_day_of_week as $key => $value) {
            $balance_per_day_of_week[$key] = $value - ($outings_per_day_of_week[$key] ?? 0);
        }


//        dd($entries_per_day_of_week);


//        dd([$entries_per_month, $outings_per_month, $entries_per_day_of_week, $outings_per_day_of_week]);
        return view('dashboard', compact('entries_sum', 'outings_sum', 'users_sum', 'balance',
            'entries_per_month', 'entries_per_day_of_week', 'outings_per_month', 'outings_per_day_of_week', 'balance_per_month', 'balance_per_day_of_week')
        );
    }
}
