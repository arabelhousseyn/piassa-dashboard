<?php

namespace App\Http\Controllers\V1;

use App\Events\NewRequestEvent;
use App\Events\NewSuggestionEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\SotreSellerJobTypes;
use App\Http\Requests\StoreSellerJobRequest;
use App\Http\Requests\StoreSellerJobSigns;
use App\Http\Requests\StoreSellerPhoneRequest;
use App\Http\Requests\StoreSellerRequest;
use App\Http\Requests\StoreSellerSuggestionRequest;
use App\Http\Requests\UpdateSellerRequest;
use App\Services\UpdateSellerService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use App\Models\{Seller, SellerJob, SellerJobSign, SellerJobType, SellerPhone, SellerRequest, UserRequest};
use Illuminate\Http\Request;
use App\Traits\CustomPushNotificationTrait;
class SellerController extends Controller
{
    use CustomPushNotificationTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sellers = Seller::withTrashed()->with('profile.province','signs','types','job','phones')->latest('created_at')->get();
        return response(['data' => $sellers],200);
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
    public function store(StoreSellerRequest $request)
    {
        if($request->validated())
        {
            $hash_password = Hash::make($request->password_confirmation);
            $password = ['password' => $hash_password];
            $seller = Seller::create(array_merge($password,$request->only('phone','email')));
            $seller->profile()->create($request->except('phone','email'));
            $job = $seller->job()->create($request->only('job'));

            collect($request->types)->map(function ($type) use ($job){
                $job->types()->create($type);
            });

            collect($request->signs)->map(function ($sign) use ($job){
                $job->signs()->create($sign);
            });

            return response('',204);
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
    public function update(Request $request, $id)
    {
        return UpdateSellerService::update($request,$id);
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
            $user = Seller::withTrashed()->findOrFail($id);
            if(!$user->trashed())
            {
                $user->delete();
                return response('',204);
            }
            $data = [
                'data' => [
                    'message' => __('messages.user_delete_error')
                ]
            ];
            return response($data,422);
        }catch (\Exception $e)
        {
            $data = [
                'data' => [
                    'message' => __('messages.user_not_found')
                ]
            ];
            return response($data,422);
        }
    }

    public function restore($id)
    {
        try {
            $user = Seller::withTrashed()->findOrFail($id);
            if($user->trashed())
            {
                $user->restore();
                return response('',204);
            }
            $data = [
                'data' => [
                    'message' => __('messages.user_not_deleted')
                ]
            ];
            return response($data,422);
        }catch (\Exception $e)
        {
            $data = [
                'data' => [
                    'message' => __('messages.user_not_found')
                ]
            ];
            return response($data,422);
        }
    }

    public function sellerPhones($seller_id)
    {
        try {
            $seller = Seller::withTrashed()->with('phones')->findOrFail($seller_id);
            return response(['data' => $seller->phones],200);
        }catch (\Exception $exception)
        {
            return response(['message' => 'not found'],404);
        }
    }

    public function storeSellerPhones(StoreSellerPhoneRequest $request)
    {
        if($request->validated())
        {
                SellerPhone::create($request->only('name','phone','seller_id'));
                return response()->noContent();
        }
    }

    public function destroySellerPhone($seller_phone_id)
    {
        try {
            $seller_phone = SellerPhone::withTrashed()->findOrFail($seller_phone_id);
            if(!$seller_phone->trashed())
            {
                $seller_phone->delete();
                return response('',204);
            }
            $data = [
                'data' => [
                    'message' => __('messages.user_not_deleted')
                ]
            ];
            return response($data,422);
        }catch (\Exception $e)
        {
            $data = [
                'data' => [
                    'message' => __('messages.user_not_found')
                ]
            ];
            return response($data,422);
        }
    }

    public function updateSellerPhone(Request $request,$seller_phone_id)
    {

            $seller_phone = SellerPhone::findOrFail($seller_phone_id);
            if($seller_phone->phone == $request->phone)
            {
                SellerPhone::whereId($seller_phone_id)->update($request->only('name'));
                return response('',204);
            }

            $rules = [
                'name' => 'required',
                'phone' => 'digits:10|unique:seller_phones,phone'
            ];

            $validated = $request->validate($rules);

            SellerPhone::whereId($seller_phone_id)->update($validated);

            return response('',204);
    }

    public function sellerJobs($seller_id)
    {
        try {
            $seller = Seller::withTrashed()->with('job')->findOrFail($seller_id);
            return response(['data' => $seller->job],200);
        }catch (\Exception $exception)
        {
            return response(['message' => 'not found'],404);
        }
    }

    public function storeSellerJob(StoreSellerJobRequest $request)
    {
        if($request->validated())
        {
            $seller_job  = SellerJob::create($request->only('job','seller_id'));

            collect($request->types)->map(function ($type) use ($seller_job){
                $seller_job->types()->create($type);
            });

            collect($request->signs)->map(function ($sign) use ($seller_job){
                $seller_job->signs()->create($sign);
            });
            return response()->noContent();
        }
    }

    public function getSellerJobTypes($seller_job)
    {
        try {
            $seller_job = SellerJob::with('types.type')->findOrFail($seller_job);
            return response(['data' => $seller_job->types],200);
        }catch (ModelNotFoundException $exception)
        {
            throw new ModelNotFoundException('not found');
        }
    }

    public function storeSellerJobTypes(SotreSellerJobTypes $request)
    {
        if($request->validated())
        {
            $job = SellerJob::find($request->seller_job_id);
            collect($request->types)->map(function ($type) use ($job){
                $job->types()->create($type);
            });

            return response(['message' => 'created!'],201);
        }
    }

    public function destorySellerType($seller_job_type)
    {
        try {
            $seller_job = SellerJobType::findOrFail($seller_job_type);
            $seller_job->forceDelete();
            return response()->noContent();
        }catch (ModelNotFoundException $exception)
        {
            throw new ModelNotFoundException('not found');
        }
    }

    public function getSellerJobSigns($seller_job)
    {
        try {
            $seller_job = SellerJob::with('signs.sign')->findOrFail($seller_job);
            return response(['data' => $seller_job->signs],200);
        }catch (ModelNotFoundException $exception)
        {
            throw new ModelNotFoundException('not found');
        }
    }

    public function StoreSellerJobSigns(StoreSellerJobSigns $request)
    {
        if($request->validated())
        {
            $job = SellerJob::find($request->seller_job_id);
            collect($request->signs)->map(function ($sign) use ($job){
                $job->signs()->create($sign);
            });

            return response(['message' => 'created!'],201);
        }
    }

    public function destorySellerSign($seller_job_sign)
    {
        try {
            $seller_job = SellerJobSign::findOrFail($seller_job_sign);
            $seller_job->forceDelete();
            return response()->noContent();
        }catch (ModelNotFoundException $exception)
        {
            throw new ModelNotFoundException('not found');
        }
    }

    public function updateDescriptionJob(Request $request,$seller_job_id)
    {
        try {
            $seller_job = SellerJob::findOrFail($seller_job_id);
            $seller_job->update($request->only('job'));
            return response()->noContent();
        }catch (ModelNotFoundException $exception)
        {
            throw new ModelNotFoundException('not found');
        }
    }

    public function destorySellerJob($seller_job_id)
    {
        try {
            $seller_job = SellerJob::withTrashed()->findOrFail($seller_job_id);
            if(!$seller_job->trashed())
            {
                $seller_job->delete();
                return response()->noContent();
            }
            $data = [
                'data' => [
                    'message' => __('messages.user_not_deleted')
                ]
            ];
            return response($data,422);
        }catch (\Exception $e)
        {
            $data = [
                'data' => [
                    'message' => __('messages.user_not_found')
                ]
            ];
            return response($data,422);
        }
    }


    public function sellerRequests()
    {

        $requests = UserRequest::with('vehicle.user.profile','vehicle.sign','suggestions.suggestion.request.seller.profile','suggestions.seller.profile','informations','type','images')
            ->latest('created_at')->get();

        return response(['data' => $requests],200);
    }

    public function destroyUserRequest($user_request_id)
    {
        try {
            $userRequest = UserRequest::findOrFail($user_request_id);
            if(!$userRequest->trashed())
            {
                $userRequest->forceDelete();
                return response()->noContent();
            }
        }catch (ModelNotFoundException $exception)
        {
            return throw new ModelNotFoundException('request not found');
        }
    }

    public function storeSellerSuggestion(StoreSellerSuggestionRequest $request)
    {
        $marks = explode(',',$request->marks);
        $prices = explode(',',$request->prices);
        $available_at = explode(',',$request->available_at);

        if(count($marks) == count($prices) && count($marks) == count($available_at) &&
            count($prices) == count($available_at))
        {
            $seller_request = SellerRequest::with('request.vehicle')->find($request->seller_request_id);

            SellerRequest::whereId($request->seller_request_id)->update([
                'suggest_him_at' => Carbon::now()
            ]);

            for ($i=0;$i<count($marks);$i++)
            {
                $seller_request->suggestion()->create([
                    'mark' => $marks[$i],
                    'price' => $prices[$i],
                    'available_at' => $available_at[$i],
                ]);
            }
            $data = SellerRequest::with('suggestion','request.informations')->find($request->seller_request_id);
            event(new NewSuggestionEvent($data,$seller_request->request->vehicle->user_id));
            $this->pushNotification('Vous avez une nouvelle suggestion','nouvelle suggestion',[$seller_request->request->vehicle->user_id],'clients');
            event(new NewRequestEvent($data));
            return response(['success' => true],201);

        }else{
            $message = [
                'message' => [
                    'errors' => [
                        'Erreur veuillez réessayer.'
                    ]
                ]
            ];
            return response($message,403);
        }
    }
}
