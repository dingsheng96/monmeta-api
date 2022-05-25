<?php

namespace App\Http\Controllers\Api;

use App\Models\Nft;
use App\Helpers\Status;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\NftResource;
use App\Http\Controllers\Controller;
use App\Support\Facades\ApiResponse;
use App\Support\Services\NftService;
use App\Http\Resources\PaginationResource;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Requests\Api\Nft\ShowNftDetailsRequest;
use App\Http\Requests\Api\Nft\StoreNftDetailsRequest;

class NftController extends Controller
{
    public function show(ShowNftDetailsRequest $request, NftService $nftService)
    {
        $nft = $nftService->setRequest($request)
            ->checkUserOwnedNft()
            ->getNftList();

        return ApiResponse::withLog(new Nft, $request->user(), 'NFT list')
            ->setOkStatusCode()
            ->setData(NftResource::collection($nft)->toArray($request))
            ->setPagination((new PaginationResource($nft))->toArray($request))
            ->toSuccessJson();
    }

    public function store(StoreNftDetailsRequest $request, NftService $nftService)
    {
        return DB::transaction(function () use ($request, $nftService) {
            $nft = $nftService
                ->setRequest($request)
                ->setModel(
                    $request->user()->nfts()
                        ->where('token_id', $request->get('nftId'))
                        ->where('status', Status::STATUS_ACTIVE)
                        ->firstOr(function () {
                            return new Nft();
                        })
                )
                ->store()
                ->getModel();

            return ApiResponse::withLog($nft, $request->user(), 'Nft', $nft->exists ? 'update' : 'create')
                ->setOkStatusCode()
                ->setData((new NftResource($nft))->toArray($request))
                ->toSuccessJson();
        });
    }
}
