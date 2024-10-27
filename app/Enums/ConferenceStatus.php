<?php

namespace App\Enums;

enum ConferenceStatus: string
{
    case Upcoming = 'upcoming';
    case Current = 'current';
    case Ended = 'ended';
    case Archived = 'archived';
}
