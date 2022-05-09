<?php

namespace App\Http\Controllers;

use App\Enums\CheckStatus;
use App\Enums\TransactionType;
use App\Http\Requests\StoreCheckRequest;
use App\Http\Resources\Check as CheckResource;
use App\Models\Account;
use App\Models\Check;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CheckController extends Controller
{
    public function index()
    {
        return view('client.checks');
    }

    public function create()
    {
        $account = Account::where('user_id', auth()->id())->first();

        return view('client.checks-create', [
            'currentBalance' => number_format($account->balance, 2),
        ]);
    }

    public function store(StoreCheckRequest $request)
    {
        $account = Account::where('user_id', auth()->id())->first();

        $data = [
            'amount' => $request->amount,
            'description' => $request->description,
            'account_id' => $account->id,
            'status' => CheckStatus::PENDING->value,
            'encoded_image' => base64_encode(file_get_contents($request->file('check'))),
        ];

        Check::create($data);

        return redirect()->route('checks.index');
    }

    public function search(Request $request)
    {
        $period = $request->period ? Carbon::parse($request->period) : now();

        $firstDay = $period->copy()->startOfMonth();
        $lastDay = $period->copy()->endOfMonth();

        $acepteds = $this->getChecksByPeriod(CheckStatus::ACCEPTED->value, $firstDay, $lastDay);

        $pendings = $this->getChecksByPeriod(CheckStatus::PENDING->value, $firstDay, $lastDay);

        $rejecteds = $this->getChecksByPeriod(CheckStatus::REJECTED->value, $firstDay, $lastDay);

        return response()->json([
            'acepted' => CheckResource::collection($acepteds),
            'pending' => CheckResource::collection($pendings),
            'rejected' => CheckResource::collection($rejecteds),
        ]);
    }

    public function allPending()
    {
        $checks = Check::where('status', CheckStatus::PENDING->value)->get();

        return CheckResource::collection($checks);
    }

    public function show(Check $check)
    {
        $check->load('account.user');

        return view('admin.checks-show', [
            'checkId' => $check->id,
        ]);
    }

    public function getCheck(Check $check)
    {
        $check->load('account.user');

        return response()->json([
            'check' => CheckResource::make($check),
        ]);
    }

    public function accept(Check $check)
    {
        $check->update([
            'status' => CheckStatus::ACCEPTED->value,
        ]);

        Transaction::create([
            'account_id' => $check->account_id,
            'description' => $check->description,
            'type' => TransactionType::INCOMING->value,
            'amount' => $check->amount,
            'datetime' => $check->created_at,
        ]);

        $account = $check->account;
        $newBalance = $account->balance + $check->amount;
        $account->update([
            'balance' => $newBalance,
        ]);

        return response()->noContent();
    }

    public function reject(Check $check)
    {
        $check->update([
            'status' => CheckStatus::REJECTED->value,
        ]);

        return response()->noContent();
    }

    private function getChecksByPeriod(int $status, Carbon $firstDay, Carbon $lastDay)
    {
        return Check::where('status', $status)
            ->where('created_at', '>=', $firstDay->format('Y-m-d H:i:s'))
            ->where('created_at', '<=', $lastDay->format('Y-m-d H:i:s'))
            ->whereHas('account', function ($query) {
                $query->where('user_id', auth()->id());
            })
            ->get();
    }
}
