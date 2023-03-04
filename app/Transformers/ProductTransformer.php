<?php

namespace App\Transformers;

use App\Models\Product;
use Illuminate\Support\Carbon;
use League\Fractal\TransformerAbstract;

class ProductTransformer extends TransformerAbstract
{
    /**
     * List of resources to automatically include
     *
     * @var array
     */
    protected array $defaultIncludes = [
        'category'
    ];

    /**
     * List of resources possible to include
     *
     * @var array
     */
    protected array $availableIncludes = [
        //
    ];

    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(Product $product)
    {
        return [
            'id' => $product->id,
            'sku' => $product->sku,
            'name' => $product->name,
            'price' => $product->price,
            'stock' => $product->stock,
            'createdAt' => Carbon::make($product->created_at)->timestamp ?? 0
        ];
    }

    public function includeCategory(Product $product)
    {
        if ($product->category) {
            return $this->item($product->category, new CategoryTransformer);
        }
    }
}
