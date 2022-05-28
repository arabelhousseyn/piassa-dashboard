<?php

namespace App\Http\Controllers\V1;

use App\Events\OrderConfirmedForClient;
use App\Events\OrderConfirmedForSeller;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Event;
use mysql_xdevapi\Exception;
use App\Models\{ShipperUserOrder, UserOrder};
use App\Traits\CustomPushNotificationTrait;
class UserOrderController extends Controller
{
    use CustomPushNotificationTrait;
    public function getAllOrders()
    {
        $user_orders = UserOrder::with('items.item.request.seller.profile','items.item.request.request.informations','items.item.request.request.type','events','user.profile','invoice','shipperUserOrder.shipper')->withTrashed()->latest('created_at')->get();
        return response(['data' => $user_orders],200);
    }

    public function getOrderItemsByUser($user_order_id)
    {
        try {
            $user_orders = UserOrder::with('items.item.request.seller.profile','items.item.request.request.informations','items.item.request.request.type')->withTrashed()->findOrFail($user_order_id);
            return response(['data' => $user_orders->items],200);
        }catch (Exception $exception)
        {
            return response(['message' => 'not found']);
        }
    }


    public function getOrderEventsByUser($user_order_id)
    {
        try {
            $user_orders = UserOrder::with('events')->withTrashed()->findOrFail($user_order_id);
            return response(['data' => $user_orders->events],200);
        }catch (\Exception $exception)
        {
            return response(['message' => 'not found']);
        }
    }

    public function destroy($user_order_id)
    {
        try {
            $user_order = UserOrder::findOrFail($user_order_id);
            if(!$user_order->trashed())
            {
                $user_order->delete();
                return response()->noContent();
            }
        }catch (\Exception $exception)
        {
            return response(['message' => 'not found'],404);
        }

    }

    public function restore($user_order_id)
    {
        try {
            $user_order = UserOrder::withTrashed()->findOrFail($user_order_id);
            if($user_order->trashed())
            {
                $user_order->restore();
                return response()->noContent();
            }
        }catch (\Exception $exception)
        {
            return response(['message' => 'not found'],404);
        }
    }

    public function confirmOrder($user_order_id)
    {
        try {
            $sellers_ids = array();
            $user_order = UserOrder::with('items.item.request')->findOrFail($user_order_id);
            foreach ($user_order->items as $item) {
                $sellers_ids[] = $item->item->request->seller_id;
            }
            $shipper_ids = ShipperUserOrder::where('user_order_id',$user_order_id)->pluck('shipper_id');
            $user_order->update([
                'confirmed_by_administrator_at' => Carbon::now()
            ]);

            $this->pushNotification('Votre suggestion est en ordre','votre suggestion est en ordre',$sellers_ids,'seller');
            $this->pushNotification('Vous avez une nouvelle commande','Vous avez une nouvelle commande',$shipper_ids,'shipper');
            event(new OrderConfirmedForSeller($user_order));
            event(new OrderConfirmedForClient($user_order));

            return response()->noContent();
        }catch (\Exception $exception)
        {
            return response(['message' => 'not found'],404);
        }
    }
}
