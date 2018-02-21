<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

class FrontEndController extends Controller
{
    public function index() {
        return view('index')->with('products', Product::paginate(3));
    }
}
