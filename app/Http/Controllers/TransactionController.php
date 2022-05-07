<?php

namespace App\Http\Controllers;

use App\Enums\TransactionType;
use App\Http\Requests\StorePurchaseRequest;
use App\Models\Account;
use App\Models\Transaction;

class TransactionController extends Controller
{
    public function purchase()
    {
        $account = Account::where('user_id', auth()->id())->first();

        $currentBalance = number_format($account->balance, 2);

        return view('client.purchase', [
            'currentBalance' => $currentBalance,
        ]);
    }

    public function storePurchase(StorePurchaseRequest $request)
    {
        $data = $request->validated();

        $account = Account::where('user_id', auth()->id())->first();

        if ($data['amount'] > $account->balance) {
            return back()->withErrors([
                'amount' => 'The amount value is bigger than current balance'
            ])->withInput($data);
        }

        $data['account_id'] = $account->id;
        $data['type'] = TransactionType::EXPENSE->value;

        Transaction::create($data);

        $newBalance = $account->balance - $data['amount'];
        $account->update(['balance' => $newBalance]);

        return redirect()->route('purchase.create');
    }
}
