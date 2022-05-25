<?php

namespace App\Helpers;

use App\Models\Nft;
use App\Traits\HasApiLog;
use Illuminate\Support\Facades\Http;
use Illuminate\Database\Eloquent\Model;
use Symfony\Component\HttpFoundation\Response;

class Moralis
{
    use HasApiLog;

    protected $moralisApiKey, $chain;

    public function __construct()
    {
        $this->chain = env('WEB3_CHAIN');
        $this->moralisApiKey = env('MORALIS_API_KEY');
    }

    public function setChain(string $chain = null)
    {
        if (!empty($chain)) {
            $this->chain = $chain;
        }

        return $this;
    }

    public function getTransaction(string $hash)
    {
        $meta = [
            'endpoint' => str_replace("{HASH_ID}", $hash, env('MORALIS_TRANSACTION_CHECK_URL')),
            'headers' => ["X-API-Key" => $this->moralisApiKey],
            'params' => ['chain' => $this->chain]
        ];

        $this->setProperties($meta)
            ->saveApiLog('transaction request', 'moralis');

        $response = Http::acceptJson()
            ->withHeaders($meta['headers'])
            ->get($meta['endpoint'], $meta['params']);

        if ($response->successful() && !empty($response->json())) {

            $this->setProperties($response->json())
                ->saveApiLog('transaction response', 'moralis');

            return $response->json();
        }

        throw new \Exception($response->body(), Response::HTTP_OK);
    }

    public function getUserNftList(string $walletId): array
    {
        $meta = [
            'endpoint' => str_replace("{ADDRESS_ID}", $walletId, env('MORALIS_USER_NFT_URL')),
            'headers' => ["X-API-Key" => $this->moralisApiKey],
            'params' => ['chain' => $this->chain, 'format' => 'decimal', 'limit' => 100, 'cursor' => ""]
        ];

        $datas = [];
        $cursor = $meta['params']['cursor'];

        do {
            $this->setProperties($meta)
                ->saveApiLog('user NFT request', 'moralis');

            $response = Http::acceptJson()
                ->withHeaders($meta['headers'])
                ->get($meta['endpoint'], $meta['params']);

            if ($response->successful()) {
                if (!empty($response->json())) {
                    $this->setProperties($response->json())
                        ->saveApiLog('user NFT response', 'moralis');

                    $result = $response->json();

                    foreach ($result['result'] as $data) {
                        $index = $data['name'] . $data['token_id'];
                        $datas[$index] = $data;
                    }

                    $cursor = $meta['params']['cursor'] = $result['cursor'];
                }
            } else {

                $this->setProperties($response->json())
                    ->saveApiLog('user NFT response', 'moralis');

                throw new \Exception('Errors returned from Moralis!', Response::HTTP_INTERNAL_SERVER_ERROR);

                break;
            }
        } while (!empty($cursor));

        return $datas;
    }

    public function getUserNftTokenUniqueId(string $walletId)
    {
        $nftList = $this->getUserNftList($walletId); // datas

        $tokens = [];

        foreach ($nftList as $nft) {
            $tokens[] = $nft['name'] . $nft['token_id'];
        }

        return $tokens;
    }

    public function getUserNftDetails(string $walletId, string $nftId)
    {
        $nftList = $this->getUserNftList($walletId);

        if (!array_key_exists($nftId, $nftList)) {
            $nft = Nft::active()
                ->where('token_id', $nftId)
                ->whereHas('user', fn ($query) => $query->where('wallet_id', $walletId))
                ->first();

            if ($nft) {
                $nft->status = Status::STATUS_INACTIVE;
                $nft->save();
            }

            return;
        }

        return $nftList[$nftId];
    }

    public function withLog(Model $subject, Model $causer = null, string $moduleName, $action = 'list')
    {
        $this->setSubject($subject)
            ->setCauser($causer ?? request()->user())
            ->setMessage(trans('messages.api.' . $action, ['module' => $moduleName]));

        return $this;
    }
}
