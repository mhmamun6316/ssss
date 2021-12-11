<?php

namespace App\Models\Appointment;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

   public function patient(){
       return $this->belongsTo("App\Models\Patient",'patient_id');
   }

   public function doctor(){
       return $this->belongsTo("App\Models\Doctor",'doctor_id');
   }
}
