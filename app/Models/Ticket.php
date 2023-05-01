<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable = [
        'subject',
        'status',
        'priority',
        'department_id',
        'user_id',
        'agent_id',
        'closed_by',
        'closed_at',
    ];

    protected $casts = [
        'closed_at' => 'datetime',
    ];
}
