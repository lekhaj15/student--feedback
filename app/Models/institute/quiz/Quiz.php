<?php

namespace App\Models\institute\quiz;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Quiz extends Model
{
    use HasFactory;

//    protected $table = '';

    protected $fillable = [
        'id','quiz_name','option1','option2','option3','option4', 'created_at', 'updated_at',

    ];

    protected $hidden = [
        'created_at', 'updated_at',
    ];

    public function scopegetTableName(): string
    {
        return $this->getTable();
    }
}
