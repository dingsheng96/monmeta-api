<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Support\Facades\ApiResponse;
use App\Http\Resources\PaginationResource;
use App\Http\Resources\GameHistoryResource;
use App\Http\Resources\TransactionResource;
use App\Support\Services\GameHistoryService;
use App\Support\Services\TransactionService;
use App\Http\Requests\Api\Transaction\TransactionListRequest;
use App\Http\Requests\Api\Transaction\StoreTransactionRequest;

class TransactionController extends Controller
{
    public function index(TransactionListRequest $request)
    {
        $transactions = Transaction::query()
            ->with('sourceable')
            ->when(!empty($request->get('fromDate')), fn ($query) => $query->whereDate('transaction_date', '>=', $request->get('fromDate')))
            ->when(!empty($request->get('toDate')), fn ($query) => $query->whereDate('transaction_date', '<=', $request->get('toDate')))
            ->whereHasMorph('sourceable', [User::class], fn ($query) => $query->where('wallet_id', $request->user()->wallet_id))
            ->orderByDesc('transaction_date')
            ->paginate($request->get('count'), ['*'], 'page', $request->get('page'))
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

            if (!$transaction) {
                return ApiResponse::setOkStatusCode()
                    ->setMessage('Invalid transaction hash!')
                    ->toFailJson();
            }

            return ApiResponse::withLog($transaction, $request->user(), 'Transaction', 'create')
                ->setOkStatusCode()
                ->setData((new TransactionResource($transaction))->toArray($request))
                ->toSuccessJson();
        });
    }
}
