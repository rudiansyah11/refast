<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class data_customer extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    protected $table = "data_customers";
    protected $guarded = [];
}
