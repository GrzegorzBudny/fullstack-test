<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreReceiptRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'participant-name' => ['required', 'min:3'],
            'email' => 'required|email',
            'phone' => 'required|min:9',
            'receipt-number' => 'required|min:4',
            'purchase-date' => [
                'required',
                'date_format:d-m-Y',
                function ($attribute, $value, $fail) {
                    $minDate = \Carbon\Carbon::createFromFormat('d-m-Y', '23-07-2025');
                    $maxDate = \Carbon\Carbon::createFromFormat('d-m-Y', '22-08-2025');

                    try {
                        $inputDate = \Carbon\Carbon::createFromFormat('d-m-Y', $value);

                        if ($inputDate->lt($minDate)) {
                            $fail('Data zakupu nie może być wcześniejsza niż ' . $minDate->format('d.m.Y') . '.');
                        }

                        if ($inputDate->gt($maxDate)) {
                            $fail('Data zakupu nie może być późniejsza niż ' . $maxDate->format('d.m.Y') . '.');
                        }
                    } catch (\Exception $e) {
                        $fail('Niepoprawny format daty zakupu.');
                    }
                },

            ],
            'store_id' => 'required|exists:stores,id',
            'receipt-image' => 'required|image|mimes:jpeg,png,jpg|max:25600|dimensions:min_width=600,min_height=800',
            'contest-answer' => 'required|min:100|max:1000',
            'consent-regulations' => 'accepted',
            'consent-rodo' => 'accepted'
        ];
    }

    public function messages(): array 
    {
        return [
            'participant-name.required' => 'Podaj swoje imię i nazwisko.',
            'participant-name.min' => 'Imię i nazwisko musi mieć co najmniej 3 znaki.',

            'email.required' => 'Podaj swój adres e-mail.',
            'email.email' => 'Podany adres e-mail jest nieprawidłowy.',

            'phone.required' => 'Podaj numer telefonu.',
            'phone.min' => 'Numer telefonu jest za krótki.',

            'receipt-number.required' => 'Wpisz numer paragonu.',
            'receipt-number.min' => 'Numer paragonu musi zawierać co najmniej 4 znaki.',

            'purchase-date.required' => 'Podaj datę zakupu.',
            'purchase-date.date_format' => 'Data zakupu musi być w formacie dzień-miesiąc-rok (np. 24-04-2025).',

            'store_id.required' => 'Wybierz sklep z listy.',
            'store_id.exists' => 'Wybrany sklep nie istnieje.',

            'receipt-image.required' => 'Dołącz zdjęcie paragonu.',
            'receipt-image.image' => 'Plik z paragonem musi być obrazem.',
            'receipt-image.mimes' => 'Dozwolone formaty zdjęcia paragonu to: JPG, JPEG lub PNG.',
            'receipt-image.max' => 'Zdjęcie paragonu może mieć maksymalnie 25 MB.',
            'receipt-image.dimensions' => 'Zdjęcie paragonu musi mieć co najmniej 800x600 pikseli.',

            'contest-answer.required' => 'Odpowiedz na pytanie konkursowe.',
            'contest-answer.min' => 'Odpowiedź konkursowa musi mieć co najmniej 100 znaków.',
            'contest-answer.max' => 'Odpowiedź konkursowa może mieć maksymalnie 1000 znaków.',

            'consent-regulations.accepted' => 'Musisz zaakceptować regulamin, aby wziąć udział w konkursie.',
            'consent-rodo.accepted' => 'Musisz wyrazić zgodę na przetwarzanie danych osobowych.',
            'cf-turnstile-response.required' => 'Potwierdź, że nie jesteś robotem.',
        ];
    }
}
