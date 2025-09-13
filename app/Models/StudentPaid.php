<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentPaid extends Model
{
    protected $table = 'student_paids';

    protected $guarded = ['id'];
}
