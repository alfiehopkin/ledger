<?php

namespace App\Models;

use App\Traits\HasUuid;
use Illuminate\Support\Carbon;
use App\Traits\EncryptAttributes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Account extends Model
{
    use HasFactory;
    use HasUuid;
    use EncryptAttributes;

    protected function getEncrypt()
    {
        return [
            'balance',
            'overdraft_limit',
        ];
    }

    public function getFormattedBalanceAttribute()
    {
        return number_format($this->balance / config('ledger.currency_multiplier'), 2);
    }

    public function getFormattedOverdraftLimitAttribute()
    {
        return number_format($this->overdraft_limit / config('ledger.currency_multiplier'), 2);
    }

    public function getFormattedAwayFromOverdraftLimitAttribute()
    {
        return number_format(
            ($this->overdraft_limit - abs($this->balance)) / config('ledger.currency_multiplier')
        , 2);
    }

    public function getInOverdraftAttribute()
    {
        return $this->balance < 0;
    }

    public function getIsGoodstandingAttribute()
    {
        return $this->balance >= config('ledger.account.goodstanding_amount');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class)
            ->latest('transacted_at');
    }

    public function credit(int $amount)
    {
        $transaction = new Transaction;
        $transaction->amount = $amount;
        $transaction->type = 'credit';
        
        $this->transactions()->save($transaction);

        $this->balance += $amount;
        $this->save();
    }

    public function debit(int $amount)
    {
        $transaction = new Transaction;
        $transaction->amount = $amount;
        $transaction->type = 'debit';
        
        $this->transactions()->save($transaction);

        $this->balance -= $amount;
        $this->save();
    }

    public function creditStartingBalance(string $accountCreatedAt)
    {
        $balanceAdded = $accountCreatedAt ?? Carbon::now()->subDays(2)->toISOString();

        return $this->transactions()->save(
            Transaction::factory()->make([
                'amount' => config('ledger.account.defaults.balance'),
                'type' => 'credit',
                'transacted_at' => $balanceAdded,
            ])
        );
    }
}
