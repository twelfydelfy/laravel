<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">Adaugă Student</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm rounded-lg p-6">
                <form method="POST" action="{{ route('studenti.store') }}">
                    @csrf
                    <div class="mb-4">
                        <label class="block font-medium mb-1">Nume</label>
                        <input type="text" name="nume" value="{{ old('nume') }}"
                               class="w-full border rounded px-3 py-2">
                        @error('nume') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
                    </div>
                    <div class="mb-4">
                        <label class="block font-medium mb-1">Prenume</label>
                        <input type="text" name="prenume" value="{{ old('prenume') }}"
                               class="w-full border rounded px-3 py-2">
                        @error('prenume') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
                    </div>
                    <div class="mb-4">
                        <label class="block font-medium mb-1">Email</label>
                        <input type="email" name="email" value="{{ old('email') }}"
                               class="w-full border rounded px-3 py-2">
                        @error('email') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
                    </div>
                    <div class="mb-4">
                        <label class="block font-medium mb-1">Telefon</label>
                        <input type="text" name="telefon" value="{{ old('telefon') }}"
                               class="w-full border rounded px-3 py-2">
                    </div>
                    <div class="mb-4">
                        <label class="block font-medium mb-1">Grupa</label>
                        <input type="text" name="grupa" value="{{ old('grupa') }}"
                               class="w-full border rounded px-3 py-2">
                    </div>
                    <div class="mb-4">
                        <label class="block font-medium mb-1">An Studiu</label>
                        <input type="number" name="an_studiu" value="{{ old('an_studiu') }}"
                               min="1" max="6" class="w-full border rounded px-3 py-2">
                    </div>
                    <div class="flex gap-2">
                        <button type="submit" 
                                class="bg-blue-500 text-white px-4 py-2 rounded">Salvează</button>
                        <a href="{{ route('studenti.index') }}" 
                           class="bg-gray-300 px-4 py-2 rounded">Anulează</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>