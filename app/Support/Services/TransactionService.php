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
        $transaction = (new Moralis())
            ->setChain($this->request->get('chain'))
            ->getTransaction($this->request->get('transactionHash'));

        if ($transaction) {

            $user = User::find($this->request->user()->id);

            $data = [
                'user_id' => $user->id,
                'type' => $this->request->get('type'),
                'game_season_id' => $this->request->get('gameSeasonId'),
                'hash_id' => $transaction['hash'],
                'status' => $transaction['receipt_status'] == '1' ? Status::STATUS_SUCCESS : Status::STATUS_FAIL,
                'transaction_date' => $transaction['block_timestamp'],
                'decimals' => 18, // ERC20
                'usdt' => $this->request->get('usdt_value', 0),
                'mspc' => $this->request->get('mspc_value', 0),
            ];

            if (!empty($this->request->get('nftId'))) {

                $userNft = Nft::active()
                    ->where('user_id', $this->request->user()->id)
                    ->where('token_id', $this->request->get('nftId'))
                    ->firstOr(function () {
                        return new Nft();
                    });

                $nft = (new NftService())
                    ->setRequest($this->request)
                    ->setModel($userNft)
                    ->store()
                    ->getModel();

                $data = array_merge($data, ['nft_id' => $nft->id]);
            }

            return $this->model->create($data);
        }

        return $this;
    }
}
