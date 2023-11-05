<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddShippingAddressRequest;
use App\Http\Requests\UpdateShippingAddressRequest;
use App\Models\ShippingAddress;
use Illuminate\Http\Request;

class ShippingAddressController extends Controller
{
    public function addShippingAddress(AddShippingAddressRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = auth()->user()->id;

        $shippingAddress = ShippingAddress::create($data);

        return response()->json([
            'message' => 'Shipping address created successfully',
            'shipping address ' => $shippingAddress
        ], 201);
    }


    public function userShippingAddresses()
    {
        $shippingAddresses = ShippingAddress::where('user_id', auth()->user()->id)->get();

        return response()->json(['shippingAddresses' => $shippingAddresses], 200);
    }

    public function updateShippingAddress(UpdateShippingAddressRequest $request, ShippingAddress $shippingAddress)
    {
        $data = $request->validated();

        if ($shippingAddress->user_id !== auth()->user()->id) {
            return response()->json([['message' => 'Unauthorized'], 403]);
        }
        $shippingAddress->update($data);
        return response()->json(['message' => 'Shipping address updated successfully'], 200);
    }
}
