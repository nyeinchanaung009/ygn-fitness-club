<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use function PHPUnit\Framework\isEmpty;

class MonthlyFitnessData extends Model
{
    use HasFactory;
    protected $fillable = [
        'member_id',
        'weight',
        'height',
        'chest_size',
        'shoulder_size',
        'waist_size',
        'hip_size',
        'bmi_no',
        'bmi_status',
        'date',
    ];

    function Member(){
        return $this->belongsTo(Member::class);
    }

    public function scopeFilter($query,$filters){
        if(isset($filters['month']) && isset($filters['year'])){
            $query->whereMonth('date',$filters['month'])->whereYear('date',$filters['year']);
        }
        if(isset($filters['month'])){
            $query->whereMonth('date',$filters['month']);
        }
        if(isset($filters['year'])){
            $query->whereYear('date',$filters['year']);
        }
        if(isset($filters['search'])){
            $query->whereHas('member',function ($mquery) use($filters) {
                $mquery->where('name','LIKE','%'.$filters['search'].'%')->orWhere('id',$filters['search']);
            });
        }
    }
}
