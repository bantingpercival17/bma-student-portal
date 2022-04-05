<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;
    protected $connection = 'mysql2';
    protected $fillable = ['name', 'email', 'ticket_number', 'contact_number', 'address'];
}
