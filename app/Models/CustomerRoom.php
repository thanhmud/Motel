<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerRoom extends Model
{
    use HasFactory;
     protected $guarded = ["id"];
    protected $primaryKey = "id";
    protected $table ="customer_rooms";
}
