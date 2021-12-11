<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Doctor;
use App\Models\Appointment\Appointment;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Image; 
use Illuminate\Validation\Rules\Password;

class DoctorController extends Controller
{
  // method for all patient data 
 public function index(){
    $patients = Doctor::latest()->get();
    return view('super_admin.doctor.view_doctor',compact('patients'));
    }
 
     // method for storing patient data
     public function StoreDoctor(Request $request){
         $validator = Validator::make($request->all(), [
             'name' => 'required|max:100',
             'email' => 'required|unique:doctors|email',
             'password' => [
                         'required',
                         Password::min(8)
                         ->letters()
                         ->numbers()
                     ],
             'address' => 'required',
             'phone' => 'required|numeric|digits_between: 1,11',
             'dob' => 'required',
             'blood_group' => 'required',
             'gender' => 'required',
             'age' => 'required|numeric',
 
         ]);
         if($validator->fails())
         {
             return response()->json([
                 'status'=>400,
                 'errors'=>$validator->messages()
             ]);
         }
         else{
         
               if ($request->file('image')) {
               $patient=new Doctor;
               $patient->name=$request->input('name');
               $patient->email=$request->input('email');
               $patient->password=$request->input('password');
               $patient->address=$request->input('address');
               $patient->phone=$request->input('phone');
               $patient->sex=$request->input('gender');
               $patient->dob=$request->input('dob');
               $patient->age=$request->input('age');
               $patient->blood_group=$request->input('blood_group');
               $patient->profile=$request->input('profile');
               $patient->doc_dept=$request->input('doc_dept');
               $patient->social_link=$request->input('social_link');
               $file = $request->file('image');
               $extension = hexdec(uniqid()).'.'.$file->getClientOriginalExtension();
               Image::make($file)->resize(300,300)->save('uploads/doctor/'.$extension);
               $save_url = 'uploads/doctor/'.$extension;
               $patient->image= $save_url;
               $patient->save();
               return response()->json([
                 'status'=>200,
                 'message'=>'Doctor Added Successfully.'
             ]);
             }
             else{
 
             
               $patient=new Doctor;
               $patient->name=$request->input('name');
               $patient->email=$request->input('email');
               $patient->password=$request->input('password');
               $patient->address=$request->input('address');
               $patient->phone=$request->input('phone');
               $patient->sex=$request->input('gender');
               $patient->dob=$request->input('dob');
               $patient->age=$request->input('age');
               $patient->blood_group=$request->input('blood_group');
               $patient->profile=$request->input('profile');
               $patient->doc_dept=$request->input('doc_dept');
               $patient->social_link=$request->input('social_link');
               $patient->save();
               return response()->json([
                 'status'=>200,
                 'message'=>'Patient Added Successfully.'
             ]);
           }
         }
     }
 
   // method for editing patient data
   public function EditDoctor($id){
       $patient = Doctor::find($id);
       return response()->json([
           'status' =>200,
           'patient' => $patient,
       ]);
   }
 
   // method for updating data
   public function UpdateDoctor(Request $request){
 
       $validator = Validator::make($request->all(), [
           'name' => 'required|max:100',
           'email' => 'required|email',
           'address' => 'required',
           'phone' => 'required|numeric|digits_between: 1,11',
           'dob' => 'required',
           'bloodgrp' => 'required',
           'gender1' => 'required',
           'age' => 'required|numeric',
 
       ]);
       if($validator->fails())
       {
           return response()->json([
               'status'=>400,
               'errors'=>$validator->messages()
           ]);
       }
       else
       {
           if ($request->file('image')) {
               $old_img  = $request->old_image;
               unlink($old_img);
               $file = $request->file('image');
               $extension = hexdec(uniqid()).'.'.$file->getClientOriginalExtension();
               Image::make($file)->resize(300,300)->save('uploads/patient/'.$extension);
               $save_url = 'uploads/patient/'.$extension;
 
               $patient_id=$request->input('patient_id');
               $patient = Doctor::find($patient_id);
               $patient->name = $request->input('name');
               $patient->email=$request->input('email');
               $patient->address=$request->input('address');
               $patient->phone=$request->input('phone');
               $patient->sex=$request->input('gender1');
               $patient->dob=$request->input('dob');
               $patient->age=$request->input('age');
               $patient->image=$save_url;
               $patient->blood_group=$request->input('bloodgrp');
               $patient->profile=$request->input('profile');
               $patient->doc_dept=$request->input('doc_dept');
               $patient->social_link=$request->input('social_link');
               $patient->update();
               return response()->json([
                   'status'=>200,
                   'message'=>'Doctor Updated Successfully.'
               ]);
             }  
             else{
             $patient_id=$request->input('patient_id');
             $patient = Doctor::find($patient_id);
 
             $patient->name = $request->input('name');
             $patient->email=$request->input('email');
             $patient->address=$request->input('address');
             $patient->phone=$request->input('phone');
             $patient->sex=$request->input('gender1');
             $patient->dob=$request->input('dob');
             $patient->age=$request->input('age');
             $patient->blood_group=$request->input('bloodgrp');
             $patient->profile=$request->input('profile');
             $patient->doc_dept=$request->input('doc_dept');
             $patient->social_link=$request->input('social_link');
             $patient->update();
             return response()->json([
                 'status'=>200,
                 'message'=>'Patient Updated Successfully.'
             ]);
            }
       } 
 
   }
 
   // method for deleting patient data
   public function DeleteDoctor($id){
 
       $patient = Doctor::findOrFail($id);
       if($patient->image){
           $img = $patient->image;
           unlink($img);
       }
 
       Doctor::findOrFail($id)->delete();
       $notification = array(
           'message' =>  'Doctor Deleted Sucessfully',
           'alert-type' => 'info'
       ); 
       return redirect()->back()->with($notification);
      } 


    // all doctor view in dashboard
    public function AllDoctorView(){

        $listdoctors = Doctor::latest()->get();
        return view('super_admin.doctor.list_doctor',compact('listdoctors'));
    }


    // single doctor view in dashboard
    public function SingleDoctorView($id){
        $doctor = Doctor::find($id);

        $appointments = Appointment::where('doctor_id',$id)->count();
        $appointmentsAll = Appointment::where('doctor_id',$id)->get();
        // dd($appointmentsAll);
        return view('super_admin.doctor.single_doctor',compact('doctor','appointments','appointmentsAll'));
    }

}
