<?php

namespace App\Helpers;

use App\Traits\HasApiLog;
use Illuminate\Support\Facades\Http;
use Illuminate\Database\Eloquent\Model;

class Moralis
{
    use HasApiLog;

    public function getTransaction(string $hash)
    {
        $moralisApiKey = env('MORALIS_API_KEY');
        $moralisUrl = env('MORALIS_TRANSACTION_CHECK_URL');
        $chain = env('WEB3_CHAIN');

        $meta = [
            'endpoint' => str_replace("{HASH_ID}", $hash, $moralisUrl),
            'headers' => ["X-API-Key" => $moralisApiKey],
            'params' => ['chain' => $chain]
        ];

        $this->setProperties($meta)
            ->saveApiLog('transaction_request', 'moralis');

        $response = Http::acceptJson()
            ->withHeaders($meta['headers'])
            ->get($meta['endpoint'], $meta['params']);

        if (!empty($response->json())) {

            $this->setProperties($response->json())
                ->saveApiLog('transaction_response', 'moralis');

            if ($response->successful()) {
                return $response->json();
            }
        }

        return false;
    }

    public function withLog(Model $subject, Model $causer = null, string $moduleName, $action = 'list')
    {
        $this->setSubject($subject)
            ->setCauser($causer ?? request()->user())
            ->setMessage(trans('messages.api.' . $action, ['module' => $moduleName]));

        return $this;
    }
}
