<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Repository\Api\V1\AuthRepository;

class AuthController extends Controller
{
    /**
     * @var LoginRepository
     */
    private $authRepo;

    public function __construct(AuthRepository $authRepo)
    {
        $this->authRepo = $authRepo;
    }

    /**
     * Logs a user in
     *
     * @return UserResource
     */
    public function login()
    {
        return $this->authRepo->login();
    }

    /**
     * Registers a user
     *
     * @return UserResource
     */
    public function registerUser()
    {
        return $this->authRepo->registerUser();
    }

    /**
     * Logs in through provider
     *
     * @return string
     */

    public function providerLogin()
    {
        return $this->authRepo->providerLogin();
    }

    /**
     * Logs a user out of device
     *
     * @return string
     */

    public function logout()
    {
        return $this->authRepo->logout();
    }
}
