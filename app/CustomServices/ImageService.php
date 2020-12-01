<?php
/**
 * Created by PhpStorm.
 * User: MY PC
 * Date: 1/22/2019
 * Time: 12:05 PM
 */

namespace App\CustomServices;

use Storage;
use Image;

class ImageService
{
    //save Images
    public static function saveImage($image){

        //get filename with extension
        $filenameWithExt = $image->getClientOriginalName();

        //get just filename
        $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);

        //get extension
        $extension = $image->getClientOriginalExtension();

        // create new filename
        $filenameToStore = $filename . '_' . time() . '.' . $extension;

        $location = public_path('common/images/');
        $image->move($location, $filenameToStore);

        return $filenameToStore;
    }

    //delete Image
    public static function deleteImage($oldFileName){

        Storage::disk('customDisk')->delete('common/images/'.$oldFileName);

    }

    public static function saveMultipleSizeImage($image){

        //get filename with extension
        $filenameWithExt = $image->getClientOriginalName();

        //get just filename
        $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);

        //get extension
        $extension = $image->getClientOriginalExtension();

        // create new filename
        $filenameToStore = $filename . '_' . time() . '.' . $extension;


        $smallLocation =public_path('common/images/small/'.$filenameToStore);
        $mediumLocation =public_path('common/images/medium/'.$filenameToStore);

        Image::make($image)->resize(150,100)->save($smallLocation);
        Image::make($image)->resize(360,240)->save($mediumLocation);

        $location = public_path('common/images/');
        $image->move($location, $filenameToStore);


        return $filenameToStore;
    }

    //delete Image
    public static function deleteMultipleSizeImage($oldFileName){

        Storage::disk('customDisk')->delete('common/images/'.$oldFileName);
        Storage::disk('customDisk')->delete('common/images/small/'.$oldFileName);
        Storage::disk('customDisk')->delete('common/images/medium/'.$oldFileName);

    }
}