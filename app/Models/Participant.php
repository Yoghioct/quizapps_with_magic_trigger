<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Participant extends Model
{
    use HasFactory;

    protected $table = 'participants';

    protected $fillable = [
        'code',
        'full_name',
        'id_team',
        'id_dinner_table',
    ];

    // Relationship to Team
    public function team()
    {
        return $this->belongsTo(Team::class, 'id_team', 'id');
    }

    // Relationship to DinnerTable
    public function dinnerTable()
    {
        return $this->belongsTo(DinnerTable::class, 'id_dinner_table', 'id');
    }
}
