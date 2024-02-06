<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KKA extends Model
{
    use HasFactory;
    protected $table = 'kka';
    protected $fillable = [
        'nama'
    ];
}
