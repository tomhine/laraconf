<?php

namespace App\Enums;

enum ConferenceStatus: string
{
    case Upcoming = 'Upcoming';
    case Current = 'Current';
    case Ended = 'Ended';
    case Archived = 'Archived';
}
