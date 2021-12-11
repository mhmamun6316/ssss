<?php

namespace App\Http\Controllers\Blood_Bank;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Blood_bank\BloodDonor;
use Illuminate\Support\Facades\Validator;

class BloodDonorController extends Controller
{

     // Blood Donor View
     public function BloodDonorView(){

        $blooddonors= BloodDonor::latest()->get();
    
        return View('Blood_Bank.Blood_Donor.view_blood_donor', compact('blooddonors'));
    
        }// end method

        public function BloodDonorStore(Request $request){   
                      
                $validator = Validator::make($request->all(), [
                    'name' => 'required',   
                    'age' => 'required', 
                    'gender' => 'required',
                    'blood_group' => 'required',        
                    'last_donation_date' => 'required'  
                ],[
                    'name.required' => 'Blood donor name is required',
                    'blood_group.required' => 'Blood group required',
                    'last_donation_date.required' => 'Date field is required',
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
                    $blooddonor = new BloodDonor;
                    $blooddonor->name = $request->input('name');
                    $blooddonor->age = $request->input('age');
                    $blooddonor->gender = $request->input('gender');
                    $blooddonor->blood_group = $request->input('blood_group');
                    $blooddonor->last_donation_date = $request->input('last_donation_date');
                    $blooddonor->save();

                    return response()->json([
                        'status'=>200,
                        'message'=>'Blood Donor Added Successfully',
                    ]);
                }
        
          } // end method 
          
    // method for editing blood donor data
    public function BloodDonorEdit($id){
        $blooddonor = BloodDonor::find($id);
        return response()->json([
            'status' =>200,
            'blooddonor' => $blooddonor,
        ]);
    }

    // method for updating data
    public function BloodDonorUpdate(Request $request,$id){

        $validator = Validator::make($request->all(), [
            'name'=> 'required|max:191',
            'age'=> 'required|numeric',
            'blood_group'=> 'required',
            'last_donation_date'=> 'required',
            ],[
                'name.required' => 'Blood donor name is required'
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
            $blooddonor = BloodDonor::find($id);
            if($blooddonor)
            {
                $blooddonor->name = $request->input('name');
                $blooddonor->age = $request->input('age');
                $blooddonor->gender = $request->input('gender');
                $blooddonor->last_donation_date = $request->input('last_donation_date');
                $blooddonor->update();
                return response()->json([
                    'status'=>200,
                    'message'=>'Blood donor name Updated Successfully.'
                ]);
            }
            else
            {
                return response()->json([
                    'status'=>404,
                    'message'=>'Blood donor type Found.'
                ]);
            }
        }  
    }

    // Blood donor delete start
    public function BloodDonorDelete($id){
        $blooddonor = BloodDonor::findOrFail($id);
        BloodDonor::findOrFail($id)->delete(); 
        return redirect()->back();
    }
}
