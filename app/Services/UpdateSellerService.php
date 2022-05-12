<?php

namespace App\Services;

use App\Models\Seller;

class UpdateSellerService{

    public static function update($request,$id)
    {
        $seller = Seller::find($id);
        if($seller->phone == $request->phone)
        {
            Seller::whereId($id)->update($request->only('email','phone'));
            $seller->profile()->update($request->except('email','phone'));
            return response('',204);
        }

        $rules = [
            'phone' => 'digits:10|unique:sellers,phone'
        ];
        $validated1 = $request->validate($rules);
        Seller::whereId($id)->update($validated1);
        $seller->profile()->update($request->except('email','phone'));
        return response('',204);
    }
}

