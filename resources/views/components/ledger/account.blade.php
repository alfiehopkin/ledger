<div class="mb-6 px-6 lg:px-8">
    <div class="border border-black overflow-hidden bg-yellow-100">
        <div class="p-4 flex flex-col" x-data="{ showLimits: false }">
            <div class="mb-2 flex justify-between">
                <span class="text-lg">Account Balance</span>
                <a href="#" class="font-semibold underline italic text-blue-500" x-on:click.prevent="showLimits = !showLimits" x-text="! showLimits ? 'Show Limits' : 'Hide Limits'">
                    Show Limits
                </a>
            </div>

            <div x-cloak x-show="showLimits" class="mb-2 p-2 bg-gray-400">
                <span>You have an overdraft limit of £{{ $account->formatted_overdraft_limit }} that cannot be exceeded.</span>
            </div>

            <div class="flex flex-col sm:flex-row sm:justify-between sm:items-end">
                <div class="flex flex-col mb-4 sm:mb-0">
                    <span class="text-4xl font-bold @overdraft($account) text-red-600 @endoverdraft @goodstanding($account) text-green-600 @endgoodstanding">£{{ $account->formatted_balance }}</span>
                    
                    @overdraft($account)
                        <span>You're £{{ $account->formatted_away_from_overdraft_limit }} away from your overdraft limit of £{{ $account->formatted_overdraft_limit }}.</span>
                    @endoverdraft
                    @goodstanding($account)
                        <span>Your account is in good standing.</span>
                    @endgoodstanding
                </div>

                <div class="flex">
                    <x-button wire:click="confirmCreditAccount" wire:loading.attr="disabled">
                        {{ __('Credit') }}
                    </x-button>
                    <x-button class="ml-2" wire:click="confirmDebitAccount" wire:loading.attr="disabled">
                        {{ __('Debit') }}
                    </x-button>
                </div>
            </div>
        </div>
    </div>

    <x-ledger.modals.credit-account />
    <x-ledger.modals.debit-account />
</div>
