<?php

namespace App\Http\Controllers\Schedule;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Schedule\Schedule;
use Illuminate\Support\Facades\Validator;

class ScheduleController extends Controller
{
    //
    public function ViewTimeSlot()

    {
        $diagnosiscats= Schedule::latest()->get();
        return view('super_admin.schedule.view_schedule_slot',compact('diagnosiscats'));
    }
     // new time slot store
     public function StoreTimeSlot(Request $request){   
        
        $validator = Validator::make($request->all(), [
        'slot_name'=> 'required|max:10',
        'slot_time'=>'required',
        'status'=>'required',
            
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
            $diagnosis = new Schedule;
            $diagnosis->slot_name = $request->input('slot_name');
            $diagnosis->slot_time = $request->input('slot_time');
            $diagnosis->status = $request->input('status');
            $diagnosis->save();
            return response()->json([
                'status'=>200,
                'message'=>'Time Slot added Successfully.'
            ]);
            $notification = array(
                    'message' =>  'Time Slot  added Successfuly',
                    'alert-type' => 'success'
                );     
                
        }
    } // end method 

    // new diagnosis category edit
    public function EditTimeSlot($id){
        $diagnosiscat = Schedule::find($id);
        if($diagnosiscat)
        {
            return response()->json([
                'status'=>200,
                'diagnosiscat'=> $diagnosiscat,
            ]);
        }
        else
        {
            return response()->json([
                'status'=>404,
                'message'=>'No diagnosis Found.'
            ]);
        }
    }


    //  new diagnosis category update
    public function UpdateTimeSlot(Request $request,$id){
        
        $validator = Validator::make($request->all(), [
            'slot_name'=> 'required|max:10',
            // 'slot_time'=>'required|max:191',
            'status'=>'required',
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
            $diagnosis = Schedule::find($id);
            if($diagnosis)
            {
                $diagnosis->slot_name = $request->input('slot_name');
                $diagnosis->slot_time = $request->input('slot_time');
                $diagnosis->status = $request->input('status');
                $diagnosis->update();
                return response()->json([
                    'status'=>200,
                    'message'=>'Schedule Updated Successfully.'
                ]);
            }
            else
            {
                return response()->json([
                    'status'=>404,
                    'message'=>'No Schedule Found.'
                ]);  
            }

        }
    }

    //diagnosis category delete
    public function DeleteTimeSlot($id){
        $diagnosis = Schedule::findOrFail($id);
        Schedule::findOrFail($id)->delete(); 
        return redirect()->back(); 
    }//end method
}
