<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class AboutU extends Model
{
    use HasFactory;

    protected $table = 'about_us';
    protected $primaryKey = 'id';
}