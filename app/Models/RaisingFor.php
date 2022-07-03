<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RaisingFor extends Model
{
    use HasFactory;
    // protected $table = 'raising_for';


    public function fundraiser()
    {
        return $this->belongsToMany('App\Models\Fundraiser');
    }
}
