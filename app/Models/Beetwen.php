<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Beetwen extends Model
{
    use HasFactory;
    protected $fillable = ['tanggal', 'name'];
    protected $table = 'beetwen';
}
