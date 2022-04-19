<?php

namespace App\Http\Controllers\Api;

use App\Models\Nft;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\NftResource;
use App\Http\Controllers\Controller;
use App\Support\Facades\ApiResponse;
use App\Support\Services\NftService;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Requests\Api\Nft\ShowNftDetailsRequest;
use App\Http\Requests\Api\Nft\StoreNftDetailsRequest;

class NftController extends Controller
{
    public function show(ShowNftDetailsRequest $request)
    {
        $nft = Nft::query()
            ->with(['currentTier', 'gameHistories', 'user.transactions'])
            ->withCount('gameHistories')
            ->withMax('gameHistories', 'points')
            ->withMin('gameHistories', 'points')
            ->withAvg('gameHistories', 'points')
            ->withSum('gameHistories', 'points')
            ->withSum('gameHistories', 'duration')
            ->withSum('stars', 'quantity')
            ->where('token_id', $request->get('nftId'))
            ->where('user_id', $request->user()->id)
            ->first();

        abort_if(!$nft, Response::HTTP_OK, 'No nft was found!');

        return ApiResponse::withLog($nft, $request->user(), 'Nft details')
            ->setOkStatusCode()
            ->setData((new NftResource($nft))->toArray($request))
            ->toSuccessJson();
    }

    public function store(StoreNftDetailsRequest $request, NftService $nftService)
    {
        return DB::transaction(function () use ($request, $nftService) {

            $nft = $nftService
                ->setRequest($request)
                ->setModel(Nft::firstOrNew(['token_id' => $request->get('nftId')]))
                ->store()
                ->getModel();

            return ApiResponse::withLog($nft, $request->user(), 'Nft', $nft->exists ? 'update' : 'create')
                ->setOkStatusCode()
                ->setData((new NftResource($nft))->toArray($request))
                ->toSuccessJson();
        });
    }
}
