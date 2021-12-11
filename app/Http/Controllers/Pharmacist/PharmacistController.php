<?php

namespace App\Http\Controllers\Pharmacist;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pharmacist;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Image; 
use Illuminate\Validation\Rules\Password;
class PharmacistController extends Controller
{
        // method for all patient data 
    public function ViewPharmacist(){
        $patients = Pharmacist::latest()->get();

        return view('super_admin.pharmacist.view_pharmacist',compact('patients'));
    }

    // method for storing patient data
    public function AddPharmacist(Request $request){
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
                $patient=new Pharmacist;
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
                    Image::make($file)->resize(300,300)->save('uploads/pharmacist/'.$extension);
                    $save_url = 'uploads/pharmacist/'.$extension;
                    $patient->image= $save_url;
                $patient->save();
                return response()->json([
                'status'=>200,
                'message'=>'pharmacist Added Successfully.'
             ]);
            }
            else{
                $patient=new Pharmacist;
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
                'message'=>'Pharmacist Added Successfully.'
            ]);
            }
        }
    }

    // method for editing patient data
    public function EditPharmacist($id){
        $patient = Pharmacist::find($id);
        return response()->json([
            'status' =>200,
            'patient' => $patient,
        ]);
    }

    // method for updating data
    public function UpdatePharmacist(Request $request){

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
                Image::make($file)->resize(300,300)->save('uploads/pharmacist/'.$extension);
                $save_url = 'uploads/pharmacist/'.$extension;

                $patient_id=$request->input('patient_id');
                $patient = Pharmacist::find($patient_id);
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
                    'message'=>'Pharmacist Updated Successfully.'
                ]);
        }  
        else{
            $patient_id=$request->input('patient_id');
            $patient = Pharmacist::find($patient_id);

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
                'message'=>'Pharmacist Updated Successfully.'
            ]);
        }
    } 

    }

    // method for deleting patient data
    public function ReceptionistDelete($id){

        $patient = Pharmacist::findOrFail($id);
        if($patient->image){
            $img = $patient->image;
            unlink($img);
        }

        Pharmacist::findOrFail($id)->delete();
        $notification = array(
            'message' =>  'Receptionist Delete Sucessyfully',
            'alert-type' => 'info'
        ); 
        return redirect()->back()->with($notification);
    } 

    // all pharmacist view in dashboard
    public function ListPharmacistView(){
        $listpharmacists = Pharmacist::latest()->get();
        return view('super_admin.pharmacist.list_pharmacist',compact('listpharmacists'));
    }

}//main end
