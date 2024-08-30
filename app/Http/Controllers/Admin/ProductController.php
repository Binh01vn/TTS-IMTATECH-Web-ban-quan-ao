<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function listProduct(){
        return 'Day la trang list';
    }

    public function create(){
        return view('admin.contents.Product.create');
    }
    public function store(Request $request){
        dd($request->all());
        return view('admin.contents.Product.create');
    }
}
