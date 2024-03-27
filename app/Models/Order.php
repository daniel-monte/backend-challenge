<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    public function groupedOrders()
    {
        return $this->hasMany(Order::class, 'group_id', 'group_id');
    }

}
