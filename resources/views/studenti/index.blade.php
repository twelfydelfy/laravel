<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">Studenți</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm rounded-lg p-6">

                @if(session('success'))
                    <div class="bg-green-100 text-green-700 p-3 rounded mb-4">{{ session('success') }}</div>
                @endif

                @if(auth()->user()->isAdmin())
                    <a href="{{ route('studenti.create') }}" 
                       class="bg-blue-500 text-white px-4 py-2 rounded mb-4 inline-block">
                        + Adaugă Student
                    </a>
                @endif

                <table class="w-full border mt-4">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="p-2 border">ID</th>
                            <th class="p-2 border">Nume</th>
                            <th class="p-2 border">Prenume</th>
                            <th class="p-2 border">Email</th>
                            <th class="p-2 border">Telefon</th>
                            <th class="p-2 border">Grupa</th>
                            <th class="p-2 border">An</th>
                            @if(auth()->user()->isAdmin())
                                <th class="p-2 border">Acțiuni</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($studenti as $student)
                        <tr class="hover:bg-gray-50">
                            <td class="p-2 border">{{ $student->id }}</td>
                            <td class="p-2 border">{{ $student->nume }}</td>
                            <td class="p-2 border">{{ $student->prenume }}</td>
                            <td class="p-2 border">{{ $student->email }}</td>
                            <td class="p-2 border">{{ $student->telefon }}</td>
                            <td class="p-2 border">{{ $student->grupa }}</td>
                            <td class="p-2 border">{{ $student->an_studiu }}</td>
                            @if(auth()->user()->isAdmin())
                            <td class="p-2 border text-center">
                                <a href="{{ route('studenti.edit', $student) }}" 
                                   class="bg-yellow-400 text-white px-2 py-1 rounded text-sm">Edit</a>
                                <form action="{{ route('studenti.destroy', $student) }}" 
                                      method="POST" class="inline">
                                    @csrf @method('DELETE')
                                    <button onclick="return confirm('Sigur ștergi?')" 
                                            class="bg-red-500 text-white px-2 py-1 rounded text-sm">
                                        Șterge
                                    </button>
                                </form>
                            </td>
                            @endif
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>