<?php

namespace App\Enums;

enum ConferenceStatus: string
{
    case UPCOMING = 'upcoming';
    case CURRENT = 'current';
    case ENDED = 'ended';
    case ARCHIVED = 'archived';
}
