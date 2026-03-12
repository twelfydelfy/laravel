<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">Sondaj nou</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm rounded-lg p-6">
                <form method="POST" action="{{ route('polls.store') }}">
                    @csrf
                    <div class="mb-4">
                        <label class="block font-medium mb-1">Titlu</label>
                        <input type="text" name="titlu" value="{{ old('titlu') }}"
                               class="w-full border rounded px-3 py-2">
                        @error('titlu') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
                    </div>
                    <div class="mb-4">
                        <label class="block font-medium mb-1">Descriere (opțional)</label>
                        <textarea name="descriere" rows="3"
                                  class="w-full border rounded px-3 py-2">{{ old('descriere') }}</textarea>
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium mb-2">Opțiuni (minim 2)</label>
                        <div id="optiuni-container" class="space-y-2">
                            <input type="text" name="optiuni[]" placeholder="Opțiunea 1"
                                   class="w-full border rounded px-3 py-2">
                            <input type="text" name="optiuni[]" placeholder="Opțiunea 2"
                                   class="w-full border rounded px-3 py-2">
                        </div>
                        <button type="button" onclick="adaugaOptiune()"
                                class="mt-2 text-blue-500 text-sm">+ Adaugă opțiune</button>
                    </div>

                    <div class="flex gap-2">
                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">
                            Creează sondaj
                        </button>
                        <a href="{{ route('polls.index') }}" class="bg-gray-300 px-4 py-2 rounded">
                            Anulează
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        let count = 2;
        function adaugaOptiune() {
            count++;
            const container = document.getElementById('optiuni-container');
            const input = document.createElement('input');
            input.type = 'text';
            input.name = 'optiuni[]';
            input.placeholder = `Opțiunea ${count}`;
            input.className = 'w-full border rounded px-3 py-2';
            container.appendChild(input);
        }
    </script>
</x-app-layout>