<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeEducation extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id',
        'exam',
        'passing_year',
        'result',
        'result_scale',
        'institution',
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
