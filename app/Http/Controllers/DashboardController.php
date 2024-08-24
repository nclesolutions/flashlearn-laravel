<?php
namespace App\Http\Controllers;

use App\Models\Homework;
use App\Models\Assignment;
use App\Models\Schedule;
use App\Models\Grade;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {

        // Ensure the user is authenticated
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        // Get the current authenticated user ID
        $userId = Auth::id();

        // Count Homework for the user
        $huiswerkCount = Homework::where('user_id', $userId)->count();

        // Count Assignments for the user
        $werkstukCount = Assignment::where('owner_id', $userId)->count();

        $cijfers = Grade::select('tbl_cijfers.vak_id', 'tbl_cijfers.grade', 'tbl_vakken.vak_naam', 'tbl_cijfers.onderdeel', 'tbl_cijfers.date_created')
            ->join('tbl_vakken', 'tbl_cijfers.vak_id', '=', 'tbl_vakken.id')
            ->where('tbl_cijfers.user_id', $userId)
            ->orderBy('tbl_cijfers.date_created', 'desc')
            ->limit(3)
            ->get();

        // Get the week number from the request or use the current week
        $weekNumber = $request->query('week', date('W'));

        // Get the schedule for the current week
        $schedule = Schedule::where('user_id', $userId)->first();

        if ($schedule) {
            $roosters = json_decode($schedule->roosters, true);
            $currentWeekRooster = collect($roosters['weeks'])->firstWhere('week_number', $weekNumber);

            // Get the next and previous weeks
            $weeks = $roosters['weeks'];
            $currentWeekIndex = array_search($currentWeekRooster, $weeks);
            $nextWeek = $weeks[$currentWeekIndex + 1] ?? null;
            $prevWeek = $weeks[$currentWeekIndex - 1] ?? null;
        } else {
            $currentWeekRooster = ['days' => []];
            $nextWeek = null;
            $prevWeek = null;
            $weeks = [];
        }

        return view('dashboard.index', compact('huiswerkCount', 'cijfers', 'werkstukCount', 'currentWeekRooster', 'nextWeek', 'prevWeek', 'weeks', 'weekNumber'));
    }
}
