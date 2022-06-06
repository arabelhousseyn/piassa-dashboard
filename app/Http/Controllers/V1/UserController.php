<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\SendPushNotificationRequest;
use App\Http\Requests\StoreNoteRequest;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateNoteRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Services\UpdateUserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use App\Models\{User, UserNote, UserProfile};
use App\Traits\SendPushNotificationTrait;
class UserController extends Controller
{
    use SendPushNotificationTrait;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::with('locations','profile.province','vehicle.sign','carts','orders.items.item.request.request.informations',
            'orders.items.item.request.request.vehicle','orders.items.item.request.seller.profile',
            'orders.shipperUserOrder.shipper','orders.invoice','orders.shipperUserOrder.shipper.profile','commercial_info','roles')
            ->withTrashed()->latest('id','desc')->get();
        return response(['data' => $users],200);
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
    public function store(StoreUserRequest $request)
    {
        if($request->validated())
        {
                    $password_hash = ['password' => Hash::make($request->password)];
                    if($request->role == 'C')
                    {
                        $rules = [
                            'commercial_registration' => 'required',
                            'name_company' => 'required',
                            'contact_name' => 'required',
                        ];
                        $validated = $request->validate($rules);
                        $user = User::create(array_merge($request->only('phone','email'),$password_hash));
                        $this->assigRole($user,$request->role);
                        $profile = $user->profile()->create($request->except('phone','email'));
                        $user->commercial_info()->create($validated);
                        return response(['success' => true],200);
                    }
            $user = User::create(array_merge($request->only('phone','email'),$password_hash));
            $this->assigRole($user,$request->role);
            $profile = $user->profile()->create($request->except('phone','email'));

            return response(['success' => true],200);
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
        return UpdateUserService::update($request,$id);
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
            $user = User::withTrashed()->findOrFail($id);
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
            $user = User::withTrashed()->findOrFail($id);
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

    public function assigRole($user,$role)
    {
        $role = Role::whereName($role)->first();
        DB::table('model_has_roles')->insert([
            'role_id' => $role->id,
            'model_type' => get_class($user),
            'model_id' => $user->id
        ]);
    }

    public function updateCommercialInfo(Request $request,$user_id)
    {
        $user = User::withTrashed()->find($user_id);
        $user->commercial_info()->update($request->all());
        return response('',204);
    }

    public function fetchOrderByUser($user_id)
    {
        try {
            $user = User::withTrashed()->with('orders.items.item.request.request.informations',
                'orders.invoice','orders.items.item.request.request.vehicle','orders.shipperUserOrder.shipper.profile')->findOrFail($user_id);
            return response(['data' => $user->orders],200);
        }catch (\Exception $e)
        {
            return response(['message' => 'not found'],404);
        }
    }

    public function sendPushNotification(SendPushNotificationRequest $request)
    {
        try {
            if($request->type == 'ALL')
            {
                $users_device_token = UserProfile::pluck('user_id');
            }else{
                $users_device_token = UserProfile::where('gender',$request->type)->pluck('user_id');
            }

            foreach ($users_device_token as $value)
            {
                $this->push($request->title,$request->message,$value);
            }

            return response(['message' => 'Message envoyé.'],200);
        }catch (\Exception $exception)
        {
            return response($exception->getMessage(),500);
        }
    }

    public function storeNote(StoreNoteRequest $request)
    {
        if($request->validated())
        {
            $user = User::find($request->user_id);
            $user->notes()->create($request->only('note'));
            return response(['message' => 'created!'],201);
        }
    }

    public function updateNote(Request $request,$user_note_id)
    {
        if($request->validated())
        {
            $user_note = UserNote::find($user_note_id);
            $user_note->update($request->note);
            return response()->noContent();
        }
    }
}
