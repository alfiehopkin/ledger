<?php

namespace App\Rules;

use App\Models\Account;
use Illuminate\Contracts\Validation\Rule;

class BalanceAboveOverdraft implements Rule
{
    public $account;

    public function __construct(Account $account)
    {
        $this->account = $account;
    }

    public function passes($attribute, $value)
    {
        return ($this->account->balance - ($value * config('ledger.currency_multiplier')))
            >= -($this->account->overdraft_limit);
    }

    public function message()
    {
        return "This amount would put you over your overdraft limit of £{$this->account->formatted_overdraft_limit}.";
    }
}
