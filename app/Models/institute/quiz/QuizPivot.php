<?php

namespace App\Models\institute\quiz;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class QuizPivot extends Model
{
    use HasFactory;

//    protected $table = '';

    protected $fillable = [
        'id',
    ];

    protected $hidden = [
        'created_at', 'updated_at',
    ];

    public function scopegetTableName(): string
    {
        return $this->getTable();
    }
}
