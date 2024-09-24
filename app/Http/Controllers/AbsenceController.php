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
            ->orderBy('given_date', 'asc')
            ->get()
            ->groupBy(function($absence) {
                // Format the date in Dutch and capitalize the first letter of the month
                return mb_convert_case(Carbon::parse($absence->given_date)->translatedFormat('d F Y'), MB_CASE_TITLE, "UTF-8");
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
        $absences = Absence::where('user_id', $userId)->orderBy('given_date', 'asc')->get();

        // Group absences by 'gemaakt_date' with Dutch formatted dates and capitalize the first letter
        $groupedResults = $absences->groupBy(function ($absence) {
            return mb_convert_case(Carbon::parse($absence->given_date)->translatedFormat('d F Y'), MB_CASE_TITLE, "UTF-8");
        });

        return view('dashboard.absence.view', compact('absence', 'groupedResults'));
    }

    // API Endpoint: Haal alle afwezigheden op voor de ingelogde gebruiker
    public function APIIndex()
    {
        $userId = Auth::id();

        // Set Carbon locale to Dutch
        Carbon::setLocale('nl');

        // Haal de afwezigheden van de gebruiker op uit de database en groepeer ze op datum
        $absences = Absence::where('user_id', $userId)
            ->orderBy('given_date', 'asc')
            ->get()
            ->groupBy(function($absence) {
                // Formatteer de datum in het Nederlands zonder spaties, bijvoorbeeld "02_Februari_2024"
                return Carbon::parse($absence->given_date)->translatedFormat('d_F_Y');
            });

        return response()->json([
            'absences' => $absences,
        ]);
    }

    // API Endpoint: Haal een specifieke afwezigheid op basis van ID
    public function APIView($id)
    {
        $userId = Auth::id();

        // Set Carbon locale to Dutch
        Carbon::setLocale('nl');

        // Haal de afwezigheid op basis van unieke ID en gebruiker-ID
        $absence = Absence::where('unique_id', $id)
            ->where('user_id', $userId)
            ->firstOrFail();

        // Haal alle afwezigheden op voor deze gebruiker
        $absences = Absence::where('user_id', $userId)->orderBy('given_date', 'asc')->get();

        // Groepeer afwezigheden per 'gemaakt_date' met Nederlands geformatteerde data zonder spaties
        $groupedResults = $absences->groupBy(function ($absence) {
            return Carbon::parse($absence->given_date)->translatedFormat('d_F_Y');
        });

        return response()->json([
            'absence' => $absence,
        ]);
    }

}
