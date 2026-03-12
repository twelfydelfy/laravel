<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">Sondaje</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

            @if(session('success'))
                <div class="bg-green-100 text-green-700 p-3 rounded mb-4">{{ session('success') }}</div>
            @endif
            @if(session('error'))
                <div class="bg-red-100 text-red-700 p-3 rounded mb-4">{{ session('error') }}</div>
            @endif

            @if(auth()->user()->isAdmin())
                <a href="{{ route('polls.create') }}"
                   class="bg-blue-500 text-white px-4 py-2 rounded mb-6 inline-block">
                    + Sondaj nou
                </a>
            @endif

            @forelse($polls as $poll)
            <div class="bg-white shadow-sm rounded-lg p-6 mb-6">
                <div class="flex justify-between items-center mb-2">
                    <h3 class="text-lg font-bold">{{ $poll->titlu }}</h3>
                    <span class="text-sm px-2 py-1 rounded {{ $poll->activ ? 'bg-green-100 text-green-700' : 'bg-gray-200 text-gray-500' }}">
                        {{ $poll->activ ? 'Activ' : 'Închis' }}
                    </span>
                </div>

                @if($poll->descriere)
                    <p class="text-gray-600 mb-4">{{ $poll->descriere }}</p>
                @endif

                @php
                    $userVote = $poll->userVote(auth()->id());
                    $totalVoturi = $poll->votes->count();
                @endphp

                {{-- Formular votare --}}
                @if($poll->activ && !$userVote)
                <form method="POST" action="{{ route('polls.vote', $poll->id) }}">
                    @csrf
                    <div class="space-y-2 mb-4">
                        @foreach($poll->options as $option)
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="radio" name="poll_option_id" value="{{ $option->id }}" required>
                            <span>{{ $option->optiune }}</span>
                        </label>
                        @endforeach
                    </div>
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">
                        Votează
                    </button>
                </form>

                {{-- Rezultate după vot --}}
                @else
                <div class="space-y-3 mb-4">
                    @foreach($poll->options as $option)
                    @php
                        $voturi = $option->votes->count();
                        $procent = $totalVoturi > 0 ? round(($voturi / $totalVoturi) * 100) : 0;
                        $esteVotulMeu = $userVote && $userVote->poll_option_id === $option->id;
                    @endphp
                    <div>
                        <div class="flex justify-between text-sm mb-1">
                            <span class="{{ $esteVotulMeu ? 'font-bold text-blue-600' : '' }}">
                                {{ $option->optiune }} {{ $esteVotulMeu ? '✓ (votul tău)' : '' }}
                            </span>
                            <span>{{ $voturi }} voturi ({{ $procent }}%)</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-3">
                            <div class="h-3 rounded-full {{ $esteVotulMeu ? 'bg-blue-500' : 'bg-gray-400' }}"
                                 style="width: {{ $procent }}%"></div>
                        </div>
                    </div>
                    @endforeach
                </div>

                <p class="text-sm text-gray-500 mb-3">Total voturi: {{ $totalVoturi }}</p>

                {{-- Retrage vot --}}
                @if($userVote && $poll->activ)
                <form method="POST" action="{{ route('polls.unvote', $poll->id) }}">
                    @csrf @method('DELETE')
                    <button type="submit" class="bg-red-400 text-white px-3 py-1 rounded text-sm">
                        Retrage votul
                    </button>
                </form>
                @endif
                @endif

                {{-- Butoane admin --}}
                @if(auth()->user()->isAdmin())
                <div class="border-t mt-4 pt-4 flex gap-2">
                    <a href="{{ route('polls.edit', $poll->id) }}"
                       class="bg-yellow-400 text-white px-3 py-1 rounded text-sm">Editează</a>
                    <form method="POST" action="{{ route('polls.destroy', $poll->id) }}">
                        @csrf @method('DELETE')
                        <button onclick="return confirm('Ștergi sondajul?')"
                                class="bg-red-500 text-white px-3 py-1 rounded text-sm">Șterge</button>
                    </form>
                </div>
                @endif
            </div>
            @empty
            <p class="text-gray-500">Nu există sondaje încă.</p>
            @endforelse
        </div>
    </div>
</x-app-layout>