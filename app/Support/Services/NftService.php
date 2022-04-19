<?php

namespace App\Support\Services;

use App\Models\Nft;
use App\Models\Game;
use App\Models\Tier;
use App\Models\User;
use App\Helpers\Price;
use App\Helpers\Status;
use App\Models\NftTier;
use App\Helpers\Moralis;
use App\Models\GameHistory;
use App\Models\Transaction;
use App\Support\Services\BaseService;
use Symfony\Component\HttpFoundation\Response;

class NftService extends BaseService
{
    public function __construct()
    {
        parent::__construct(Nft::class);
    }

    public function store()
    {
        $this->model->user_id = $this->request->user()->id;
        $this->model->token_id = $this->request->get('nftId');
        $this->model->status = (bool) !$this->request->get('isTransferredOut') ? Status::STATUS_ACTIVE : Status::STATUS_INACTIVE;

        if ($this->model->isDirty()) {
            $this->model->save();
        }

        $this->storeStars();

        return $this;
    }

    public function storeStars()
    {
        if ($this->request->has('stars') && !empty($this->request->get('stars'))) {

            $maxTier = Tier::select('stars_required')
                ->orderByDesc('stars_required')
                ->value('stars_required');

            $this->model->loadSum('stars', 'quantity');

            $newStars = $this->request->get('stars');

            if (($newStars + $this->model->stars_sum_quantity) <= $maxTier) {
                $this->model->stars()
                    ->create([
                        'quantity' => $newStars
                    ]);
            } else {
                abort(Response::HTTP_OK, 'Player\'s tiers has reached maximum');
            }
        }

        $this->checkNftTier();

        return $this;
    }

    public function checkNftTier()
    {
        $this->model->loadSum('stars', 'quantity')
            ->load(['currentTier']);

        $totalStars = $this->model->stars_sum_quantity ?? 0;

        $exactTier = Tier::select('id')
            ->where('stars_required', '>=', $totalStars)
            ->orderBy('stars_required')
            ->first();

        $currentTier = $this->model->currentTier->first();

        if (!$currentTier || $currentTier->id != $exactTier->id) {
            // set current tier to inactive if have any
            if ($currentTier) {
                NftTier::where('nft_id', $this->model->id)
                    ->where('tier_id', $currentTier->id)
                    ->update([
                        'status' => Status::STATUS_INACTIVE
                    ]);
            }

            // attach new tier
            $this->model->tiers()
                ->attach([$exactTier->id => ['status' => Status::STATUS_ACTIVE]]);
        }

        return $this;
    }
}
