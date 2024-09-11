<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Attribute;
use App\Models\AttributeValue;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function listProduct()
    {
        return 'Day la trang list';
    }

    public function create()
    {
        $dataAttr = Attribute::query()->get();
        $categoryParent = Category::query()->with('children')->whereNull('parent_id')->get();
        $dataTags = Tag::query()->get();
        return view('admin.contents.Product.create', compact('dataAttr', 'categoryParent', 'dataTags'));
    }
    public function getAttrValue(Request $request)
    {
        $attributeId = $request->attribute_id;
        $attributeValues = AttributeValue::query()->where('attribute_id', $attributeId)->get();
        return response()->json($attributeValues);
    }
    public function store(Request $request)
    {
        dd($request->all());
        return view('admin.contents.Product.create');
    }
    public function variantPrd(Request $request)
    {
        dd($request->all());
        $inforProduct = [
            'prdName' => $request->name,
            'prdImg' => $request->product_galleries,
            'prdDescription' => $request->description,
            'prdMaterial' => $request->material,
            'prdUserManual' => $request->user_manual,
            'prdCategory' => $request->category_id,
            'prdTags' => $request->tags,
            'prdPrice' => [
                'price_default' => $request->price_default,
                'sale_percent' => $request->sale_percent,
                'price_sale' => $request->price_sale
            ],
            'prdStatus' => [
                'is_active' => $request->is_active,
                'is_new' => $request->is_new,
            ],
        ];
        $variantProduct = [
            'attrID' => $request->attrID,
            'attrValueId' => $request->attrValueId
        ];
        // dd($inforProduct['prdImg']);
        // dd($inforProduct, $variantProduct);
        return view('admin.contents.Product.createPrdVariant', compact('inforProduct', 'variantProduct'));
    }
}
