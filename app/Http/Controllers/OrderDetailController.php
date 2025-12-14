<?php

namespace App\Http\Controllers;

use App\Models\OrderDetail;
use App\Http\Requests\StoreOrder_DetailRequest;
use App\Http\Requests\UpdateOrder_DetailRequest;

class OrderDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreOrder_DetailRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(OrderDetail $order_Detail)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(OrderDetail $order_Detail)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateOrder_DetailRequest $request, OrderDetail $order_Detail)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(OrderDetail $order_Detail)
    {
        //
    }
}
