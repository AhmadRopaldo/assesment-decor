<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Pesanan; // Pastikan nama Model sesuai (image_3ad161 menunjukkan Pesanan.php)
use App\Models\Produk;
use App\Models\User;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        try {
            // Mengambil semua pesanan beserta data customer (user)
            $orders = Pesanan::with('user')->latest()->get();

            // Menghitung total statistik untuk Dashboard
            $totalFurniture = Produk::count(); 
            $totalCustomer = User::count();

            return response()->json([
                'success' => true,
                'message' => 'Data Dashboard Berhasil Diambil',
                'summary' => [
                    'total_furniture' => $totalFurniture,
                    'total_customer' => $totalCustomer,
                ],
                'data' => $orders
            ], 200);
        } catch (\Exception $e) {
          return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }
}