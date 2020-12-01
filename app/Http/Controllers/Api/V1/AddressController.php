<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Repository\Api\V1\AddressRepository;

class AddressController extends Controller
{
    /**
     * @var AddressRepository
     */
    private $addressRepo;

    public function __construct(AddressRepository $addressRepo)
    {
        $this->addressRepo = $addressRepo;
    }

    /**
     * Gets all address
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAddressDetails()
    {
        return $this->addressRepo->getAddressDetails();
    }

    /**
     * Gets all municipality
     *
     * @return MunicipalityResource|\Illuminate\Http\JsonResponse
     */
    public function getMunicipality()
    {
        return $this->addressRepo->getMunicipality();
    }
}
