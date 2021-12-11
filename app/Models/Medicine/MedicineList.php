<?php

namespace App\Models\Medicine;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedicineList extends Model
{
    use HasFactory;
    protected $guarded = [];

      //for medicine category
    public function Medicinecategory(){
    	return $this->belongsTo(MedicineCategory::class,'category_id','id');
    }
    //for medicine type
    public function Medicinetype(){
    	return $this->belongsTo(Medicine::class,'type_id','id');
    }
    //for medicine manufacture
    public function MedicineManufacture(){
    	return $this->belongsTo(Medicine_manufacture::class,'manufacture_id','id');
    }
}
