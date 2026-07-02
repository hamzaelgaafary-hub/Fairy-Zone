<?php

namespace App\Http\Controllers;

abstract class Controller
{
    /* Note that 
     In checkout controller add this 

    $address = $request->user()->defaultAddress;

    Order::create([
        'user_id'              => auth()->id(),
        'order_number'         => 'ORD-' . strtoupper(Str::random(8)),
        'total_amount'         => $total,
        'payment_method'       => $request->payment_method,
        'shipping_name'        => $address->name ?? $request->user()->name,
        'shipping_phone'       => $address->phone,
        'shipping_address'     => $address->address,
        'shipping_city'        => $address->city,
        'shipping_governorate' => $address->governorate,
        'notes'                => $request->notes,
    ]);
    */
}
