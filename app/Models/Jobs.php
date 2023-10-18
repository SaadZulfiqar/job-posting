<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jobs extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'Jobs';
    protected $fillable = [
        'title',
        'description',
        'salary',
        'company',
        'postedAt'
    ];
}
