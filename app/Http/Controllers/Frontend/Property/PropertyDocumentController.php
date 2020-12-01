<?php

namespace App\Http\Controllers\Frontend\Property;

use App\CustomServices\ImageService;
use App\CustomServices\VerificationRequestService;
use App\Property;
use App\PropertyDocument;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Validator;
use Session;

class PropertyDocumentController extends Controller
{
    //
    public function deleteDocument(Request $request,$id,$columnName){

        if ($request->ajax()) {
            $doc = PropertyDocument::find($id);

            $oldFileName = $doc->$columnName;

            $doc->$columnName = null;

            $doc->save();

            //delete image from Server
            if (!empty($oldFileName)) {
                //delete the old photo
                ImageService::deleteImage($oldFileName);
            }
        }
    }

    public function storeDocument(Request $request,$propertyId){

        $validator = Validator::make($request->all(), [
            'lal_purja' =>'required_without_all:ghar_naksa,trace_naksa,blueprint,charkilla,tax_receipt|max:5000|mimes:jpg,jpeg,png,doc,docx,odt,pdf',
            'ghar_naksa' =>'required_without_all:lal_purja,trace_naksa,blueprint,charkilla,tax_receipt|max:5000|mimes:jpg,jpeg,png,doc,docx,odt,pdf',
            'trace_naksa' =>'required_without_all:lal_purja,ghar_naksa,lal_purja,blueprint,charkilla|max:5000|mimes:jpg,jpeg,png,doc,docx,odt,pdf',
            'blueprint' =>'required_without_all:lal_purja,ghar_naksa,trace_naksa,charkilla,tax_receipt|max:5000|mimes:jpg,jpeg,png,doc,docx,odt,pdf',
            'charkilla' =>'required_without_all:lal_purja,ghar_naksa,trace_naksa,blueprint,tax_receipt|max:5000|mimes:jpg,jpeg,png,doc,docx,odt,pdf',
            'tax_receipt' =>'required_without_all:lal_purja,ghar_naksa,trace_naksa,blueprint,charkilla|max:5000|mimes:jpg,jpeg,png,doc,docx,odt,pdf',

        ]);

        if ($validator->fails()) {

            return redirect()->back()
                ->withErrors($validator)
                ->with('tabName','document-id');
        }

        // dd($request);

        $property = Property::findOrFail($propertyId);

        //continue if only property exists
        $propertyDocument = PropertyDocument::where('property_id',$property->id)->first();

        if (is_null($propertyDocument)){

            $propertyDocument = new PropertyDocument();
        }

        //saving property document files
        $propertyDocument->property_id = $property->id;
        //saving property document files
        if ($request->hasFile('lal_purja')) {

            $filenameToStore=ImageService::saveImage($request->file('lal_purja'));

            $oldFileName=$propertyDocument->lal_purja;
            $propertyDocument->lal_purja=$filenameToStore;

            //delete image from Server
            if (!empty($oldFileName) && $propertyDocument->lal_purja == $filenameToStore) {
                //delete the old photo
                ImageService::deleteImage($oldFileName);
            }
        }

        if ($request->hasFile('ghar_naksa')) {

            $filenameToStore=ImageService::saveImage($request->file('ghar_naksa'));

            $oldFileName=$propertyDocument->ghar_naksa;
            $propertyDocument->ghar_naksa=$filenameToStore;

            //delete image from Server
            if (!empty($oldFileName) && $propertyDocument->ghar_naksa == $filenameToStore) {
                //delete the old photo
                ImageService::deleteImage($oldFileName);
            }
        }

        if ($request->hasFile('trace_naksa')) {

            $filenameToStore=ImageService::saveImage($request->file('trace_naksa'));

            $oldFileName=$propertyDocument->trace_naksa;
            $propertyDocument->trace_naksa=$filenameToStore;

            //delete image from Server
            if (!empty($oldFileName) && $propertyDocument->trace_naksa == $filenameToStore) {
                //delete the old photo
                ImageService::deleteImage($oldFileName);
            }
        }

        if ($request->hasFile('blueprint')) {

            $filenameToStore=ImageService::saveImage($request->file('blueprint'));

            $oldFileName=$propertyDocument->blueprint;
            $propertyDocument->blueprint=$filenameToStore;

            //delete image from Server
            if (!empty($oldFileName) && $propertyDocument->blueprint == $filenameToStore) {
                //delete the old photo
                ImageService::deleteImage($oldFileName);
            }
        }

        if ($request->hasFile('charkilla')) {

            $filenameToStore=ImageService::saveImage($request->file('charkilla'));

            $oldFileName=$propertyDocument->charkilla;
            $propertyDocument->charkilla=$filenameToStore;

            //delete image from Server
            if (!empty($oldFileName) && $propertyDocument->charkilla == $filenameToStore) {
                //delete the old photo
                ImageService::deleteImage($oldFileName);
            }
        }
        if ($request->hasFile('tax_receipt')) {

            $filenameToStore=ImageService::saveImage($request->file('tax_receipt'));

            $oldFileName=$propertyDocument->tax_receipt;
            $propertyDocument->tax_receipt=$filenameToStore;

            //delete image from Server
            if (!empty($oldFileName) && $propertyDocument->tax_receipt == $filenameToStore) {
                //delete the old photo
                ImageService::deleteImage($oldFileName);
            }
        }

        $propertyDocument->save();

        $property->verify_status = 'pending';

        $property->save();

        VerificationRequestService::sendVerificationRequestNotificationsToaAdmin($property);

        Session::flash('success', 'Property Documents Has Been Updated!');
        return redirect()->back()->with('tabName','document-id');
    }
}
