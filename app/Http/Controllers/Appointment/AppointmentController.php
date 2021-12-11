<?php

namespace App\Http\Controllers\Appointment;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Doctor;
use App\Models\Patient;
use App\Models\Appointment\Appointment;
use Carbon\carbon;
use App\Models\Event;
use DB;
use Illuminate\Support\Facades\Validator;


class AppointmentController extends Controller
{
    // apoointment view start
    public function AppointmentView(){
        $doctors=Doctor::all();
        $patients=Patient::all();
        $appointments=Appointment::with('doctor','patient')->get();
        return view('Appointment.appointment_view',compact('doctors','patients','appointments'));
    }

    // apoointment store start
    public function AppointmentStore(Request $request){

        $validator = Validator::make($request->all(), [
            'patient_id'=> 'required',
            'doctor_dept'=>'required|max:20',
            'doctor_id'=>'required',
            'date'=>'required',
            'description'=>'required|max:191',
            'title'=>'required|max:10',
        ],
        [
            'patient_id.required'=>"Patient type is required",
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
            $appointment = new Appointment;
            $appointment->patient_id = $request->input('patient_id');
            $appointment->doctor_dept = $request->input('doctor_dept');
            $appointment->doctor_id = $request->input('doctor_id');
            $appointment->date = $request->input('date');
            $appointment->description = $request->input('description');
            $appointment->title = $request->input('title');
            $appointment->save();
            return response()->json([
                'status'=>200,
                'message'=>'Appointment Added Successfully.'
            ]);
            $notification = array(
                    'message' =>  'Appointment added Successfuly',
                    'alert-type' => 'success'
                );     
                
        }

    } // end method 

    // apoointment delete start
    public function AppointmentDelete($id){

        $appointments=Appointment::find($id);
        $appointments->delete();

        $notification = array(
            'message' =>  'Appointment Deleted Successfully',
            'alert-type' => 'success'
        );

        return Redirect()->back()->with($notification); 
    }

    // apoointment edit start
    public function AppointmentEdit($id){
        $appointments = Appointment::find($id);
        if($appointments)
        {
            return response()->json([
                'status'=>200,
                'appointments'=> $appointments,
            ]);
        }
        else
        {
            return response()->json([
                'status'=>404,
                'message'=>'No Appointment Found.'
            ]);
        }
    }

    // apoointment update start
    public function AppointmentUpdate(Request $request,$id){

        $validator = Validator::make($request->all(), [
            'patient_name_id'=> 'required',
            'doctor_dept_id'=> 'required',
            'doctor_name_id'=>'required',
            'appointment_date_id'=>'required',
            'description_id'=>'required',
            'title_id'=>'required',
        ],
    [
        'patient_name_id.required'=>'Patient name required',
        'doctor_dept_id.required'=>'Doctor department required',
        'doctor_name_id.required'=>'Doctor name required',
        'appointment_date_id.required'=>'appointment date required',
        'description_id.required'=>'description required',
        'title_id.required'=>'title required',
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
            $appointments = Appointment::find($id);
            if($appointments)
            {
                $appointments->patient_id = $request->input('patient_name_id');
                $appointments->doctor_dept = $request->input('doctor_dept_id');
                $appointments->doctor_id = $request->input('doctor_name_id');
                $appointments->date = $request->input('appointment_date_id');
                $appointments->description = $request->input('description_id');
                $appointments->title = $request->input('title_id');
                $appointments->update();
                return response()->json([
                    'status'=>200,
                    'message'=>'Appointment Updated Successfully.'
                ]);
            }
            else
            {
                return response()->json([
                    'status'=>404,
                    'message'=>'No Appointment Found.'
                ]);  
            }

        }
    }


    // apointment calender view page
    public function index(Request $request)
     {
     if($request->ajax())
    	{ 
            $data = Appointment::join('doctors', 'appointments.doctor_id', '=', 'doctors.id')
            ->select('appointments.id as id','appointments.date as date', 'doctors.name as title')
            ->get();
            return response()->json($data);
    	}
    	return view('Appointment.appointment_calender');
    }
          
}
