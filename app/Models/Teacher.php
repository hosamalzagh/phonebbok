<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Teacher extends Model
{
    /** @use HasFactory<\Database\Factories\TeacherFactory> */
    use HasFactory;

    protected $guarded = ['id'];

    protected $casts = [
        'salary' => 'decimal:2',
    ];

    /**
     * Get the groups managed by the teacher.
     */
    public function groups(): HasMany
    {
        return $this->hasMany(Group::class);
    }
}
