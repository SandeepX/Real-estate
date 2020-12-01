<?php

namespace App\Repository\Api\V1;

use Illuminate\Http\Request;
use App\Province;
use App\District;
use App\Municipal;
use App\Http\Resources\ProvinceResource;
use App\Http\Resources\DistrictResource;
use App\Http\Resources\MunicipalityResource;

class AddressRepository
{
    /**
     * @var Request
     */
    private $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * Gets all address
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAddressDetails()
    {
        return response()->json([
            "data"             => $this->getProvince(),
            "error"            => false,
            "code"             => 200
        ]);
    }

    /**
     * Gets all province
     *
     * @return ProvinceResource|\Illuminate\Http\JsonResponse
     */
    public function getProvince()
    {
        return ProvinceResource::collection(Province::all());
    }

    /**
     * Gets all district
     *
     * @return DistrictResource|\Illuminate\Http\JsonResponse
     */
    public function getDistrict()
    {
        return DistrictResource::collection(District::all());
    }

    /**
     * Gets all municipality
     *
     * @return MunicipalityResource|\Illuminate\Http\JsonResponse
     */
    public function getMunicipality()
    {
        return MunicipalityResource::collection(Municipal::all());
    }
}
