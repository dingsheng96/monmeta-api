<?php

namespace App\Helpers;

class Status
{
    const STATUS_ACTIVE = 'active';
    const STATUS_INACTIVE = 'inactive';
    const STATUS_SUCCESS = 'success';
    const STATUS_FAIL = 'fail';

    public function getTransactionStatus()
    {
        return [
            self::STATUS_SUCCESS,
            self::STATUS_FAIL,
        ];
    }

    public function getNftStatus()
    {
        return [
            self::STATUS_ACTIVE,
            self::STATUS_INACTIVE
        ];
    }
}
