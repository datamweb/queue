<?php

declare(strict_types=1);

namespace CodeIgniter\Queue\Enums;

enum Status: int
{
    case PENDING  = 0;
    case RESERVED = 1;
    case DONE     = 2;
}
