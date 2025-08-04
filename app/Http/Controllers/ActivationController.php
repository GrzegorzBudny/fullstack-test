<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreReceiptRequest;
use App\Mail\UserRegistrationMail;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Mail;
use App\Models\Store;
use App\Models\ReceiptRegistration;
use App\Services\ReceiptRegistrationService;

class ActivationController extends Controller
{
    public function __construct(
        private ReceiptRegistrationService $receiptRegistrationService
    ) {}
    public function index() {
        $stores = Store::all();
        $mainWinners = ReceiptRegistration::where('prize_type', 'nagroda główna')->get();
        $additionalWinners = ReceiptRegistration::where('prize_type', 'nagroda dodatkowa')->get();
        $consolationWinners = ReceiptRegistration::where('prize_type', 'nagroda pocieszenia')->get();
        return view('index', compact('stores', 'mainWinners', 'additionalWinners', 'consolationWinners'));
    }

    public function storeReceipt(StoreReceiptRequest $request): RedirectResponse
    {
        try {
            $registration = $this->receiptRegistrationService->register($request->validated(), $request);

            Mail::to($registration->email)->send(new UserRegistrationMail($registration));
        
            return redirect('/#form')->with('register-success', 'Gratulacje! Pomyślnie zarejestrowaliśmy Twoją odpowiedź konkursową.');
        } catch (\Throwable $e) {
            \Log::error('Błąd rejestracji paragonu', [
                'error' => $e->getMessage(),
                'stack' => $e->getTraceAsString(),
            ]);
    
            return redirect('/#form')
                ->withInput()
                ->with('error', 'Wystąpił nieoczekiwany błąd. Spróbuj ponownie.');
        }
    }
}
