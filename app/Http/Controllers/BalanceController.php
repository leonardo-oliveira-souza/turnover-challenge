<?php

namespace App\Http\Controllers;

use App\Enums\TransactionType;
use App\Models\Account;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Http\Request;

class BalanceController extends Controller
{
    public function index(Request $request)
    {
        $account = Account::where('user_id', auth()->id())->first();

        $period = $request->period ? Carbon::parse($request->period) : now();

        $firstDay = $period->copy()->startOfMonth();
        $lastDay = $period->copy()->endOfMonth();

        $transactions = Transaction::where('account_id', $account->id)
            ->where('datetime', '>=', $firstDay->format('Y-m-d H:i:s'))
            ->where('datetime', '<=', $lastDay->format('Y-m-d H:i:s'))
            ->get();

        $totalIncomes = $transactions->sum(function ($transaction) {
            if ($transaction->type === TransactionType::INCOMING->value) {
                return $transaction->ammount;
            }

            return 0;
        });

        $totalExpenses = $transactions->sum(function ($transaction) {
            if ($transaction->type === TransactionType::EXPENSE->value) {
                return $transaction->ammount;
            }

            return 0;
        });

        return response()->json([
            'current_balance' => number_format($account->balance, 2),
            'transactions' => $transactions,
            'total_incomes' => number_format($totalIncomes, 2),
            'total_expenses' => number_format($totalExpenses, 2),
        ]);
    }
}
