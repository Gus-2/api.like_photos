<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Picture extends Model
{
    protected $fillable = [
        'title', 'description', 'image'
    ];

    public function user() {
        return $this->belongsTo('App\User');
    }
}
