<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Http\Models\Product;
class DashboardController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
		$this->middleware('userstatus');
		$this->middleware('permissions');
		$this->middleware('isadmin');
	}
    public function getDashboard()
    {
    	$users = User::count();
    	$products = Product::where('status', 1)->count();

    	return view('admin.dashboard', compact('users', 'products'));
    }
}
