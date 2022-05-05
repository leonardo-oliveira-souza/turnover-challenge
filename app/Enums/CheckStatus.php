<?php

namespace App\Enums;

enum CheckStatus: int
{
    case PENDING = 0;
    case ACCEPTED = 1;
    case REJECTED = 2;
}
