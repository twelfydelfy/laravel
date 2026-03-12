<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">Editează Student</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm rounded-lg p-6">
                <form method="POST" action="{{ route('studenti.update', $student) }}">
                    @csrf @method('PUT')
                    <div class="mb-4">
                        <label class="block font-medium mb-1">Nume</label>
                        <input type="text" name="nume" value="{{ $student->nume }}"
                               class="w-full border rounded px-3 py-2">
                    </div>
                    <div class="mb-4">
                        <label class="block font-medium mb-1">Prenume</label>
                        <input type="text" name="prenume" value="{{ $student->prenume }}"
                               class="w-full border rounded px-3 py-2">
                    </div>
                    <div class="mb-4">
                        <label class="block font-medium mb-1">Email</label>
                        <input type="email" name="email" value="{{ $student->email }}"
                               class="w-full border rounded px-3 py-2">
                    </div>
                    <div class="mb-4">
                        <label class="block font-medium mb-1">Telefon</label>
                        <input type="text" name="telefon" value="{{ $student->telefon }}"
                               class="w-full border rounded px-3 py-2">
                    </div>
                    <div class="mb-4">
                        <label class="block font-medium mb-1">Grupa</label>
                        <input type="text" name="grupa" value="{{ $student->grupa }}"
                               class="w-full border rounded px-3 py-2">
                    </div>
                    <div class="mb-4">
                        <label class="block font-medium mb-1">An Studiu</label>
                        <input type="number" name="an_studiu" value="{{ $student->an_studiu }}"
                               min="1" max="6" class="w-full border rounded px-3 py-2">
                    </div>
                    <div class="flex gap-2">
                        <button type="submit" 
                                class="bg-yellow-500 text-white px-4 py-2 rounded">Actualizează</button>
                        <a href="{{ route('studenti.index') }}" 
                           class="bg-gray-300 px-4 py-2 rounded">Anulează</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>