<x-ledger.modals.base wire:model="confirmingDebitAccount">
    <x-slot name="title">
        {{ __('Debit Account') }}
    </x-slot>

    <x-slot name="content">
        <div x-data="{}" x-on:confirming-debit-account.window="setTimeout(() => $refs.amount.focus(), 250)">
            <input type="number" step=".01" class="mt-1 block w-full"
                        placeholder="{{ __('Amount') }}"
                        x-ref="amount"
                        wire:model.defer="amount"
                        wire:keydown.enter="debitAccount" />

            <x-jet-input-error for="amount" class="mt-2" />
        </div>
    </x-slot>

    <x-slot name="footer">
        <x-button wire:click="$toggle('confirmingDebitAccount')" wire:loading.attr="disabled">
            {{ __('Cancel') }}
        </x-button>

        <x-button class="ml-2" wire:click="debitAccount" wire:loading.attr="disabled">
            {{ __('Debit Account') }}
        </x-button>
    </x-slot>
</x-ledger.modals.base>