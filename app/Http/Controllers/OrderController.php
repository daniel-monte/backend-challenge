<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Services\ExternalService;

class OrderController extends Controller
{
    public function getOrder(ExternalService $externalService, $id)
    {
        try {
            $order = $externalService->getOrder($id)['order'];

            if('processing' === $order['status']){
                $request = new Request($order);
                $this->saveOrder($request);
            }

            return response()->json($order);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()]);
        }
    }

    public function saveOrder(Request $request){
        try {
            $validated = $request->validate([
                'id' => 'required|unique:orders',
                'status' => 'required|string',
                'group_id' => 'required|integer',
                'amount' => 'required|numeric',
            ]);

            $order = new Order();

            $order->id = $validated['id'];
            $order->status = $validated['status'];
            $order->group_id = $validated['group_id'];
            $order->amount = $validated['amount'];

            $order->save();
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()]);
        }
    }
}
