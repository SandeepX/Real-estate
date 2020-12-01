<?php

namespace App\Http\Controllers\Common;

use App\District;
use App\Municipal;
use App\Province;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProvinceDistrictController extends Controller
{
    //from ajax register form

    public function getProvinceDistricts($provinceId){

        $province = Province::findOrFail($provinceId);

        $provinceDistricts = District::where('province_id',$province->id)->orderBy('district_name','asc')->get();

        return response()->json($provinceDistricts);

    }

    public function getDistrictMunicipals($districtId){

        $district = District::findOrFail($districtId);

        $districtMunicipals = Municipal::where('district_id',$district->id)->orderBy('municipal_name','asc')->get();

        return response()->json($districtMunicipals);
    }
}
