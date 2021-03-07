<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Account;
use App\Models\Transaction;
use Illuminate\Support\Carbon;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        $accountCreatedAt = Carbon::now()->subDays(2);

        $this->seedDemoTransactionsForAccount(
            User::factory()->create([
                'email' => 'admin@admin.com'
            ])
            ->createAccount($accountCreatedAt)
        );

        User::factory(10)
            ->create()
            ->each
            ->createAccount($accountCreatedAt)
            ->each(function (User $user) {
                $this->seedDemoTransactionsForAccount($user->account);
            });
    }

    private function seedDemoTransactionsForAccount(Account $account)
    {
        $account->transactions()->saveMany([
            Transaction::factory()->make([
                'amount' => 70000,
                'type' => 'credit',
            ]),
            Transaction::factory()->make([
                'amount' => 32000,
                'type' => 'debit',
            ]),
            Transaction::factory()->make([
                'amount' => 24000,
                'type' => 'debit',
            ]),
            Transaction::factory()->make([
                'amount' => 18000,
                'type' => 'debit',
            ]),
            Transaction::factory()->make([
                'amount' => 4000,
                'type' => 'credit',
            ]),
        ]);
    }
}
