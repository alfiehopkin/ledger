<x-ledger.modals.base wire:model="confirmingCreditAccount">
    <x-slot name="title">
        {{ __('Credit Account') }}
    </x-slot>

    <x-slot name="content">
        <div x-data="{}" x-on:confirming-credit-account.window="setTimeout(() => $refs.amount.focus(), 250)">
            <input type="number" step=".01" class="mt-1 block w-full"
                        placeholder="{{ __('Amount') }}"
                        x-ref="amount"
                        wire:model.defer="amount"
                        wire:keydown.enter="creditAccount" />

            <x-jet-input-error for="amount" class="mt-2" />
        </div>
    </x-slot>

    <x-slot name="footer">
        <x-button wire:click="$toggle('confirmingCreditAccount')" wire:loading.attr="disabled">
            {{ __('Cancel') }}
        </x-button>

        <x-button class="ml-2" wire:click="creditAccount" wire:loading.attr="disabled">
            {{ __('Credit Account') }}
        </x-button>
    </x-slot>
</x-ledger.modals.base>