<?php

namespace App\Http\Livewire\Traits;

use App\Rules\BalanceAboveOverdraft;
use Illuminate\Support\Facades\Auth;

trait DebitsAccount
{
    public $amount;
    public $confirmingDebitAccount = false;

    public function confirmDebitAccount()
    {
        $this->reset();
        $this->resetErrorBag();

        $this->dispatchBrowserEvent('confirming-debit-account');

        $this->confirmingDebitAccount = true;
    }

    public function debitAccount()
    {
        $this->resetErrorBag();

        $this->validateOnly('amount', [
            'amount' => ['required', 'numeric', 'min:0.01', new BalanceAboveOverdraft(Auth::user()->account)],
        ]);

        Auth::user()->account->debit($this->amount * config('ledger.currency_multiplier'));

        $this->confirmingDebitAccount = false;
    }
}