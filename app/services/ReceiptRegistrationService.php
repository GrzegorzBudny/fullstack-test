<?php

namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\ReceiptRegistration;
use Carbon\Carbon;

class ReceiptRegistrationService
{
    public function register(array $validated, Request $request): ReceiptRegistration
    {
        $purchaseDate = Carbon::createFromFormat('d-m-Y', $validated['purchase-date'])->format('Y-m-d');

        $receiptImagePath = $request->file('receipt-image')->store('receipts', 'public');

        Log::info('Obraz paragonu zapisany.', [
            'email' => $validated['email'],
            'path' => $receiptImagePath,
        ]);

        return ReceiptRegistration::create([
            'participant_name' => $validated['participant-name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'receipt_number' => $validated['receipt-number'],
            'purchase_date' => $purchaseDate,
            'store_id' => $validated['store_id'],
            'receipt_image_path' => $receiptImagePath,
            'contest_answer' => $request->input('contest-answer'),
            'consent_regulations' => $request->has('consent-regulations'),
            'consent_rodo' => $request->has('consent-rodo'),
            'consent_external' => $request->has('consent-external'),
            'referrer' => $request->cookie('initial_referrer'),
            'landing_url' => $request->cookie('initial_landing'),
            'ip_address' => $request->ip()
        ]);
    }
}
