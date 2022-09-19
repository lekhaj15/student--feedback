<?php

namespace App\Models\institute\staff;

use App\Models\institute\grade\GradeCategory;
use App\Models\institute\grade\GradeSubCategory;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StaffInformation extends Model
{
    use HasFactory;

//    protected $table = '';

    protected $fillable = [
        'id','staff_id','category_id','subcategory_id','staff_name',
        'staff_email','staff_phone','staff_dob','staff_password',
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
