<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Category;
use App\Models\member;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Models\OrderDetail;
use Exception;
// Tambahkan ini di deretan use paling atas
use App\Exports\OrderExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['categories'] = Category::with('product')->get();
        $data['members'] = Member::all();
        return view('order.index')->with($data);
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
    public function store(StoreOrderRequest $request)
    {
        $validated = $request->validated();
        $payload = json_decode($validated['order_payload'], true);

        if (empty($payload['items'])) {
            // Ubah ini menjadi respons JSON
            return response()->json(['success' => false, 'message' => 'Keranjang kosong!'], 400); 
        }

        DB::beginTransaction();
        try {
            $order = Order::create([
                'invoice' => 'INV' . time(),
                'total' => $payload['total'],
                'user_id' => Auth::id() ?? 1,
                'customer_id' => $validated['customer_id'],
            ]);

            foreach ($payload['items'] as $item) {
                OrderDetail::create([
                    'order_id' => $order->id,
                    'product_id' => $item['id'],
                    'quantity' => $item['qty'],
                    'price' => $item['unitPrice'] * $item['qty'],
                ]);
            }

            DB::commit();

            // KEMBALIKAN RESPON JSON BERISI ID ORDER DAN URL PRINT
            return response()->json([
                'success' => true, 
                'message' => 'Order berhasil disimpan!',
                'order_id' => $order->id,
                'print_url' => route('order.print', $order->id)
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            // Ubah ini menjadi respons JSON
            return response()->json(['success' => false, 'message' => 'Gagal: ' . $e->getMessage()], 500);
        }
    }

    public function print(Order $order)
    {
        // Pastikan load relasi customer dan details
        $order->load('customer', 'details.product');

        // Jika customer null, fallback
        if (!$order->customer) {
            // Opsional: redirect atau tampilkan error
            return redirect()->route('order.index')->with('error', 'Pelanggan tidak ditemukan.');
        }

        return view('order.print', compact('order'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateOrderRequest $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        //
    }
    /**
     * Export data ke Excel
     */
    public function export()
    {
        // Ini akan mendownload file bernama 'laporan-order.xlsx'
        return Excel::download(new OrderExport, 'laporan-order.xlsx');
    }
}
