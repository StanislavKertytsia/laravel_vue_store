<?php

namespace App\Http\Controllers;

use App\Http\Requests\Order\OrderRequest;
use App\Http\Resources\OrderResource;
use App\Interfaces\OrderInterface;
use Illuminate\Http\Request;
use Throwable;

class OrderController extends Controller
{
    public function __construct(
        private OrderInterface $service
    )
    {
    }

    public function index()
    {
        //
    }


    public function store(OrderRequest $request)
    {
        $dto = $request->toDto();
        try {
            $order = $this->service->create(auth()->id(), $dto);
            return new OrderResource($order);


        } catch (Throwable $e) {
            return response()->json([
                'message' => 'Failed to create order',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
