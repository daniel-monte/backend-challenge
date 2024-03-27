<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Services\ExternalService;

class OrderController extends Controller
{
    public function getOrder($id)
    {
        $externalService = new ExternalService();
        try {
            $order = $externalService->getOrder($id)['order'];
            return $order;
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()]);
        }
    }

    public function saveOrder(Request $request){
        try {
            $validated = $request->validate([
                'status' => 'required|string',
                'group_id' => 'required|integer',
                'amount' => 'required|numeric',
            ]);


            $order = Order::updateOrCreate(
                ['id' => $request['id']],
                [
                    'id' => $request['id'],
                    'status' => $validated['status'],
                    'group_id' => $validated['group_id'],
                    'amount' => $validated['amount'],
                ]
            );

            return $order;
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()]);
        }
    }

    public function show($id){
        $order = Order::find($id);

        if(!$order){
            $order = $this->getOrder($id);

            if('processing' === $order['status']){
                $request = new Request($order);
                $order = $this->saveOrder($request);
            }
        }

        return response()->json(['order' => $order]);
    }

    public function index(){
       
        $query = Order::with('groupedOrders')
            ->groupBy('group_id')
            ->selectRaw('group_id, count(*) as total_orders, sum(case when status = "processing" then amount else 0 end) as total_amount');

        return response()->json(['orders' => $query->get()]);
    }

    public function delete(Order $order){
        $order->delete();
        return response()->json(['message' => 'Order deleted successfully']);
    }

    public function store($id){
        $order = $this->getOrder($id);
        $request = new Request($order);
        $order = $this->saveOrder($request);

        return response()->json(['order' => $order]);
    }
}
