<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TicketConcern extends Model
{
    use HasFactory;
    protected $connection = 'mysql2';
    protected $fillable = ['ticket_id', 'issue_id', 'ticket_message'];

    public function issue()
    {
        return $this->belongsTo(TicketIssue::class, 'issue_id');
    }
    public function chat()
    {
        return $this->hasOne(TicketChat::class, 'concern_id');
    }
    public function conversion()
    {
        return $this->hasMany(TicketChat::class,'concern_id');
    }

    public function ticket_issue()
    {
        return $this->belongsTo(TicketIssue::class, 'issue_id');
    }
    public function ticket()
    {
        return $this->belongsTo(Ticket::class, 'ticket_id');
    }
    public function chat_message()
    {
        return  $this->hasMany(TicketChat::class, 'concern_id');
    }
}
