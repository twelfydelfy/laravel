<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">Editează Sondaj</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm rounded-lg p-6">
                <form method="POST" action="{{ route('polls.update', $poll->id) }}">
                    @csrf @method('PUT')
                    <div class="mb-4">
                        <label class="block font-medium mb-1">Titlu</label>
                        <input type="text" name="titlu" value="{{ $poll->titlu }}"
                               class="w-full border rounded px-3 py-2">
                    </div>
                    <div class="mb-4">
                        <label class="block font-medium mb-1">Descriere</label>
                        <textarea name="descriere" rows="3"
                                  class="w-full border rounded px-3 py-2">{{ $poll->descriere }}</textarea>
                    </div>
                    <div class="mb-4">
                        <label class="flex items-center gap-2">
                            <input type="checkbox" name="activ" {{ $poll->activ ? 'checked' : '' }}>
                            <span>Sondaj activ</span>
                        </label>
                    </div>
                    <div class="flex gap-2">
                        <button type="submit" class="bg-yellow-500 text-white px-4 py-2 rounded">
                            Actualizează
                        </button>
                        <a href="{{ route('polls.index') }}" class="bg-gray-300 px-4 py-2 rounded">
                            Anulează
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>