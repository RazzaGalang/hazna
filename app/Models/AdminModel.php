<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminModel extends Model
{
    use HasFactory;
    protected $table        = "product";
    protected $primaryKey   = "product_id";
    protected $fillable     = ['product_id', 'product_name', 'description', 'price', 'image'];
}
