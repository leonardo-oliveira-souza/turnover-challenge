<?php

namespace App\Http\Controllers;

use App\Enums\TransactionType;
use App\Http\Requests\StorePurchaseRequest;
use App\Http\Resources\Transaction as TransactionResource;
use App\Models\Account;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Http\Request;

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

        return redirect()->route('expenses.index');
    }

    public function expenses()
    {
        return view('client.expenses');
    }

    public function search(Request $request)
    {
        $account = Account::where('user_id', auth()->id())->first();

        $period = $request->period ? Carbon::parse($request->period) : now();
        $type = $request->type;

        $firstDay = $period->copy()->startOfMonth();
        $lastDay = $period->copy()->endOfMonth();

        $transactions = Transaction::where('account_id', $account->id)
            ->when($type, function ($query) use ($type) {
                $query->where('type', $type);
            })
            ->where('datetime', '>=', $firstDay->format('Y-m-d H:i:s'))
            ->where('datetime', '<=', $lastDay->format('Y-m-d H:i:s'))
            ->get();

        return response()->json([
            'transactions' => TransactionResource::collection($transactions),
        ]);
    }
}
