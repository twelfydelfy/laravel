<?php
namespace App\Http\Controllers;

use App\Models\Poll;
use App\Models\PollOption;
use App\Models\PollVote;
use Illuminate\Http\Request;

class PollController extends Controller
{
    // Lista sondaje - toți utilizatorii
    public function index()
    {
        $polls = Poll::with('options.votes', 'votes')->get();
        return view('polls.index', compact('polls'));
    }

    // Formular creare - doar admin
    public function create()
    {
        if (!auth()->user()->isAdmin()) abort(403);
        return view('polls.create');
    }

    // Salvare sondaj nou
    public function store(Request $request)
    {
        if (!auth()->user()->isAdmin()) abort(403);

        $request->validate([
            'titlu'     => 'required|string|max:255',
            'descriere' => 'nullable|string',
            'optiuni'   => 'required|array|min:2',
            'optiuni.*' => 'required|string|max:255',
        ]);

        $poll = Poll::create([
            'titlu'     => $request->titlu,
            'descriere' => $request->descriere,
            'activ'     => true,
        ]);

        foreach ($request->optiuni as $optiune) {
            if (trim($optiune) !== '') {
                PollOption::create([
                    'poll_id' => $poll->id,
                    'optiune' => $optiune,
                ]);
            }
        }

        return redirect()->route('polls.index')->with('success', 'Sondaj creat!');
    }

    // Formular editare - doar admin
    public function edit(Poll $poll)
    {
        if (!auth()->user()->isAdmin()) abort(403);
        return view('polls.edit', compact('poll'));
    }

    // Actualizare sondaj
    public function update(Request $request, Poll $poll)
    {
        if (!auth()->user()->isAdmin()) abort(403);

        $request->validate([
            'titlu'     => 'required|string|max:255',
            'descriere' => 'nullable|string',
            'activ'     => 'boolean',
        ]);

        $poll->update([
            'titlu'     => $request->titlu,
            'descriere' => $request->descriere,
            'activ'     => $request->has('activ'),
        ]);

        return redirect()->route('polls.index')->with('success', 'Sondaj actualizat!');
    }

    // Ștergere sondaj - doar admin
    public function destroy(Poll $poll)
    {
        if (!auth()->user()->isAdmin()) abort(403);
        $poll->delete();
        return redirect()->route('polls.index')->with('success', 'Sondaj șters!');
    }

    // Votare
    public function vote(Request $request, Poll $poll)
    {
        $request->validate([
            'poll_option_id' => 'required|exists:poll_options,id',
        ]);

        // Verifică dacă a votat deja
        $existingVote = PollVote::where('poll_id', $poll->id)
                                ->where('user_id', auth()->id())
                                ->first();

        if ($existingVote) {
            return back()->with('error', 'Ai votat deja la acest sondaj!');
        }

        PollVote::create([
            'poll_id'        => $poll->id,
            'poll_option_id' => $request->poll_option_id,
            'user_id'        => auth()->id(),
        ]);

        return back()->with('success', 'Vot înregistrat!');
    }

    // Retragere vot
    public function unvote(Poll $poll)
    {
        PollVote::where('poll_id', $poll->id)
                ->where('user_id', auth()->id())
                ->delete();

        return back()->with('success', 'Vot retras!');
    }
}