<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Criteria extends Model
{
    use HasFactory;

    protected $table = 'criteria';

    protected $fillable = [
        'name',
        'type',
        'weight',
    ];

    public function scores()
    {
        return $this->hasMany(Score::class, 'criteria_id');
    }
}
