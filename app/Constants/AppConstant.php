<?php

namespace App\Constants;

class AppConstant
{
    const ACTIVE = 1;
    const DISABLE = 0;

    const DRAFT = 'draft';
    const PENDING = 'pending';
    const COMPLETE = 'complete';
    const APPROVED = 'approved';
    const REJECTED = 'rejected';
    const PROCESSED = 'processed';
    const HOLD = 'hold';
    const CHECKED = 'checked';

    const COMMON_STATUS = [
        self::DRAFT => 'Draft',
        self::COMPLETE => 'Complete',
        self::APPROVED => 'Approved',
        self::REJECTED => 'Reject',
    ];

}
