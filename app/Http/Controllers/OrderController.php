<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Order;
use App\Models\OrdersProduct;
use App\Models\Accessory;
use App\Models\Batteries;
use App\Models\Panel;
use App\Models\Inverter;
use DB;
use Session;

class OrderController extends Controller
{

    public function cancelMyOrder(string $id)
    {
        Order::where('order_id', '=', $id)->update(
            [
                'status' => 'cancelled'
            ]
        );

        return redirect("/order/completed")->with('success', 'Order successfully canceled.');
    }

    public function showMyCompletedOrders()
    {
        $orders = Order::query()
            ->select('orders.order_id', 'user_id', 'date_placed', 'status', DB::raw("SUM(price * quantity) AS total_price"))
            ->join('orders_products', "orders_products.order_id", "=", "orders.order_id")
            ->join("solar_accessory", "orders_products.product_id", "=", "solar_accessory.product_id")
            ->where('user_id', '=', Session::get('user_id'))
            ->where('status', '=', 'received')
            ->orWhere('status', '=', 'cancelled')
            ->groupBy('orders.order_id')
            ->orderBy('status', 'DESC')
            ->orderBy('date_placed', 'DESC')
            ->get();

        return view('orders_completed', compact('orders'));
    }

    public function receiveOrder(string $id)
    {
        Order::where('order_id', '=', $id)->update(
            [
                'status' => 'received'
            ]
        );

        return redirect("/order/")->with('success', 'Order complete! Please enjoy~');
    }

    public function updateOrder(Request $request, string $id)
    {
        Order::where('order_id', '=', $id)->update(
            [
                'status' => $request->input('new_status')
            ]
        );
        return redirect("/admin/orders/" . $id)->with('success', 'Order updated.');
    }

    public function cancelOrder(string $id)
    {
        Order::where('order_id', '=', $id)->update(
            [
                'status' => 'cancelled'
            ]
        );
        return redirect("/admin/orders/" . $id)->with('success', 'Order cancelled.');
    }

    public function acceptOrder(string $id)
    {
        $ordered_products = Order::query()
            ->select('orders.order_id', 'quantity', 'name', 'price')
            ->join('orders_products', 'orders.order_id', '=', 'orders_products.order_id')
            ->join('solar_accessory', 'orders_products.product_id', '=', 'solar_accessory.product_id')
            ->where('orders.order_id', '=', $id)
            ->get();
        // $ordered_products_stocks = Order::query()
        //     ->select('orders.order_id', 'quantity', 'name', 'price', 'stock')
        //     ->join('orders_products', 'orders.order_id', '=', 'orders_products.order_id')
        //     ->join('products', 'orders_products.product_id', '=', 'products.product_id')
        //     ->where('orders.order_id', '=', 6)
        //     ->where('quantity', '<=', 'stock')
        //     ->get();
        $ops = DB::select('SELECT `orders`.`order_id`, `solar_accessory`.`product_id`, `quantity`, `name`, `price`, `stock` FROM `orders` INNER JOIN `orders_products` ON `orders`.`order_id` = `orders_products`.`order_id` INNER JOIN `products` ON `orders_products`.`product_id` = `products`.`product_id` WHERE `orders`.`order_id` = ' . $id . ' AND `quantity` <= stock;');

        if (count($ordered_products) == count($ops)) {
            for ($i = 0; $i < count($ops); $i++) {
                Accessory::where('product_id', '=', $ops[$i]->product_id)
                    ->update(
                        [
                            'stock' => $ops[$i]->stock - $ops[$i]->quantity
                        ]
                    );
            }
            Order::where('order_id', '=', $id)->update(
                [
                    'status' => 'accepted'
                ]
            );
            return redirect("/admin/orders/" . $id)->with('success', 'Order accepted!');
        } else {
            return redirect("/admin/orders/" . $id)->with('fail', 'Not enough stock to complete order!');
        }
    }

    public function showCompletedOrders()
    {
        //waiting, accepted, preparing, waiting for delivery, delivering, delivered, received, cancelled
        $orders = Order::query()
            ->select('orders.order_id', 'user_id', 'date_placed', 'status', DB::raw("SUM(price) AS total_price"))
            ->join('orders_products', "orders_products.order_id", "=", "orders.order_id")
            ->join("solar_accessory", "orders_products.product_id", "=", "solar_accessory.product_id")
            ->where('status', '=', 'received')
            ->orWhere('status', '=', 'cancelled')
            ->groupBy('orders.order_id')
            ->orderBy('date_placed', 'DESC')
            ->get();
        return view('admin_orders_completed', compact('orders'));
    }

    public function showOrderInfo(string $id)
    {
        $total = 0;
        $order_info = Order::query()
            ->select('order_id', 'date_placed', 'status')
            ->where('order_id', '=', $id)
            ->get()
            ->first();
        $ordered_products = Order::query()
            ->select('orders.order_id', 'quantity', 'brand', 'description', 'price', 'stock')
            ->join('orders_products', 'orders.order_id', '=', 'orders_products.order_id')
            ->join('solar_accessory', 'orders_products.product_id', '=', 'solar_accessory.product_id')
            ->where('orders.order_id', '=', $id)
            ->get();
        foreach ($ordered_products as $op) {
            $total += $op->price * $op->quantity;
        }

        return view('admin_show_order', compact('order_info', 'ordered_products', 'total'));
    }

    public function showOngoingOrders()
    {
        //waiting, accepted, preparing, waiting for delivery, delivering, delivered, received, cancelled
        $orders = Order::query()
            ->select('orders.order_id', 'user_id', 'date_placed', 'status', DB::raw("SUM(price) AS total_price"))
            ->join('orders_products', "orders_products.order_id", "=", "orders.order_id")
            ->join("solar_accessory", "orders_products.product_id", "=", "solar_accessory.product_id")
            ->where('status', '!=', 'received')
            ->where('status', '!=', 'cancelled')
            ->groupBy('orders.order_id')
            ->orderBy('date_placed', 'DESC')
            ->get();
        return view('admin_orders', compact('orders'));
    }

    public function showOrder(string $id)
    {
        $check_order = Order::query()
            ->select('order_id')
            ->where('order_id', '=', $id)
            ->where('user_id', '=', Session::get('user_id'))
            ->get();

        if (count($check_order) > 0) {
            $total = 0;
            $order_info = Order::query()
                ->select('order_id', 'date_placed', 'status')
                ->where('order_id', '=', $id)
                ->get()
                ->first();
            $ordered_products = Order::query()
                ->select('orders.order_id', 'quantity', 'brand', 'description','price')
                ->join('orders_products', 'orders.order_id', '=', 'orders_products.order_id')
                ->join('solar_accessory', 'orders_products.product_id', '=', 'solar_accessory.product_id')
                ->where('orders.order_id', '=', $id)
                ->get();
            foreach ($ordered_products as $op) {
                $total += $op->price * $op->quantity;
            }

            return view('show_order', compact('order_info', 'ordered_products', 'total'));
        } else {
            abort(401);
        }
    }

    public function showOrders()
    {
        $orders = Order::query()
            ->select('orders.order_id', 'date_placed', 'status', DB::raw("SUM(price * quantity) AS total_price"))
            ->join('orders_products', "orders_products.order_id", "=", "orders.order_id")
            ->join("solar_accessory", "orders_products.product_id", "=", "solar_accessory.product_id")
            ->where('user_id', '=', Session::get('user_id'))
            ->where('status', '!=', 'cancelled')
            ->where('status', '!=', 'received')
            ->groupBy('orders.order_id')
            ->orderBy('date_placed', 'DESC')
            ->get();

        return view('my_orders', compact("orders"));
    }

    public function placeOrder(Request $request)
    {
        $order = new Order;
        $order->user_id = Session::get('user_id');
        $order->save();

        $p = Accessory::query()
            ->select('product_id', 'brand', 'description', 'price')
            ->where('stock', '>', '0')
            ->get();

        for ($i = 0; $i < count($p); $i++) {
            $ordered = $request->input('order_' . str($p[$i]->product_id));
            if ($ordered > 0) {
                $op = new OrdersProduct();
                $op->order_id = $order->order_id;
                $op->product_id = $p[$i]->product_id;
                $op->quantity = $ordered;
                $op->save();
            }
        }

        return view('store_success', compact('order'));
    }

    public function takeOrder(Request $request)
    {
        if (Session::has('user_id')) {
            $p = Accessory::query()
            ->select('product_id', 'brand', 'description', 'price')
                ->where('stock', '>', '0')
                ->get();
            $sp = array();
            $total = 0;
            for ($i = 0; $i < count($p); $i++) {
                if (intval($request->input('order_' . str($p[$i]->product_id))) > 0) {
                    $total += $p[$i]->price * $request->input('order_' . str($p[$i]->product_id));
                }
                array_push($sp, $request->input('order_' . str($p[$i]->product_id)));
            }

            return view('store_receipt', compact('p', 'sp', 'total', 'request'));
        } else {
            return redirect('/login')->with('fail', 'You must login first!');
        }
    }

    public function showStore()
    {
        $acce = Accessory::query()
            ->select(DB::raw('*'))
            ->where('stock', '>', '0')
            ->paginate(4);
        return view('store', compact('acce'));
        
       
    }
    public function showPanel()
    {
        $pan = Panel::query()
            ->select(DB::raw('*'))
            ->where('stock', '>', '0')
            ->paginate(4);
        return view('panel_store', compact('pan'));
        
       
    }
    public function showAccessory()
    {
        $acc = Accessory::query()
            ->select(DB::raw('*'))
            ->where('stock', '>', '0')
            ->paginate(4);
        return view('accessory_store', compact('acc'));
        
       
    }
    public function showBatteries()
    {
        $bat = Batteries::query()
            ->select(DB::raw('*'))
            ->where('stock', '>', '0')
            ->paginate(4);
        return view('battery_store', compact('bat'));
        
       
    }
    public function showInverter()
    {
        $inv = Inverter::query()
            ->select(DB::raw('*'))
            ->where('stock', '>', '0')
            ->paginate(4);
        return view('inverter_store', compact('inv'));
        
       
    }
}
