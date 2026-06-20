<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;

    /**
     * ORDER ITEM ATTRIBUTES
     * $this->attributes['id'] - int - contains the order item primary key (id)
     * $this->attributes['quantity'] - int - contains the quantity of the purchased product
     * $this->attributes['price'] - float - contains the price of the product at purchase time
     * $this->attributes['order_id'] - int - contains the id of the order this item belongs to
     * $this->attributes['product_id'] - int - contains the id of the purchased product
     * $this->attributes['created_at'] - timestamp - contains the order item creation date
     * $this->attributes['updated_at'] - timestamp - contains the order item update date
     */

    protected $fillable = ['quantity', 'price', 'order_id', 'product_id'];

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getQuantity()
    {
        return $this->quantity;
    }

    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function setPrice($price)
    {
        $this->price = $price;
    }

    public function getOrderId()
    {
        return $this->order_id;
    }

    public function setOrderId($orderId)
    {
        $this->order_id = $orderId;
    }

    public function getProductId()
    {
        return $this->product_id;
    }

    public function setProductId($productId)
    {
        $this->product_id = $productId;
    }

    public function getCreatedAt()
    {
        return $this->created_at;
    }

    public function setCreatedAt($createdAt)
    {
        $this->created_at = $createdAt;
    }

    public function getUpdatedAt()
    {
        return $this->updated_at;
    }

    public function setUpdatedAt($updatedAt)
    {
        $this->updated_at = $updatedAt;
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}