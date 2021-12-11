<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Accountant;
use Image;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;

class AccountantController extends Controller
{
   // method for all patient data 
   public function AccountantView(){
   $patients = Accountant::latest()->get();
   return view('super_admin.accountant.view_accountant',compact('patients'));
   }

    // method for storing patient data
    public function AccountantStore(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:100',
            'email' => 'required|unique:accountants|email',
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
              $patient=new Accountant;
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
              Image::make($file)->resize(300,300)->save('uploads/accountant/'.$extension);
              $save_url = 'uploads/accountant/'.$extension;
              $patient->image= $save_url;
              $patient->save();
              return response()->json([
                'status'=>200,
                'message'=>'Accountant Added Successfully.'
            ]);
            }
            else{

            
              $patient=new Accountant;
              $patient->name=$request->input('name');
              $patient->email=$request->input('email');
              $patient->password=$request->input('password');
              $patient->address=$request->input('address');
              $patient->phone=$request->input('phone');
              $patient->sex=$request->input('gender');
              $patient->dob=$request->input('dob');
              $patient->age=$request->input('age');
              $patient->blood_group=$request->input('blood_group');
              $patient->image = 'uploads/accountant/check.jpg';
              $patient->save();
              return response()->json([
                'status'=>200,
                'message'=>'Accountant Added Successfully.'
            ]);
          }
        }
    }

  // method for editing patient data
  public function AccountEdit($id){
      $patient = Accountant::find($id);
      return response()->json([
          'status' =>200,
          'patient' => $patient,
      ]);
  }

  // method for updating data
  public function AccountUpdate(Request $request){

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
              Image::make($file)->resize(300,300)->save('uploads/accountant/'.$extension);
              $save_url = 'uploads/accountant/'.$extension;

              $patient_id=$request->input('patient_id');
              $patient = Accountant::find($patient_id);
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
                  'message'=>'Accountant Updated Successfully.'
              ]);
            }  
            else{
            $patient_id=$request->input('patient_id');
            $patient = Accountant::find($patient_id);
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
                'message'=>'Accountant Updated Successfully.'
            ]);
           }
      } 

  }

  // method for deleting patient data
  public function AccountDelete($id){

      $patient = Accountant::findOrFail($id);
      if($patient->image){
          $img = $patient->image;
          unlink($img);
      }

      Accountant::findOrFail($id)->delete();
      $notification = array(
          'message' =>  'Accountant Deleted Sucessyfully',
          'alert-type' => 'info'
      ); 
      return redirect()->back()->with($notification);
     } 


    public function changeStatus(Request $request){
    
        $patient = Accountant::find($request->id);
        $patient->status = $request->status;
        $patient->save();

        return response()->json(['success'=>'Status change successfully.']);
    } 
     

    // all acountant list in dashboard
    public function ListAccountView(){
        $listaccountants = Accountant::latest()->get();
        return view('super_admin.accountant.list_accountant',compact('listaccountants'));
    }

}
