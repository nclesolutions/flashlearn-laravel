<?php
namespace App\Http\Controllers;

use App\Models\Werkstuk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ProjectController extends Controller
{
    public function index(Request $request)
    {
        // Get the subject filter from the request, default to 'all'
        $vak = $request->input('vak', 'all');

        // Fetch unique vakken that have associated werkstukken
        $availableVakken = DB::table('projects')
            ->select('vak')
            ->groupBy('vak')
            ->havingRaw('COUNT(*) > 0')
            ->pluck('vak')
            ->toArray();

        // Query to count all rows in the "werkstukken" table
        if ($vak == 'all') {
            // Count all werkstukken when no filter is applied
            $werkstukcount = DB::table('projects')->count();
        } else {
            // Count filtered werkstukken
            $werkstukcount = DB::table('projects')->where('vak', $vak)->count();
        }

        // Query to get the werkstukken based on the selected subject
        if ($vak == 'all') {
            $werkstukken = DB::table('projects')->get();
        } else {
            $werkstukken = DB::table('projects')->where('vak', $vak)->get();
        }

        // Iterate through werkstukken and fetch related data
        foreach ($werkstukken as $werkstuk) {
            $werkstuk->creator = DB::table('users')->where('id', $werkstuk->owner_id)->first();
            $werkstuk->total_characters = DB::table('projects')
                ->where('id', $werkstuk->id)
                ->sum(DB::raw('CHAR_LENGTH(content)'));
        }

        return view('dashboard.project.index', compact('werkstukcount', 'werkstukken', 'vak', 'availableVakken'));
    }


    public function view($id)
    {
        // Retrieve the werkstuk based on the unique_id
        $werkstuk = DB::table('projects')->where('unique_id', $id)->first();

        if (!$werkstuk) {
            return redirect()->route('dashboard.project.index')->with('error', 'Werkstuk niet gevonden');
        }

        // Retrieve the creator of the werkstuk
        $creator = DB::table('users')->where('id', $werkstuk->owner_id)->first();

        // Pass the data to the view
        return view('dashboard.project.view', compact('werkstuk', 'creator'));
    }
    public function truncateStringWithEllipsis($string, $maxLength)
    {
        if (mb_strlen($string) > $maxLength) {
            $string = mb_substr($string, 0, $maxLength - 3) . '...';
        }
        return $string;
    }

    public function destroy($id)
    {
        // Retrieve the werkstuk by its unique ID
        $werkstuk = DB::table('projects')->where('unique_id', $id)->first();

        // Check if the werkstuk exists and if the current user is the owner
        if ($werkstuk && $werkstuk->owner_id == Auth::id()) {
            DB::table('projects')->where('unique_id', $id)->delete();

            return redirect()->route('dashboard.project.index')->with('success', 'Werkstuk succesvol verwijderd.');
        }

        return redirect()->route('dashboard.project.index')->with('error', 'Werkstuk niet gevonden of je hebt geen rechten om dit werkstuk te verwijderen.');
    }

    public function edit($id)
    {
        // Fetch the werkstuk based on its unique ID
        $werkstuk = DB::table('projects')->where('unique_id', $id)->first();

        // If no werkstuk found, redirect back with an error
        if (!$werkstuk) {
            return redirect()->route('dashboard.project.index')->with('error', 'Werkstuk niet gevonden.');
        }

        // Pass the werkstuk data to the view
        return view('dashboard.project.edit', compact('werkstuk'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'niveau' => 'required|string|max:255',
            'vak' => 'required|string|max:255',
            'editor' => 'required|string',
        ]);

        // Update the werkstuk
        DB::table('projects')
            ->where('unique_id', $request->werkstuk_id)
            ->update([
                'title' => $request->title,
                'niveau' => $request->niveau,
                'vak' => $request->vak,
                'content' => $request->editor,
            ]);

        return redirect()->route('dashboard.project.index')->with('success', 'Werkstuk succesvol bijgewerkt.');
    }

    public function store(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'title' => 'required|string|max:255',
            'niveau' => 'required|string|max:255',
            'vak' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        // Create a new werkstuk using the validated data
        $werkstuk = new Werkstuk();
        $werkstuk->title = $request->input('title');
        $werkstuk->niveau = $request->input('niveau');
        $werkstuk->vak = $request->input('vak');
        $werkstuk->content = $request->input('content');
        $werkstuk->owner_id = Auth::id(); // Assuming the current authenticated user is the owner
        $werkstuk->unique_id = Str::uuid(); // Generate a unique identifier

        // Save the werkstuk to the database
        $werkstuk->save();

        // Redirect to a page, maybe the index or show page, with a success message
        return redirect()->route('dashboard.project.index')->with('success', 'Werkstuk successfully created.');
    }

    public function create()
    {
        return view('dashboard.project.create');
    }


    // API Endpoint: Haal alle werkstukken op, eventueel gefilterd op vak
    // API Endpoint: Haal alle werkstukken op, eventueel gefilterd op vak
    public function APIIndex(Request $request)
    {
        // Haal het vak-filter op uit het verzoek, standaard 'all'
        $vak = $request->input('vak', 'all');

        // Query om alle werkstukken op te halen, eventueel gefilterd op vak
        if ($vak == 'all') {
            $werkstukken = DB::table('projects')->get();
        } else {
            $werkstukken = DB::table('projects')->where('vak', $vak)->get();
        }

        // Verwijder de eigenaar-id en andere gebruikersgegevens voor elke werkstuk
        $werkstukken->transform(function ($werkstuk) {
            unset($werkstuk->owner_id);
            return $werkstuk;
        });

        return response()->json([
            'werkstukken' => $werkstukken,
            'vak' => $vak,
        ]);
    }

    // API Endpoint: Haal een specifiek werkstuk op basis van ID
    public function APIView($id)
    {
        // Haal het werkstuk op basis van de unieke ID
        $werkstuk = DB::table('projects')->where('unique_id', $id)->first();

        if (!$werkstuk) {
            return response()->json(['error' => 'Werkstuk niet gevonden'], 404);
        }

        // Verwijder de eigenaar-id en andere gebruikersgegevens
        unset($werkstuk->owner_id);

        return response()->json([
            'werkstuk' => $werkstuk,
        ]);
    }

    // API Endpoint: Verwijder een werkstuk
    public function APIDestroy($id)
    {
        // Haal het werkstuk op basis van de unieke ID
        $werkstuk = DB::table('projects')->where('unique_id', $id)->first();

        // Controleer of het werkstuk bestaat en of de huidige gebruiker de eigenaar is
        if ($werkstuk && $werkstuk->owner_id == Auth::id()) {
            DB::table('projects')->where('unique_id', $id)->delete();
            return response()->json(['success' => 'Werkstuk succesvol verwijderd.']);
        }

        return response()->json(['error' => 'Werkstuk niet gevonden of je hebt geen rechten om dit werkstuk te verwijderen.'], 403);
    }

    // API Endpoint: Maak een nieuw werkstuk aan
    public function APIStore(Request $request)
    {
        // Valideer de binnenkomende gegevens
        $request->validate([
            'title' => 'required|string|max:255',
            'niveau' => 'required|string|max:255',
            'vak' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        // Maak een nieuw werkstuk aan
        $werkstuk = new Werkstuk();
        $werkstuk->title = $request->input('title');
        $werkstuk->niveau = $request->input('niveau');
        $werkstuk->vak = $request->input('vak');
        $werkstuk->content = $request->input('content');
        $werkstuk->owner_id = Auth::id(); // Huidige ingelogde gebruiker als eigenaar
        $werkstuk->unique_id = Str::uuid(); // Genereer een unieke ID

        // Sla het werkstuk op in de database
        $werkstuk->save();

        // Verwijder de eigenaar-id en andere gebruikersgegevens voordat de response wordt gegeven
        unset($werkstuk->owner_id);

        return response()->json(['success' => 'Werkstuk succesvol aangemaakt.', 'werkstuk' => $werkstuk], 201);
    }

    // API Endpoint: Werk een bestaand werkstuk bij
    public function APIUpdate(Request $request, $id)
    {
        // Valideer de binnenkomende gegevens
        $request->validate([
            'title' => 'required|string|max:255',
            'niveau' => 'required|string|max:255',
            'vak' => 'required|string|max:255',
            'editor' => 'required|string',
        ]);

        // Update het werkstuk
        $werkstuk = DB::table('projects')
            ->where('unique_id', $id)
            ->first();

        if (!$werkstuk || $werkstuk->owner_id !== Auth::id()) {
            return response()->json(['error' => 'Werkstuk niet gevonden of je hebt geen rechten om dit werkstuk bij te werken.'], 403);
        }

        DB::table('projects')
            ->where('unique_id', $id)
            ->update([
                'title' => $request->title,
                'niveau' => $request->niveau,
                'vak' => $request->vak,
                'content' => $request->editor,
            ]);

        return response()->json(['success' => 'Werkstuk succesvol bijgewerkt.']);
    }

    // API Endpoint: Haal beschikbare vakken op
    public function APIAvailableVakken()
    {
        // Haal alle unieke vakken op
        $availableVakken = DB::table('projects')
            ->select('vak')
            ->groupBy('vak')
            ->havingRaw('COUNT(*) > 0')
            ->pluck('vak')
            ->toArray();

        return response()->json(['vakken' => $availableVakken]);
    }

}
