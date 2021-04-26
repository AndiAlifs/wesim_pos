<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    protected $fillable = ['purchase_transaction_id', 'product_id', 'amount', 'price'];
    //
    public function product()
    {
        return $this->belongsTo('App\product');
        /**
         * Get the purchaseTransaction that owns the purchase
         *
         * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
         */
    }
    public function purchaseTransaction()
    {
        return $this->belongsTo(PurchaseTransaction::class, 'purchase_transaction_id', 'id');
    }

    /**
     * Get the product that owns the purchase
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function product_()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }
}