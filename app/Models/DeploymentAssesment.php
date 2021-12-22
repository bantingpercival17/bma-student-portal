<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeploymentAssesment extends Model
{
    use HasFactory;
    protected $fillable = ['student_id', 'agency_id', 'staff_id', 'is_removed'];

    public function agency()
    {
        return $this->belongsTo(ShippingAgencies::class, 'agency_id');
    }
}
