<?php

namespace App\Providers;

use App\Models\Account;
use App\Models\Transaction;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class BladeServiceProvider extends ServiceProvider
{
    public function register()
    {
        Blade::if('overdraft', function (Account $account) {
            return $account->in_overdraft;
        });

        Blade::if('goodstanding', function (Account $account) {
            return $account->is_goodstanding;
        });

        Blade::if('credit', function (Transaction $transaction) {
            return $transaction->type === 'credit';
        });

        Blade::if('debit', function (Transaction $transaction) {
            return $transaction->type === 'debit';
        });
    }
}
