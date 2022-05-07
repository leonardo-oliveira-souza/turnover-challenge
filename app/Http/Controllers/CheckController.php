<?php

namespace App\Http\Controllers;

use App\Enums\CheckStatus;
use App\Http\Resources\Check as CheckResource;
use App\Models\Check;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CheckController extends Controller
{
    public function index()
    {
        return view('client.checks');
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
