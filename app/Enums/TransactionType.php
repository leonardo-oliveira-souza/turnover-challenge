<?php

namespace App\Enums;

enum TransactionType: int
{
    case INCOMING = 1;
    case EXPENSE = 2;
}
