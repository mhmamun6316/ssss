<?php

namespace App\Http\Controllers\Nurse;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Nurse\Nurse;
use Illuminate\Support\Facades\Validator;
use Image; 
use Illuminate\Validation\Rules\Password;

class NurseController extends Controller
{
       // method for all patient data 
    public function ViewNurse(){
        $patients = Nurse::latest()->get();

        return view('super_admin.nurse.view_nurse',compact('patients'));
    }

    // method for storing patient data
    public function AddNurse(Request $request){
    $validator = Validator::make($request->all(), [
        'name' => 'required|max:100',
        'email' => 'required|unique:receptionists|email',
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
                $patient=new Nurse;
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
                    Image::make($file)->resize(300,300)->save('uploads/nurse/'.$extension);
                    $save_url = 'uploads/nurse/'.$extension;
                    $patient->image= $save_url;
                $patient->save();
                return response()->json([
                'status'=>200,
                'message'=>'Nurse Added Successfully.'
            ]);
            }
            else{

            
                $patient=new Nurse;
                $patient->name=$request->input('name');
                $patient->email=$request->input('email');
                $patient->password=$request->input('password');
                $patient->address=$request->input('address');
                $patient->phone=$request->input('phone');
                $patient->sex=$request->input('gender');
                $patient->dob=$request->input('dob');
                $patient->age=$request->input('age');
                $patient->blood_group=$request->input('blood_group');
                $patient->save();
                return response()->json([
                'status'=>200,
                'message'=>'Nurse Added Successfully.'
            ]);
            }
        }
    }

    // method for editing patient data
    public function EditNurse($id){
        $patient = Nurse::find($id);
        return response()->json([
            'status' =>200,
            'patient' => $patient,
        ]);
    }

    // method for updating data
    public function UpdateNurse(Request $request){

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
                Image::make($file)->resize(300,300)->save('uploads/nurse/'.$extension);
                $save_url = 'uploads/nurse/'.$extension;

                $patient_id=$request->input('patient_id');
                $patient = Nurse::find($patient_id);
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
                    'message'=>'Nurse Updated Successfully.'
                ]);
        }  
        else{
            $patient_id=$request->input('patient_id');
            $patient = Nurse::find($patient_id);

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
                'message'=>'Nurse Updated Successfully.'
            ]);
        }
    } 

    }

    // method for deleting patient data
    public function ReceptionistDelete($id){

        $patient = Nurse::findOrFail($id);
        if($patient->image){
            $img = $patient->image;
            unlink($img);
        }

        Nurse::findOrFail($id)->delete();
        $notification = array(
            'message' =>  'Nurse Deleted Sucessfully',
            'alert-type' => 'info'
        ); 
        return redirect()->back()->with($notification);
    } 
}
