<?php

namespace App\Traits;

use App\Models\Account;
use Illuminate\Support\Carbon;

trait HasAccount
{
    public function account()
    {
        return $this->hasOne(Account::class);
    }

    public function createAccount(Carbon $createdAt = null, bool $creditStartingBalance = true)
    {
        $accountCreatedAt = ($createdAt ?? Carbon::now())->format('Y-m-d H:i');

        $account = $this->account()->save(
            Account::factory()->make([
                'overdraft_limit' => config('ledger.account.defaults.overdraft_limit'),
                'created_at' => $accountCreatedAt,
                'updated_at' => $accountCreatedAt,
            ])
        );

        if ($creditStartingBalance) {
            $account->creditStartingBalance($accountCreatedAt);
        }

        return $account;
    }
}