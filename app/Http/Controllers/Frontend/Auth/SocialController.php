<?php

namespace App\Http\Controllers\Frontend\Auth;

use App\CustomServices\ImageService;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Laravel\Socialite\Facades\Socialite;
use Laravel\Socialite\Two\InvalidStateException;

class SocialController extends Controller
{
    //

    public function handleRedirect($provider)
    {
        $provider= strtolower($provider);
        return Socialite::driver($provider)->redirect();
    }

    public function handleCallback($provider)
    {
        $provider= strtolower($provider);

        //$getInfo = Socialite::driver($provider)->user();

        try {
            $getInfo = Socialite::driver($provider)->user();
        } catch (InvalidStateException $e) {
            $getInfo = Socialite::driver($provider)->stateless()->user();
        }

        //dd($getInfo);
        $user = $this->createUser($getInfo,$provider);
        auth()->login($user);
        return redirect()->route('fe.home');
    }

    function createUser($getInfo,$provider){

        if ($getInfo['email']){

            $user = User::where('email',$getInfo->email)->first();

        }
        else{
            $user = User::where('provider_id', $getInfo->id)->first();
        }

        $provider= strtolower($provider);

        if (!$user) {

           $user = new User();
           $user->name = $getInfo->name;
           $user->email = $getInfo->email;
           $user->provider = $provider;
           $user->provider_id = $getInfo->id;
           $user->status=1;

           if($getInfo->avatar){

               $imageName = 'social'.time().'.jpg';
               $fileContents = file_get_contents($getInfo->avatar);
               File::put(public_path() . '/common/images/' .$imageName, $fileContents);

               $user->provider_image = $imageName;
           }

           $user->save();

           $user ->assignRole(3);
        }

        else{
            $user->provider = $provider;
            $user->provider_id = $getInfo->id;
            $user->status=1;

            if($getInfo->avatar){
                $imageName = 'social'.time().'.jpg';
                $fileContents = file_get_contents($getInfo->avatar);
                File::put(public_path() . '/common/images/' .$imageName, $fileContents);

                $oldFileName=$user->provider_image;
                $user->provider_image = $imageName;

                if (!empty($oldFileName) && $user->provider_image == $imageName) {
                    //delete the old photo
                    ImageService::deleteImage($oldFileName);

                    //import use File;
                    // $location=public_path('common/images/');
                    // File::delete($location.$oldFileName);
                }
            }

            $user->save();
            $user ->assignRole(3);

        }
        return $user;
    }
}
