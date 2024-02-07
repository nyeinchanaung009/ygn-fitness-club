<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'address',
    ];

    function admin(){
        return $this->hasMany(User::class,'branch_id','id');
    }

    function member(){
        return $this->hasMany(Member::class,'branch_id','id');
    }
}
