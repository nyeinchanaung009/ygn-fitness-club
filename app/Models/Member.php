<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'dob',
        'phone',
        'gender',
        'address',
        'status',
        'branch_id'
    ];

    function branch(){
        return $this->belongsTo(Branch::class);
    }

    function membership(){
        return $this->hasOne(Membership::class);
    }

    function Monthlyfitnessdata(){
        return $this->hasOne(MonthlyFitnessData::class);
    }

    public function scopeFilter($query,$filters){
        if(isset($filters['branch'])){
            $query->where('branch_id',$filters['branch']);
        }
        if(isset($filters['search'])){
            $query->where('name','LIKE','%'.$filters['search'].'%')->orWhere('id',$filters['search']);
        }
    }
}
