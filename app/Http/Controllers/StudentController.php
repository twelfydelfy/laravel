<?php
namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index()
    {
        $studenti = Student::all();
        return view('studenti.index', compact('studenti'));
    }

    public function create()
    {
        if (!auth()->user()->isAdmin()) {
            return redirect('/studenti')->with('error', 'Acces interzis!');
        }
        return view('studenti.create');
    }

    public function store(Request $request)
    {
        if (!auth()->user()->isAdmin()) {
            return redirect('/studenti')->with('error', 'Acces interzis!');
        }

        $request->validate([
            'nume'      => 'required|string|max:255',
            'prenume'   => 'required|string|max:255',
            'email'     => 'required|email|unique:studenti',
            'telefon'   => 'nullable|string|max:20',
            'grupa'     => 'nullable|string|max:50',
            'an_studiu' => 'nullable|integer|min:1|max:6',
        ]);

        Student::create($request->all());
        return redirect('/studenti')->with('success', 'Student adăugat!');
    }

    public function edit(Student $student)
    {
        if (!auth()->user()->isAdmin()) {
            return redirect('/studenti')->with('error', 'Acces interzis!');
        }
        return view('studenti.edit', compact('student'));
    }

    public function update(Request $request, Student $student)
    {
        if (!auth()->user()->isAdmin()) {
            return redirect('/studenti')->with('error', 'Acces interzis!');
        }

        $request->validate([
            'nume'      => 'required|string|max:255',
            'prenume'   => 'required|string|max:255',
            'email'     => 'required|email|unique:studenti,email,' . $student->id,
            'telefon'   => 'nullable|string|max:20',
            'grupa'     => 'nullable|string|max:50',
            'an_studiu' => 'nullable|integer|min:1|max:6',
        ]);

        $student->update($request->all());
        return redirect('/studenti')->with('success', 'Student actualizat!');
    }

    public function destroy(Student $student)
    {
        if (!auth()->user()->isAdmin()) {
            return redirect('/studenti')->with('error', 'Acces interzis!');
        }
        $student->delete();
        return redirect('/studenti')->with('success', 'Student șters!');
    }
}