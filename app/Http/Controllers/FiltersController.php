<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Filters;
use carbon\Carbon;

// Include the FiltersHelper file
require_once app_path('Helpers/FiltersHelper.php');
class FiltersController extends Controller
{
    /*
    function getRegions(){
        return getRegions();
    }
    function getProvinces(){
        return getProvinces();
    }
    function getMuncities(){
        return getMuncities();
    }
    */
    function getBrgys(){
        return getBrgys();
    }

    /*
    function getCompleteAdd($id){
        $get_brgy = DB::table('lib_brgy')
        ->leftJoin('lib_provinces as b_provinces', 'b_provinces.psgc_pcode', '=', 'lib_brgy.psgc_pcode')
        ->leftJoin('lib_regions as b_regions', 'b_regions.psgc_rcode', '=', 'lib_brgy.psgc_rcode')
        ->where('lib_brgy.brgy_id', '=', $id)
        ->get();

        return $get_brgy[0]->brgy .','. $get_brgy[0]->muncity .','. $get_brgy[0]->province .', '. $get_brgy[0]->region;
    }
    */
}