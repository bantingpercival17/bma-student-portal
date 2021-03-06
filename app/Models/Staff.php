<?php

namespace App\Models;

use App\Http\Controllers\EmployeeController;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Crypt;

class Staff extends Model
{
    use HasFactory;
    protected $connection = 'mysql';
    protected $fillable = [
        'user_id',
        'staff_no',
        'first_name',
        'last_name',
        'middle_name',
        'job_description',
        'department',
        'created_by'
    ];
    public function image()
    {
        $_formats = ['.jpeg', '.jpg', '.png'];
        $_path = 'http://bma.edu.ph:70/assets/img/staff/';
        //$_path = 'assets/image/student-picture/';
        $_image = "http://bma.edu.ph:70/assets/img/staff/avatar.png";
        foreach ($_formats as $format) {
            $_image = @fopen($_path . $this->user->name . $format, 'r') ? $_path . $this->user->name . $format : $_image;
        }
        return $_image;
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function subjects_handles()
    {
        return $this->hasMany(SubjectClass::class, 'staff_id')
            ->where('academic_id', Crypt::decrypt(request()->input('_academic')))
            ->where('is_removed', false);
    }

    // Staff Attendance
    public function attendance()
    {
        return $this->hasMany(EmployeeAttendance::class, 'staff_id')->where('created_at', 'like', '%' . now()->format('Y-m-d') . '%')->latest();
    }
    public function daily_attendance()
    {
        return $this->hasOne(EmployeeAttendance::class, 'staff_id')->where('created_at', 'like', '%' . date('Y-m-d') . '%')->latest();
    }
    public function attendance_list()
    {
        return $this->hasMany(EmployeeController::class, 'staff_id');
    }
    public function date_attendance($_date)
    {
        return $this->hasOne(EmployeeAttendance::class, 'staff_id')->where('created_at', 'like', '%' . $_date . '%')->first();
    }
}
