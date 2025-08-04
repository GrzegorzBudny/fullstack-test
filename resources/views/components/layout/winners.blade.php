<div class="flex flex-col lg:flex-row gap-8 mt-10">
    <div class="flex-1">
        <h2 class="text-xl font-bold mb-2">Nagroda główna</h2>
        @if ($mainWinners->isNotEmpty())
            <table class="w-full">
                @foreach ($mainWinners as $winner)
                    <tr><td class="px-2 py-1">{{ $winner['participant_name'] }}</td></tr>
                @endforeach
            </table>
        @else
            <p class="text-gray-600">Zwycięzcy zostaną ogłoszeni wkrótce.</p>
        @endif
    </div>

    <div class="flex-1">
        <h2 class="text-xl font-bold mb-2">Nagroda dodatkowa</h2>
        @if ($additionalWinners->isNotEmpty())
            <table class="w-full">
                @foreach ($additionalWinners as $winner)
                    <tr><td class="px-2 py-1">{{ $winner['participant_name'] }}</td></tr>
                @endforeach
            </table>
        @else
            <p class="text-gray-600">Zwycięzcy zostaną ogłoszeni wkrótce.</p>
        @endif
    </div>

    <div class="flex-1">
        <h2 class="text-xl font-bold mb-2">Nagroda pocieszenia</h2>
        @if ($consolationWinners->isNotEmpty())
            <table class="w-full">
                @foreach ($consolationWinners as $winner)
                    <tr><td class="px-2 py-1">{{ $winner['participant_name'] }}</td></tr>
                @endforeach
            </table>
        @else
            <p class="text-gray-600">Zwycięzcy zostaną ogłoszeni wkrótce.</p>
        @endif
    </div>
</div>
