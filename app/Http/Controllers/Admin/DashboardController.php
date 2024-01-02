<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Categorie;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $toDay = Carbon::now()->format('d-m-Y');
        $thisMonth = Carbon::now()->format('m');
        $thisYear = Carbon::now()->format('Y');

        $totalOrders = Order::count();
        $toDayOrder = Order::whereDate('created_at',$toDay)->count();
        $thisMonthOrder = Order::whereMonth('created_at',$thisMonth)->count();
        $thisYearOrder = Order::whereYear('created_at',$thisYear)->count();
        
        $totalProducts = Product::count();
        $totalCategories = Categorie::count();
        $totalBrands = Brand::count();
        
        $totalAllUsers = User::count();
        $totalUser = User::where('role_as',0)->count();
        $totalAdmin = User::where('role_as',1)->count();

        return view('admin.dashboard',compact('totalOrders','toDayOrder','thisMonthOrder','thisYearOrder',
            'totalProducts','totalCategories','totalBrands','totalAllUsers','totalUser','totalAdmin'
        ));
    }
}
