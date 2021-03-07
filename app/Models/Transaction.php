<?php

namespace App\Models;

use App\Traits\EncryptAttributes;
use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Transaction extends Model
{
    use HasFactory;
    use HasUuid;
    use EncryptAttributes;

    protected $dates = [
        'transacted_at',
    ];

    protected function getEncrypt()
    {
        return [
            'amount',
            'type',
        ];
    }

    public function getFormattedAmountAttribute()
    {
        return number_format($this->amount / config('ledger.currency_multiplier'), 2);
    }
}
