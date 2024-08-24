<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Absence;
use Carbon\Carbon;

class AbsenceController extends Controller
{
    public function index()
    {
        $userId = Auth::id();

        // Set Carbon locale to Dutch
        Carbon::setLocale('nl');

        // Fetch the absences from the database
        $absences = Absence::where('user_id', $userId)
            ->orderBy('gemaakt_date', 'asc')
            ->get()
            ->groupBy(function($absence) {
                // Format the date in Dutch and capitalize the first letter of the month
                return mb_convert_case(Carbon::parse($absence->gemaakt_date)->translatedFormat('d F Y'), MB_CASE_TITLE, "UTF-8");
            });

        return view('dashboard.absence.index', compact('absences'));
    }

    public function view($id)
    {
        $userId = Auth::id();

        // Set Carbon locale to Dutch
        Carbon::setLocale('nl');

        // Fetch the absence record by ID
        $absence = Absence::where('unique_id', $id)
            ->where('user_id', $userId)
            ->firstOrFail();

        // Fetch all absences for this user and group them by date
        $absences = Absence::where('user_id', $userId)->orderBy('gemaakt_date', 'asc')->get();

        // Group absences by 'gemaakt_date' with Dutch formatted dates and capitalize the first letter
        $groupedResults = $absences->groupBy(function ($absence) {
            return mb_convert_case(Carbon::parse($absence->gemaakt_date)->translatedFormat('d F Y'), MB_CASE_TITLE, "UTF-8");
        });

        return view('dashboard.absence.view', compact('absence', 'groupedResults'));
    }
}
