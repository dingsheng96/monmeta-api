<?php

use App\Models\Transaction;

return [
    'api' => [
        'list' => ':module retrieve successfully!',
        'create' => ':module stored successfully!',
        'update' => ':module updated successfully!',
        'default_error' => 'Errors found! Please contact administrator.'
    ],
    'transaction_description' => [
        Transaction::TYPE_PURCHASE_NFT => 'Purchase of User ID NFT',
        Transaction::TYPE_PURCHASE_TICKET => 'Purchase of 1 game season',
        Transaction::TYPE_REWARD_PRIZE => 'Game season 1 prize distribution',
        Transaction::TYPE_REWARD_BONUS => 'Game season 1 bonus prize distribution'
    ]
];
