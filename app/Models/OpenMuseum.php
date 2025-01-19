<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OpenMuseum extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'schedule',
    ];
}
