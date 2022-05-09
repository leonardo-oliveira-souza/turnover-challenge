<?php

namespace App\Models;

use App\Enums\TransactionType;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = [
        'account_id',
        'description',
        'type',
        'amount',
        'datetime',
    ];

    protected $casts = [
        'datetime' => 'datetime',
    ];

    public function account()
    {
        return $this->belongsTo(Account::class);
    }

    protected static function booted()
    {
        static::saved(function ($transaction) {
            $account = $transaction->account;
            $balance = $account->balance;

            if ($transaction->type === TransactionType::INCOMING->value) {
                $account->update([
                    'balance' => $balance + $transaction->amount,
                ]);
                return;
            }

            $account->update([
                'balance' => $balance - $transaction->amount,
            ]);
        });
    }
}
