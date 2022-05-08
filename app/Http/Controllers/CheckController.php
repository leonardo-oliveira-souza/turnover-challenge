<?php

namespace App\Http\Controllers;

use App\Enums\CheckStatus;
use App\Http\Requests\StoreCheckRequest;
use App\Http\Resources\Check as CheckResource;
use App\Models\Account;
use App\Models\Check;
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
            'image_path' => $request->file('check')->store('checks'),
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

    private function getChecksByPeriod(int $status, Carbon $firstDay, Carbon $lastDay)
    {
        return Check::where('status', $status)
            ->where('created_at', '>=', $firstDay->format('Y-m-d H:i:s'))
            ->where('created_at', '<=', $lastDay->format('Y-m-d H:i:s'))
            ->get();
    }
}
