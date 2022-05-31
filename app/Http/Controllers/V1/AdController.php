<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAdRequest;
use Illuminate\Http\Request;
use App\Models\Ad;
use Illuminate\Support\Facades\Storage;
use Spatie\Image\Image;

class AdController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ad = Ad::where([['type','MS'],['size','360x640']])->first();

        return response(['data' => $ad],200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAdRequest $request)
    {
        if($request->validated())
        {
            $image_name = uniqid() . '.' . $request->file('ad')->extension();
            $path = $request->file('ad')->storeAs('public/ad',$image_name);
            $path = str_replace('public','storage',$path);
            Ad::create([
                'path' => $path,
                'type' => 'MS',
                'size' => '360x640'
            ]);
            return response(['message' => 'created !'],200);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreAdRequest $request, $id)
    {
        Ad::delete();
        if($request->validated())
        {
            $image_name = uniqid() . '.' . $request->file('ad')->extension();
            $path = $request->file('ad')->storeAs('public/ad',$image_name);
            $path = str_replace('public','storage',$path);
            Ad::create([
                'path' => $path,
                'type' => 'MS',
                'size' => '360x640'
            ]);
            return response(['message' => 'created !'],200);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $ad = Ad::findOrFail($id);
            $image_name = str_replace('storage/ad/','',$ad->path);
            $image_name = str_replace(env('APP_URL'),'',$image_name);
            Storage::delete('public/ad/' . $image_name);
            $ad->delete();
            return response()->noContent();
        }catch (\Exception $exception)
        {
            return response(['message' => 'not found'],404);
        }
    }

    public function resize(int $width,int $height)
    {
        $ad = Ad::where([['type','MS'],['size','360x640']])->first();
        $image_name = str_replace(env('APP_URL'),'',$ad->path);
        $save_image_name = uniqid() . '.jpg';
        $save_path = '../storage/app/public/ad/' . $save_image_name;
        Image::load($image_name)->width($width)->height($height)->save($save_path);

        $path = 'storage/ad/' . $save_image_name;
        $size = $width . 'x' . $height;

        $created_ad = Ad::create([
            'path' => env('APP_URL') . $path,
            'type' => 'MS',
            'size' => $size
        ]);
        return response(['data' => $created_ad],200);

    }
}
