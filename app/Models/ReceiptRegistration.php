<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class ReceiptRegistration extends Model
{
    protected $fillable = [
        'participant_name',
        'email',
        'phone',
        'receipt_number',
        'purchase_date',
        'store_id',
        'is_winner',
        'receipt_image_path',
        'contest_answer',
        'consent_regulations',
        'consent_rodo',
        'consent_external',
        'referrer',
        'landing_url',
        'ip_address'
    ];

    protected $casts = [
        'purchase_date' => 'date',
        'consent_regulations' => 'boolean',
        'consent_rodo' => 'boolean',
        'consent_external' => 'boolean',
    ];

    public function dailyRankings() : hasMany
    {
        return $this->hasMany(DailyRanking::class, 'submission_id');
    }

    public function finalAward() : hasOne
    {
        return $this->hasOne(FinalAward::class, 'submission_id');
    }

    public function winnerContactRequest()
    {
        return $this->hasOne(WinnerContactRequest::class, 'submission_id');
    }

}
