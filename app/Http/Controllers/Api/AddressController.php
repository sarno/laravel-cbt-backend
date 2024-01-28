<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AddressController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // dd($request->user()->id);
        $address = DB::table('addresses')
        ->where('user_id', $request->user()->id)
        ->get();

        return response()->json([
            'status' => true,
            'data' => $address
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //save address
        $address = DB::table('addresses')->insert([
            'name' => $request->name,
            'user_id' => $request->user()->id,
            'full_address' => $request->name,
            'phone' => $request->phone,
            'prov_id' => $request->prov_id,
            'city_id' => $request->city_id,
            'district_id' => $request->district_id,
            'postal_code' => $request->postal_code,
            'is_default' => $request->is_default,

        ]);

        if ($address) {
            return response()->json([
                'status' => 'success',
                'message' => 'Address created successfully'
            ]);
        } else{
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to create address'
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
