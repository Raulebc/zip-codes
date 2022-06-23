<?php

namespace App\Http\Controllers;

use App\Models\ZipCode;
use App\Http\Resources\ZipCodeResource;
use App\Http\Requests\StoreZipCodeRequest;
use App\Http\Requests\UpdateZipCodeRequest;

class ZipCodeController extends Controller
{
    /**
     *  Display the specified resource.
     *
     *  @param   \App\Models\ZipCode         $zip_code
     *
     *  @return  \Illuminate\Http\Response
     */
    public function show(ZipCode $zip_code)
    {
        // return error response if zip code is not found
        if (!$zip_code) {
            return response()->json([
                'message' => 'Zip code not found',
            ], 404);
        }
        
        return new ZipCodeResource($zip_code);
    }
}
