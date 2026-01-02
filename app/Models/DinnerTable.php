<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DinnerTable extends Model
{
    use HasFactory;

    protected $table = 'dinner_tables';

    protected $fillable = ['nama_table', 'nomor_table', 'zona_table'];
}
