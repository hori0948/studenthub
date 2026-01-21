<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Student extends Model
{
    protected $fillable = [
        'grade',
        'name',
        'address',
        'img_path',
    ];

    // 学生に紐付く成績を取得する
    
    public function grades(): HasMany
    {
        return $this->hasMany(Grade::class);
    }
}
