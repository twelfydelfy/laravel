<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">Fișiere</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">

            @if(session('success'))
                <div class="bg-green-100 text-green-700 p-3 rounded mb-4">{{ session('success') }}</div>
            @endif
            @if(session('error'))
                <div class="bg-red-100 text-red-700 p-3 rounded mb-4">{{ session('error') }}</div>
            @endif

            {{-- Formular upload - doar autentificați --}}
            @auth
            <div class="bg-white shadow-sm rounded-lg p-6 mb-6">
                <h3 class="font-bold text-lg mb-4">Uploadează fișier</h3>
                <form method="POST" action="{{ route('fisiere.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="flex items-center gap-4">
                        <input type="file" name="fisier" required
                               class="border rounded px-3 py-2 w-full">
                        <button type="submit"
                                class="bg-blue-500 text-white px-4 py-2 rounded whitespace-nowrap">
                            Uploadează
                        </button>
                    </div>
                    @error('fisier')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </form>
            </div>
            @endauth

            {{-- Lista fișiere --}}
            <div class="bg-white shadow-sm rounded-lg p-6">
                <h3 class="font-bold text-lg mb-4">Fișiere disponibile</h3>
                @if($fisiere->isEmpty())
                    <p class="text-gray-500">Nu există fișiere încă.</p>
                @else
                <table class="w-full border">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="p-2 border text-left">Nume fișier</th>
                            <th class="p-2 border">Tip</th>
                            <th class="p-2 border">Mărime</th>
                            <th class="p-2 border">Uploadat de</th>
                            <th class="p-2 border">Data</th>
                            <th class="p-2 border">Acțiuni</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($fisiere as $fisier)
                        <tr class="hover:bg-gray-50">
                            <td class="p-2 border">{{ $fisier->nume_original }}</td>
                            <td class="p-2 border text-center text-sm text-gray-500">{{ $fisier->tip_fisier }}</td>
                            <td class="p-2 border text-center">{{ $fisier->marimeFormatata() }}</td>
                            <td class="p-2 border text-center">{{ $fisier->user->name }}</td>
                            <td class="p-2 border text-center text-sm">{{ $fisier->created_at->format('d.m.Y H:i') }}</td>
                            <td class="p-2 border text-center">
                                <a href="{{ route('fisiere.download', $fisier->id) }}"
                                   class="bg-green-500 text-white px-2 py-1 rounded text-sm">
                                    ⬇ Download
                                </a>
                                @auth
                                    @if(auth()->id() === $fisier->user_id || auth()->user()->isAdmin())
                                    <form method="POST" action="{{ route('fisiere.destroy', $fisier->id) }}" class="inline">
                                        @csrf @method('DELETE')
                                        <button onclick="return confirm('Ștergi fișierul?')"
                                                class="bg-red-500 text-white px-2 py-1 rounded text-sm">
                                            Șterge
                                        </button>
                                    </form>
                                    @endif
                                @endauth
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @endif
            </div>

        </div>
    </div>
</x-app-layout>