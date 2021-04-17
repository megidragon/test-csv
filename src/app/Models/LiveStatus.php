<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LiveStatus extends Model
{
    use HasFactory;

    public static $STARTING = 'starting';
    public static $IN_PROCESS = 'in_process';
    public static $FINISHED = 'finished';

    protected $table = 'live_status';

    protected $fillable = ['status', 'session_id'];
}
