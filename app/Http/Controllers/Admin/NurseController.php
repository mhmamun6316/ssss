<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Nurse;
use Image;

class NurseController extends Controller
{
    //view nurse
    public function ViewNurse(){
        $nurses=Nurse::all();
        return view('admin.nurse.view_nurse',compact('nurses'));
        
    }//end method

    //add nurse info
    public function AddNurse(Request $request){

        // validation 
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required', 
            'password' => 'required',  
            'image' => 'required',      
          ],[ 
            'name.required' => 'Input Nurse name',
            'email.required' => 'Input nurse email',
            'phone.required' => 'Input nurse phone ',
            'password.required' => 'Input nurse password',
            'image.required' => 'Input nurse image',
           
         
          ]);
        // img upload and save
        $image = $request->file('image');
        $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        Image::make($image)->resize(300,300)->save('upload/nurse/'.$name_gen);
        $save_url = 'upload/nurse/'.$name_gen;

        $nurseInfo=new Nurse();
        $nurseInfo->name=$request->name;
        $nurseInfo->email=$request->email;
        $nurseInfo->phone=$request->phone;
        $nurseInfo->password=$request->password;
        $nurseInfo->address=$request->address;
        $nurseInfo->sex=$request->sex;
        $nurseInfo->dob=$request->dob;
        $nurseInfo->age=$request->age;
        $nurseInfo->blood_group=$request->blood_group;
        $nurseInfo->image= $save_url;
        $nurseInfo->save();
        return redirect()->back()->with('message','Nurse info added successfully');
    }//end method

    //uplodad image
    protected function uploadImage($request){
         $image = $request->file('image');
        $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        Image::make($image)->resize(50,50)->save('upload/nurse/'.$name_gen);
        $save_url = 'upload/nurse/'.$name_gen;
        return $save_url;
    }//end method


    //update nurse info with image
    protected function updateNurseInfoWithImage($nurseInfo,$request,$save_url){
        $nurseInfo->name=$request->name;
        $nurseInfo->email=$request->email;
        $nurseInfo->phone=$request->phone;
        $nurseInfo->password=$request->password;
        $nurseInfo->address=$request->address;
        $nurseInfo->sex=$request->sex;
        $nurseInfo->dob=$request->dob;
        $nurseInfo->age=$request->age;
        $nurseInfo->blood_group=$request->blood_group;
        $nurseInfo->image= $save_url;
        $nurseInfo->save();
    }//end method


    //update nurse info without image
    protected function updateNurseINfoWithOutImage($nurseInfo,$request){
        $nurseInfo->name=$request->name;
        $nurseInfo->email=$request->email;
        $nurseInfo->phone=$request->phone;
        $nurseInfo->password=$request->password;
        $nurseInfo->address=$request->address;
        $nurseInfo->sex=$request->sex;
        $nurseInfo->dob=$request->dob;
        $nurseInfo->age=$request->age;
        $nurseInfo->blood_group=$request->blood_group;
    }//end method

    //update nurse info
    public function UpdateNurse(Request $request){
        $nurseInfo=Nurse::find($request->nurse_id);
        $old_image=$nurseInfo->image;

        if($request->file('image')){
            @unlink($old_image);
             //image upload
            $save_url=$this->uploadImage($request);
        //update data with image
            $this->updateNurseInfoWithImage($nurseInfo,$request,$save_url);
       
        
        return redirect()->back()->with('message','Nurse info updated successfully');

        } else{
            //update data without image
            $this->updateNurseINfoWithOutImage($nurseInfo,$request);
           
        $nurseInfo->save();
        return redirect()->back()->with('message','Nurse info updated successfully');

        }
    }//end method

    //delete nurse info
    public function DeleteNurse($id){
        $nurse=Nurse::find($id);
        $image=$nurse->image;
        unlink( $image);
        $nurse->delete();
        return redirect()->back();
    }//end method


    // method for editing nurse data
    public function EditNurse($id){
        $nurse = Nurse::find($id);
        return response()->json([
            'status' =>200,
            'nurse' => $nurse,
        ]);
    }//end method  

    // all nurse list in dashboard
    public function ListNurseView(){
        $listnurses = Nurse::latest()->get();
        return view('super_admin.nurse.list_nurses',compact('listnurses'));
    }
}//main end
