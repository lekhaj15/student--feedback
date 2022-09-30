<?php

namespace App\Models\institute\questions;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class StaffQuestion extends Model
{
    use HasFactory;

//    protected $table = '';

    protected $fillable = [
        'id','question_name','option1','option2','option3','option4',
    ];

    protected $hidden = [
        'created_at', 'updated_at',
    ];

    public function scopegetTableName(): string
    {
        return $this->getTable();
    }
    public function staffquestionInformation(): HasMany
    {
        return $this->hasMany(StaffQuestionPivot::class, 'question_id', 'id');
    }
}
