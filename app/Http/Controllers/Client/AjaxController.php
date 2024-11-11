<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use App\Models\ProductVariants;
use Illuminate\Http\Request;

class AjaxController extends Controller
{
    public function rendPrdV(Request $request)
    {
        $variant = ProductVariants::query()->where([
            'products_id' => $request->prd_id,
            'color_attributes_id' => $request->idColor,
            'size_attributes_id' => $request->idSize,
        ])->first();
        if ($variant) {
            $color = $variant->color;
            $size = $variant->size;
            return response()->json(
                [
                    'id' => $variant->id,
                    'product_id' => $variant->products_id,
                    'color_attribute_id' => $variant->color_attributes_id,
                    'size_attribute_id' => $variant->size_attributes_id,
                    'color_value' => $color->value,
                    'size_value' => $size->value,
                    'price_default' => $variant->price_default,
                    'price_sale' => $variant->price_sale,
                    'start_date' => $variant->start_date,
                    'end_date' => $variant->end_date,
                    'quantity' => $variant->quantity,
                ],
            );
        }
    }
}
