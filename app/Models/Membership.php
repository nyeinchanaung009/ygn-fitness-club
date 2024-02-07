<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Membership extends Model
{
    use HasFactory;

    protected $fillable = [
        'member_id',
        'plan_id',
        'plan_start_date',
        'plan_expire_date',
    ];

    function member(){
        return $this->belongsTo(Member::class);
    }

    function plan(){
        return $this->belongsTo(Plan::class);
    }

    public function scopeFilter($query,$filters){
        if(isset($filters['search'])){
            $query->whereHas('member',function($mquery) use($filters) {
                $mquery->where('name','LIKE','%'.$filters['search'].'%')->orWhere('id',$filters['search']);
            });
        }
        if(isset($filters['type'])){
            $now = Carbon::now()->format('Y-m-d');
            if($filters['type'] == 'active'){
                $query->where('plan_expire_date','>',$now);
            }
            if($filters['type'] == 'expired'){
                $query->where('plan_expire_date','<=',$now);
            }
        }
    }
}
