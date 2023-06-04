<?php

namespace App\Enums;

// make enum ReservationEnum
enum ReservationEnum: string
{
    case Pending = 'pending';
    case Confirmed = 'confirmed';
    case Rejected = 'rejected';
    case Cancelled = 'cancelled';
}
