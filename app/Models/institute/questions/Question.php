<?php

namespace App\Models\institute\questions;

use App\Models\institute\Auth\Institute;
use App\Models\institute\grade\GradeCategory;
use App\Models\institute\grade\GradeSubCategory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Facades\DB;

class Question extends Model
{
    use HasFactory;

//    protected $table = '';

    protected $fillable = [
        'id','question_name','option1','option2','option3','option4', 'created_at', 'updated_at',
    ];

//    protected $hidden = [
//        'created_at', 'updated_at',
//    ];

    public function scopegetTableName(): string
    {
        return $this->getTable();
    }
    public function questionInformation(): HasMany
    {
        return $this->hasMany(QuestionPivot::class, 'question_id', 'id');
    }


}
