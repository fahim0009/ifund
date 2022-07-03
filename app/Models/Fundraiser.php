<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fundraiser extends Model
{
    use HasFactory;

    public function raisingfor()
    {
        return $this->belongsToMany('App\Models\RaisingFor');
    }
}
