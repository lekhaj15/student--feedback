<?php

namespace App\Models\institute\quiz;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class QuizAnswer extends Model
{
    use HasFactory;

//    protected $table = '';

    protected $fillable = [
        'id','institute_id','student_id','subject_id','quiz_id','answer_name', 'created_at', 'updated_at',

    ];

//    protected $hidden = [
//        'created_at', 'updated_at',
//    ];

    public function scopegetTableName(): string
    {
        return $this->getTable();
    }
}
