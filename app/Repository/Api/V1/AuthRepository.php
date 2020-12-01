<?php

namespace App\Repository\Api\V1;

use App\User;
use Illuminate\Http\Request;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class AuthRepository
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
     * Logs a user in
     *
     * @return UserResource|\Illuminate\Http\JsonResponse
     */
    public function login()
    {
        if ($this->request->filled("email")) {
            $auth = auth()->attempt($this->request->only(['email', 'password']));

            if ($auth) {
                $user = auth()->user();
                if ($user->status == 0) {
                    return sendResponse("Please verify your email address.", true);
                }
                $user->api_token = $this->generateApiToken();
                if ($this->request->filled('device_token')) {
                    $user->device_token = $this->request->device_token;
                }
                $user->save();
                return new UserResource($user);
            }
            return sendResponse('Your credentials do not match. Please try again with valid credentials.', true, 404);
        } else if ($this->request->filled("phone")) {
            $auth = auth()->attempt($this->request->only(['phone', 'password']));
            if ($auth) {
                $user = auth()->user();
                if ($user->status == 0) {
                    return sendResponse("Please verify your email address.", true);
                }
                $user->api_token = $this->generateApiToken();
                if ($this->request->filled('device_token')) {
                    $user->device_token = $this->request->device_token;
                }
                $user->save();
                return new UserResource($user);
            } else {
                return sendResponse('Your credentials do not match. Please try again with valid credentials.', true, 404);
            }
        } else {
            return sendResponse('Please try logging in with valid credentials.', true, 404);
        }
    }

    /**
     * Registers a user
     *
     * @return Illuminate\Http\JsonResponse
     */
    public function registerUser()
    {

        // checking if user already exits
        if ($this->request->filled("email")) {
            $usersCount = User::where('email', $this->request->email)->count();
        } else {
            return sendResponse('Email field is required.', true, 404);
        }
        if ($usersCount > 0) {
            return sendResponse('Email already exists. Please log in.', true, 422);
        } else {

            $user = new User;

            if ($this->request->filled("name")) {
                $user->name  = ucwords(strtolower($this->request->name));
            } else {
                return sendResponse('Name field is required.', true, 404);
            }
            $user->email = strtolower($this->request->email);
            if ($this->request->filled("password")) {
                $user->password = bcrypt($this->request->password);
            } else {
                return sendResponse('Password field is required.', true, 404);
            }
            if ($this->request->filled("province_id")) {
                $user->province_id = $this->request->province_id;
            } else {
                return sendResponse('Province id field is required.', true, 404);
            }
            if ($this->request->filled("district_id")) {
                $user->district_id = $this->request->district_id;
            } else {
                return sendResponse('District id field is required.', true, 404);
            }
            if ($this->request->filled("municipality_id")) {
                $user->municipality_id = $this->request->municipality_id;
            } else {
                return sendResponse('Municipality id field is required.', true, 404);
            }
            if ($this->request->filled("address")) {
                $user->address = ucwords(strtolower($this->request->address));
            } else {
                return sendResponse('Address field is required.', true, 404);
            }
            if ($this->request->filled("phone")) {
                $user->phone = $this->request->phone;
            } else {
                return sendResponse('Phone field is required.', true, 404);
            }

            $user->token  = str_random(40);
            $user->status = 0;

            $user->save();

            $user->assignRole(3);

            $user->sendConfirmationMail($user);

            return sendResponse("A Verification Email Has Been Sent To Your E-Mail Address. Please Verify To Login.");
        }
    }

    /**
     * Logs in through provider
     *
     * @return string
     */

    public function providerLogin()
    {

        // checking if user already exits
        if ($this->request->filled("email")) {
            $user = User::where('email', $this->request->email)->first();
        } else if ($this->request->filled("phone")) {
            $user = User::where('phone', $this->request->phone)->first();
        } else {
            return sendResponse('Email or phone field is required.', true, 404);
        }

        if ($user) {

            $user->name        = $this->request->name;
            $user->provider    = $this->request->provider;
            $user->provider_id = $this->request->provider_id;
            $user->api_token   = $this->generateApiToken();
            if ($this->request->filled('device_token')) {
                $user->device_token = $this->request->device_token;
            }
            $user->save();

            return new UserResource($user);
        } else {
            $user = new User;

            if ($this->request->filled("image")) {
                $imageName = 'social' . time() . '.jpg';
                $fileContents = file_get_contents($this->request->image);
                File::put(public_path() . '/common/images/' . $imageName, $fileContents);
                $user->user_image = $imageName;
            }

            if ($this->request->filled('name'))
                $user->name = $this->request->name;

            $user->email       = $this->request->email;

            if ($this->request->filled("provider")) {
                $user->provider    = $this->request->provider;
            } else {
                return sendResponse('Provider field is required.', true, 404);
            }

            if ($this->request->filled("provider_id")) {
                $user->provider_id = $this->request->provider_id;
            } else {
                return sendResponse('Provider id field is required.', true, 404);
            }

            if ($this->request->filled('phone'))
                $user->phone = $this->request->phone;

            if ($this->request->filled('address'))
                $user->address = $this->request->address;

            $user->api_token   = $this->generateApiToken();
            if ($this->request->filled('device_token')) {
                $user->device_token = $this->request->device_token;
            }
            $user->save();
            return new UserResource($user);
        }
    }

    /**
     * Logs a user out of device
     *
     * @return string
     */

    public function logout()
    {
        $user = auth()->user();
        $user->api_token = null;
        $user->save();
        return sendResponse('Logged out successfully', false, 200);
    }

    /**
     * Generate an unique api_token
     *
     * @return string
     */
    public function generateApiToken()
    {
        $api_token = str_random(60);
        $user = User::where('api_token', $api_token)->first();
        if ($user) {
            $this->generateApiToken();
        }
        return $api_token;
    }
}
