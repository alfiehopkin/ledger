<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Http\Livewire\Traits\DebitsAccount;
use App\Http\Livewire\Traits\CreditsAccount;

class Ledger extends Component
{
    use CreditsAccount;
    use DebitsAccount;
    
    public function render()
    {
        return view('livewire.ledger', [
            'account' => Auth::user()->account,
            'transactions' => Auth::user()->transactions,
        ]);
    }
}
