<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;
    protected $connection = 'mysql2';
    protected $fillable = ['name', 'email', 'ticket_number', 'contact_number', 'address'];

    public function concern()
    {
        return $this->hasOne(TicketConcern::class, 'ticket_id');
    }
    public function concern_issue()
    {
        return $this->hasOne(TicketConcern::class, 'ticket_id')->where('is_resolved', false);
    }
}
