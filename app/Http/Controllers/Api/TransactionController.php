<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Support\Facades\ApiResponse;
use App\Http\Resources\PaginationResource;
use App\Http\Resources\TransactionResource;
use App\Support\Services\TransactionService;
use App\Http\Requests\Api\Transaction\TransactionListRequest;
use App\Http\Requests\Api\Transaction\StoreTransactionRequest;

class TransactionController extends Controller
{
    public function index(TransactionListRequest $request)
    {
        $transactions = Transaction::query()
            ->with('sourceable')
            ->when(!empty($request->get('transactionHash')), fn ($query) => $query->where('hash_id', $request->get('transactionHash')))
            ->when(!empty($request->get('transactionType')), fn ($query) => $query->where('type', $request->get('transactionType')))
            ->when(!empty($request->get('status')), fn ($query) => $query->where('status', $request->get('status')))
            ->when(!empty($request->get('gameSeasonId')), fn ($query) => $query->where('game_season_id', $request->get('gameSeasonId')))
            ->when(!empty($request->get('fromDate')), fn ($query) => $query->whereDate('transaction_date', '>=', $request->get('fromDate')))
            ->when(!empty($request->get('toDate')), fn ($query) => $query->whereDate('transaction_date', '<=', $request->get('toDate')))
            ->whereHasMorph('sourceable', [User::class], fn ($query) => $query->where('wallet_id', $request->user()->wallet_id))
            ->orderByDesc('transaction_date')
            ->paginate($request->get('itemsCount'), ['*'], 'page', $request->get('page'))
            ->withQueryString();

        return ApiResponse::withLog(new Transaction(), null, 'Transactions')
            ->setOkStatusCode()
            ->setData(TransactionResource::collection($transactions)->toArray($request))
            ->setPagination((new PaginationResource($transactions))->toArray($request))
            ->toSuccessJson();
    }

    public function store(StoreTransactionRequest $request, TransactionService $transactionService)
    {
        return DB::transaction(function () use ($request, $transactionService) {

            $transaction = $transactionService
                ->setRequest($request)
                ->store();

            return ApiResponse::withLog($transaction, $request->user(), 'Transaction', 'create')
                ->setOkStatusCode()
                ->setData((new TransactionResource($transaction))->toArray($request))
                ->toSuccessJson();
        });
    }
}
