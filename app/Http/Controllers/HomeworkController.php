<?php
namespace App\Http\Controllers;

use App\Models\Homework;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use IntlDateFormatter;
use DateTime;

class HomeworkController extends Controller
{
    public function index()
    {
        // Ensure the user is authenticated
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        // Haal het huiswerk op voor de ingelogde gebruiker
        $user_id = Auth::id();

        // Query om het huiswerk op te halen
        $homework = DB::table('homework')
            ->where('user_id', $user_id)
            ->orderBy('inlever_date')
            ->get();

        // Formatter voor de datum
        $locale = 'nl_NL';
        $formatter = new IntlDateFormatter(
            $locale,
            IntlDateFormatter::LONG,
            IntlDateFormatter::NONE,
            'Europe/Amsterdam',
            null,
            'd MMMM yyyy'
        );

        // Groepeer de resultaten op inleverdatum
        $groupedResults = [];
        foreach ($homework as $row) {
            $date = new DateTime($row->inlever_date);
            $inleverDate = $formatter->format($date);

            // Maak de eerste letter van de maand een hoofdletter
            $inleverDateParts = explode(' ', $inleverDate);
            if (isset($inleverDateParts[1])) {
                $inleverDateParts[1] = ucfirst($inleverDateParts[1]);
            }
            $inleverDate = implode(' ', $inleverDateParts);

            $groupedResults[$inleverDate][] = $row;
        }

        return view('dashboard.homework.index', compact('groupedResults'));
    }

    public function view($id)
    {
        // Fetch homework by ID
        $homework = Homework::where('unique_id', $id)->first();

        // Check if homework belongs to the logged-in user
        if ($homework->user_id != Auth::id()) {
            return redirect('/huiswerk');
        }

        // Formatter voor de datum in de weergave
        $locale = 'nl_NL';
        $formatter = new IntlDateFormatter(
            $locale,
            IntlDateFormatter::LONG,
            IntlDateFormatter::NONE,
            'Europe/Amsterdam',
            null,
            'd MMMM yyyy'
        );

        // Format the inlever_date of the specific homework
        $date = new DateTime($homework->inlever_date);
        $homework->formatted_date = $formatter->format($date);

        // Fetch other homework tasks grouped by inlever_date
        $groupedResults = Homework::where('user_id', Auth::id())
            ->orderBy('inlever_date')
            ->get()
            ->groupBy(function($item) use ($formatter) {
                $date = new DateTime($item->inlever_date);
                $formattedDate = $formatter->format($date);

                // Ensure the first letter of the month is capitalized
                $formattedDateParts = explode(' ', $formattedDate);
                if (isset($formattedDateParts[1])) {
                    $formattedDateParts[1] = ucfirst($formattedDateParts[1]);
                }

                return implode(' ', $formattedDateParts);
            });

        return view('dashboard.homework.view', compact('homework', 'groupedResults', 'id'));
    }
}
