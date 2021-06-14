<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

final class CreditType extends Enum
{
    // if is_carnagie 1 then not from california
    const NotCaliforniaTotalCredit = 7.25;
    const CaliforniaTotalCredit = 72.5;
}
