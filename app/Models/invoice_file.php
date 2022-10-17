<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class invoice_file extends Model
{
    use HasFactory;
    protected $table = "invoice_files";
    protected $guarded = [];
}
