<?php

namespace App\Models\institute\student;

use App\Models\institute\grade\GradeCategory;
use App\Models\institute\grade\GradeSubCategory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Facades\DB;

class StudentInformation extends Model
{
    use HasFactory;

//    protected $table = '';

    protected $fillable = [
        'id','student_id','category_id','subcategory_id','student_name','student_email',
        'student_phone','student_password','student_status'
    ];

    protected $hidden = [
        'created_at', 'updated_at',
    ];

    public function scopegetTableName(): string
    {
        return $this->getTable();
    }

    public function categoryInformation(): HasOne
    {
        return $this->hasOne(GradeCategory::class, 'id', 'category_id');
    }

    public function subcategoryInformation(): HasOne
    {
        return $this->hasOne(GradeSubCategory::class, 'id', 'subcategory_id');
    }
}
