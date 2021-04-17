<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Csv extends Model
{
    use HasFactory;

    protected $table = 'csv';

    public $incrementing = false;

    protected $fillable = ['id', 'session_id', 'zone', 'from', 'to'];

    public $timestamps = false;
}
