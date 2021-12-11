<?php

namespace App\Http\Controllers\Laboratorist;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Laboratorist\Laboratorist;
use Illuminate\Support\Facades\Validator;
use Image; 
use Illuminate\Validation\Rules\Password;

class LaboratoristController extends Controller
{
      // method for all patient data 
  public function LaboratoristView(){
    $patients = Laboratorist::latest()->get();
    return view('super_admin.laboratorist.view_laboratorist',compact('patients'));
    }
  
     // method for storing patient data
     public function LaboratoristStore(Request $request){
         $validator = Validator::make($request->all(), [
             'name' => 'required|max:100',
             'email' => 'required|unique:laboratorists|email',
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
               $patient=new Laboratorist;
               $patient->name=$request->input('name');
               $patient->email=$request->input('email');
               $patient->password=$request->input('password');
               $patient->address=$request->input('address');
               $patient->phone=$request->input('phone');
               $patient->sex=$request->input('gender');
               $patient->dob=$request->input('dob');
               $patient->age=$request->input('age');
               $patient->blood_group=$request->input('blood_group');
               $file = $request->file('image');
               $extension = hexdec(uniqid()).'.'.$file->getClientOriginalExtension();
               Image::make($file)->resize(300,300)->save('uploads/laboratorist/'.$extension);
               $save_url = 'uploads/laboratorist/'.$extension;
               $patient->image= $save_url;
               $patient->save();
               return response()->json([
                 'status'=>200,
                 'message'=>'Patient Added Successfully.'
                ]);
             }
             else{
               $patient=new Laboratorist;
               $patient->name=$request->input('name');
               $patient->email=$request->input('email');
               $patient->password=$request->input('password');
               $patient->address=$request->input('address');
               $patient->phone=$request->input('phone');
               $patient->sex=$request->input('gender');
               $patient->dob=$request->input('dob');
               $patient->age=$request->input('age');
               $patient->blood_group=$request->input('blood_group');
               $patient->image = 'uploads/patient/check.jpg';
               $patient->save();
               return response()->json([
                 'status'=>200,
                 'message'=>'Laboratorist Added Successfully.'
             ]);
           }
         }
     }
  
   // method for editing patient data
   public function LaboratoristEdit($id){
       $patient = Laboratorist::find($id);
       return response()->json([
           'status' =>200,
           'patient' => $patient,
       ]);
   }
  
   // method for updating data
   public function LaboratoristUpdate(Request $request){
  
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
               Image::make($file)->resize(300,300)->save('uploads/laboratorist/'.$extension);
               $save_url = 'uploads/laboratorist/'.$extension;
  
               $patient_id=$request->input('patient_id');
               $patient = Patient::find($patient_id);
               $patient->name = $request->input('name');
               $patient->email=$request->input('email');
               $patient->address=$request->input('address');
               $patient->phone=$request->input('phone');
               $patient->sex=$request->input('gender1');
               $patient->dob=$request->input('dob');
               $patient->age=$request->input('age');
               $patient->image=$save_url;
               $patient->blood_group=$request->input('bloodgrp');
               $patient->update();
               return response()->json([
                   'status'=>200,
                   'message'=>'Laboratorist Updated Successfully.'
               ]);
             }  
             else{
             $patient_id=$request->input('patient_id');
             $patient = Laboratorist::find($patient_id);
  
             $patient->name = $request->input('name');
             $patient->email=$request->input('email');
             $patient->address=$request->input('address');
             $patient->phone=$request->input('phone');
             $patient->sex=$request->input('gender1');
             $patient->dob=$request->input('dob');
             $patient->age=$request->input('age');
             $patient->blood_group=$request->input('bloodgrp');
             $patient->update();
             return response()->json([
                 'status'=>200,
                 'message'=>'Laboratorist Updated Successfully.'
             ]);
            }
       } 
  
   }
  
   // method for deleting patient data
   public function LaboratoristDelete($id){
       $patient = Laboratorist::findOrFail($id);
       if($patient->image){
           $img = $patient->image;
           unlink($img);
       }
  
       Laboratorist::findOrFail($id)->delete();
       $notification = array(
           'message' =>  'Laboratorist Delete Sucessfully',
           'alert-type' => 'info'
       ); 
       return redirect()->back()->with($notification);
     }  

      // all laboratorist view in dashboard
    public function ListlaboratoristView(){
        $listlaboratorists = Laboratorist::latest()->get();
        return view('super_admin.laboratorist.list_laboratorist',compact('listlaboratorists'));
    }
  
}
