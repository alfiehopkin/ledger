<?php

namespace App\Http\Livewire\Traits;

use Illuminate\Support\Facades\Auth;

trait CreditsAccount
{
    public $amount;
    public $confirmingCreditAccount = false;

    public function confirmCreditAccount()
    {
        $this->reset();
        $this->resetErrorBag();

        $this->dispatchBrowserEvent('confirming-credit-account');

        $this->confirmingCreditAccount = true;
    }

    public function creditAccount()
    {
        $this->resetErrorBag();

        $this->validateOnly('amount', [
            'amount' => ['required', 'numeric', 'min:0.01'],
        ]);

        Auth::user()->account->credit($this->amount * config('ledger.currency_multiplier'));

        $this->confirmingCreditAccount = false;
    }
}