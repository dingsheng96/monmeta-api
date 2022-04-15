<?php

namespace App\Http\Controllers\Api;

use App\Models\Country;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Support\Facades\ApiResponse;
use App\Http\Resources\CountryResource;

class CountryController extends Controller
{
    public function index(Request $request)
    {
        $countries = Country::orderBy('name')->get();

        return ApiResponse::withLog(new Country())
            ->setOkStatusCode()
            ->setData(CountryResource::collection($countries)->toArray($request))
            ->toSuccessJson();
    }
}
