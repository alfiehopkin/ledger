<div class="mx-auto px-6 lg:px-8">
    <div class="border border-black bg-yellow-100 overflow-hidden">
        <div class="p-4 border-b border-black">
            <h2>Transactions</h2>
        </div>

        <ul>
            @foreach($transactions as $transaction)
                <li class="p-4 flex items-center justify-between border-t border-black">
                    <span>{{ $transaction->transacted_at->format('d/m/y H:i') }}</span>
                    <span class="justify-self-end font-semibold">@debit($transaction) - @enddebit£{{ $transaction->formatted_amount }}</span>
                </li>
            @endforeach
        </ul>
    </div>
</div>
