<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class user_contract extends Model
{
    use HasFactory;
    protected $table = "user_contracts";
    protected $guarded = [];
}
