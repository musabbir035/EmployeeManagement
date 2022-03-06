<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeExperience extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id',
        'organization',
        'from_date',
        'to_date',
        'designation',
        'duties'
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
