<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class testUpload extends Model
{
    use HasFactory;
    protected $table = "test_uploads";
    protected $guarded = [];
}
