<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'total_score',
    ];

    /**
     * Relationship: A team has many scores.
     */
    public function scores()
    {
        return $this->hasMany(Score::class);
    }
}
