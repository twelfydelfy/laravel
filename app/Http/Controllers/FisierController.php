<?php
namespace App\Http\Controllers;

use App\Models\Fisier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FisierController extends Controller
{
    // Toți pot vedea lista
    public function index()
    {
        $fisiere = Fisier::with('user')->latest()->get();
        return view('fisiere.index', compact('fisiere'));
    }

    // Upload - doar autentificați
    public function store(Request $request)
    {
        $request->validate([
            'fisier' => 'required|file|max:10240', // max 10MB
        ]);

        $file = $request->file('fisier');
        $numeOriginal = $file->getClientOriginalName();
        $numeFisier = time() . '_' . $numeOriginal;

        $file->storeAs('uploads', $numeFisier, 'public');

        Fisier::create([
            'nume_original' => $numeOriginal,
            'nume_fisier'   => $numeFisier,
            'tip_fisier'    => $file->getClientMimeType(),
            'marime'        => $file->getSize(),
            'user_id'       => auth()->id(),
        ]);

        return back()->with('success', 'Fișier uploadat cu succes!');
    }

    // Download - toată lumea
    public function download(Fisier $fisier)
    {
        $path = storage_path('app/public/uploads/' . $fisier->nume_fisier);

        if (!file_exists($path)) {
            return back()->with('error', 'Fișierul nu există!');
        }

        return response()->download($path, $fisier->nume_original);
    }

    // Ștergere - doar cel care a uploadat sau admin
    public function destroy(Fisier $fisier)
    {
        if (auth()->id() !== $fisier->user_id && !auth()->user()->isAdmin()) {
            return back()->with('error', 'Acces interzis!');
        }

        Storage::disk('public')->delete('uploads/' . $fisier->nume_fisier);
        $fisier->delete();

        return back()->with('success', 'Fișier șters!');
    }
}