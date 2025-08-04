<x-layout>
    <section id="banner" class="bg-[url(@images/banner.webp)]">
        <x-layout.container>
            <div class="xl:w-1200 lg:w-960 w-full m-auto space-y-10 relative">
                <x-layout.contestBanner class="w-full" />
            </div>
        </x-layout.container>
    </section>
    <section id="rules" class="bg-cookie-cinereous">
        <x-layout.container>
            <div class="xl:w-1200 lg:w-960 w-full lg:px-0 px-6 m-auto">
                <x-layout.heading class="font-bold text-4xl lg:text-5xl mb-12">ZASADY</x-layout.heading>
                <x-layout.rules></x-layout.rules>
            </div>
        </x-layout.container>
    </section>
    <section id="prizes">
        <x-layout.container>
            <div class="xl:w-1200 lg:w-960 w-full lg:px-0 px-6 m-auto">
                <x-layout.sectionPrizes></x-layout.sectionPrizes>
            </div>
        </x-layout.container>
    </section>
    <section id="form" class="bg-cookie-cinereous">
        <x-layout.container>
            <div class="xl:w-1200 lg:w-960 w-full lg:px-0 px-6 m-auto">
                <x-layout.heading class="text-4xl lg:text-5xl font-bold">FORMULARZ</x-layout.heading>
            </div>
            <x-forms.register :stores="$stores"></x-forms.register>
        </x-layout.container>
    </section>
    <section id="winners">
        <x-layout.container>
            <div class="xl:w-1200 lg:w-960 w-full lg:px-0 px-6 m-auto mb-12">
                <x-layout.heading class="text-4xl lg:text-5xl font-bold">ZWYCIĘZCY</x-layout.heading>
                @if (
                    $mainWinners->isNotEmpty() ||
                    $additionalWinners->isNotEmpty() ||
                    $consolationWinners->isNotEmpty()
                )
                    <x-layout.winners     
                    :main-winners="$mainWinners"
                    :additional-winners="$additionalWinners"
                    :consolation-winners="$consolationWinners"></x-layout.winners>
                @else
                    <p class="text-center text-gray-600 italic">
                        Zwycięzcy zostaną ogłoszeni wkrótce.
                    </p>
                @endif
            </div>
        </x-layout.container>
    </section>
</x-layout>
