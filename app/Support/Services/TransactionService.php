<?php

namespace App\Support\Services;

use App\Models\Nft;
use App\Models\Game;
use App\Models\User;
use App\Helpers\Price;
use App\Helpers\Status;
use App\Helpers\Moralis;
use App\Models\GameHistory;
use App\Models\Transaction;
use App\Support\Services\BaseService;
use Symfony\Component\HttpFoundation\Response;

class TransactionService extends BaseService
{
    public function __construct()
    {
        parent::__construct(Transaction::class);
    }

    public function store()
    {
        $transaction = (new Moralis())->getTransaction($this->request->get('transactionHash'));

        if ($transaction) {

            $user = User::find($this->request->user()->id);

            return $this->model->create([
                'sourceable_type' => get_class($user),
                'sourceable_id' => $user->id,
                'type' => $this->request->get('type'),
                'hash_id' => $transaction['hash'],
                'status' => $transaction['receipt_status'] == '1' ? Status::STATUS_SUCCESS : Status::STATUS_FAIL,
                'amount' => $transaction['value'],
                'decimals' => 18, // ERC20
                'currency' => 'BNB',
                'transaction_date' => $transaction['block_timestamp'],
            ]);
        }

        return false;
    }
}
