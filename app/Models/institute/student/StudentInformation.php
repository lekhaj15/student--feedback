<?php

namespace App\Models\institute\student;

use App\Models\institute\Auth\Institute;
use App\Models\institute\grade\GradeCategory;
use App\Models\institute\grade\GradeSubCategory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Facades\DB;
use PHPOpenSourceSaver\JWTAuth\Contracts\JWTSubject;
use Illuminate\Foundation\Auth\User as Authenticatable;

class StudentInformation extends Authenticatable implements JWTSubject
{
    use HasFactory;

//    protected $table = '';

    protected $fillable = [
        'id','institute_id','student_id','category_id','subcategory_id','student_name','student_email',
        'student_phone','student_password','student_status','role',
    ];

    protected $hidden = [
        'created_at', 'updated_at','password', 'remember_token',
    ];

    public function scopegetTableName(): string
    {
        return $this->getTable();
    }

    public function categoryInformation(): HasOne
    {
        return $this->hasOne(GradeCategory::class, 'id', 'category_id');
    }
    public function instituteInformation(): HasOne
    {
        return $this->hasOne(Institute::class, 'id', 'institute_id');
    }

    public function subcategoryInformation(): HasOne
    {
        return $this->hasOne(GradeSubCategory::class, 'id', 'subcategory_id');
    }
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     */
    public function getJWTCustomClaims(): array
    {
        return [];
    }
}
