<?php

namespace App\Models\institute\questions;

use App\Models\institute\grade\GradeCategory;
use App\Models\institute\grade\GradeSubCategory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Facades\DB;

class StaffQuestionPivot extends Model
{
    use HasFactory;

//    protected $table = '';

    protected $fillable = [
        'id','institute_id','category_id','subcategory_id','topic_id','question_id',
    ];

    protected $hidden = [
        'created_at', 'updated_at',
    ];

    public function scopegetTableName(): string
    {
        return $this->getTable();
    }
    public function questionInformation(): HasMany
    {
        return $this->hasMany(StaffQuestion::class, 'id', 'question_id');
    }
    public function categoryInformation(): HasOne
    {
        return $this->hasOne(GradeCategory::class, 'id', 'category_id');
    }
    public function subCategoryInformation(): HasOne
    {
        return $this->hasOne(GradeSubCategory::class, 'id', 'subcategory_id');
    }
    public function topicInformation(): HasOne
    {

        return $this->hasOne(Topic::class, 'id', 'topic_id');
    }
}
