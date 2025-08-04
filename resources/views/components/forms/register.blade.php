<form id="formid" class="flex flex-col items-center pb-12" enctype="multipart/form-data" method="post" action="{{ route('register-receipt') }}">
    @csrf
    @if (session('register-success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
            {{ session('register-success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
            {{ session('error') }}
        </div>
    @endif
    <div class="flex w-full xl:w-[65rem] justify-center flex-col lg:flex-row">
        <div class="mt-10 space-y-2 lg:w-3/5 w-full">
                <x-forms.field>
                    <x-forms.input pattern="^(?=.{3,100}$)[A-Za-zĄĆĘŁŃÓŚŹŻąćęłńóśźż]+([ '-][A-Za-zĄĆĘŁŃÓŚŹŻąćęłńóśźż]+)*$" name="participant-name" id="participant-name" value="{{ old('participant-name') }}" placeholder="Imię i nazwisko*" required />
                    @error('participant-name')
                    <x-layout.paragraph class="text-red-950 font-sans registererror"><small>{{ $message }}</small></x-layout.paragraph>
                    @enderror
                </x-forms.field>
                <x-forms.field>
                    <x-forms.input pattern="^(?=.{1,100}$)[^\s@]+@[^\s@]+\.[^\s@]+$" name="email" id="email" type="email" value="{{ old('email') }}" placeholder="Adres e-mail*" required />
                    @error('email')
                    <x-layout.paragraph class="text-red-950 font-sans registererror"><small>{{ $message }}</small></x-layout.paragraph>
                    @enderror
                </x-forms.field>
                <x-forms.field>
                    <x-forms.input pattern="^\+?\d[\d\s]{8,99}$" name="phone" id="phone" value="{{ old('phone') }}" placeholder="Nr telefonu*" required />
                    @error('phone')
                    <x-layout.paragraph class="text-red-950 font-sans registererror"><small>{{ $message }}</small></x-layout.paragraph>
                    @enderror
                </x-forms.field>
                <x-forms.field>
                    <x-forms.input pattern="^.{4,100}$" class="one" name="receipt-number" id="receipt-number" value="{{ old('receipt-number') }}" placeholder="Numer paragonu*" required />
                    @error('receipt-number')
                    <x-layout.paragraph class="text-red-950 font-sans registererror"><small>{{ $message }}</small></x-layout.paragraph>
                    @enderror
                </x-forms.field>
                <x-forms.field>
                    <x-forms.input class="two" name="purchase-date" id="purchase-date" value="{{ old('purchase-date') }}" placeholder="Data zakupu (dd-mm-rrrr)*" required />
                    @error('purchase-date')
                    <x-layout.paragraph class="text-red-950 font-sans registererror"><small>{{ $message }}</small></x-layout.paragraph>
                    @enderror
                </x-forms.field>
                <x-forms.field>
                    <select name="store_id" id="store_id" required
                        class="block w-full rounded-2xl bg-cookie-misty-rose py-3 px-4 text-xxl placeholder-black font-sans border-0 focus:outline focus:outline-2 focus:outline-cookie-verdigris">
                        <option value="">Wybierz sklep*</option>
                        @foreach ($stores as $store)
                            <option value="{{ $store->id }}" {{ old('store_id') == $store->id ? 'selected' : '' }}>
                                {{ $store->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('store_id')
                        <x-layout.paragraph class="text-red-950 font-sans registererror"><small>{{ $message }}</small></x-layout.paragraph>
                    @enderror
                </x-forms.field> 
                <x-forms.field>
                    <x-forms.file placeholder="Wyślij paragon*" labelFor="receipt-image" name="receipt-image" id="receipt-image" accept="image/jpeg, image/jpg, image/png" />
                    @error('receipt-image')
                    <x-layout.paragraph class="text-red-950 font-sans registererror"><small>{{ $message }}</small></x-layout.paragraph>
                    @enderror
                </x-forms.field>

        </div>
    </div>

    <div class="w-full xl:w-[65rem]">
        <div class="lg:w-3/5 mx-auto">
            <x-forms.field>
                <x-forms.area placeholder="Odpowiedz na pytanie: Masz magiczny słoik ciastek. Każde spełnia jedno życzenie. Jakie trzy wybierasz?? (100 - 1000 znaków)*" :old="old('contest-answer')"></x-forms.area>
                @error('contest-answer')
                <x-layout.paragraph class="text-red-950 registererror"><small>{{ $message }}</small></x-layout.paragraph>
                @enderror
            </x-forms.field>

            <x-forms.field>
                <div class="flex gap-3 items-center">
                    <x-forms.checkbox id="consent-regulations" name="consent-regulations" required />
                    <x-forms.label for="consent-regulations">
                        Zapoznałam(-em) się i akceptuję warunki <a href="#" target="_blank" id="registerregulation">Regulaminu</a>.*
                    </x-forms.label>
                </div>
                @error('consent-regulations')
                <x-layout.paragraph class="text-red-950 font-sans registererror"><small>{{ $message }}</small></x-layout.paragraph>>
                @enderror
            </x-forms.field>

            <x-forms.field>
                <div class="flex gap-3 items-center">
                    <x-forms.checkbox id="consent-rodo" name="consent-rodo" required />
                    <x-forms.label for="consent-rodo">
                        Zgadzam się na przetwarzanie moich danych osobowych zgodnie z <a href="https://www.kraftheinz.com/pl-PL/polityka-prywatnosci" target="_blank" id="registerpolicy" class="underline">Polityką Prywatności</a>.*
                    </x-forms.label>
                </div>
                @error('consent-rodo')
                <x-layout.paragraph class="text-red-950 font-sans registererror"><small>{{ $message }}</small></x-layout.paragraph>
                @enderror
            </x-forms.field>

            <x-layout.paragraph class="text-black text-start font-sans">* pola obowiązkowe</x-layout.paragraph>

        </div>
    </div>

    <div class="mt-12 flex items-center">
        <x-layout.link id="registersend" class="button big m-auto px-4 text-4xl transition-colors duration-500 uppercase">
            WYŚLIJ ZGŁOSZENIE
        </x-layout.link>
    </div>

</form>
