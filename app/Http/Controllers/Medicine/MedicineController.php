<?php

namespace App\Http\Controllers\Medicine;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Medicine\Medicine;
use App\Models\Medicine\MedicineCategory;
use App\Models\Medicine\Medicine_manufacture;
use Illuminate\Support\Facades\Validator;

class MedicineController extends Controller
{
    
    // Medicine type View
    public function MedicineTypeView(){

        $medicinetypes= Medicine::latest()->get();
        return View('Medicine.view_medicine_type', compact('medicinetypes'));
  
    }// end method

    // Medicine type store
    public function MedicineTypeStore(Request $request){

        $validator = Validator::make($request->all(), [
            'name'=> 'required|max:191',
        ],[
            'name.required' => 'Medicine type name is required'
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
            $medicine = new Medicine;
            $medicine->name = $request->input('name');
            $medicine->save();
            return response()->json([
                'status'=>200,
                'message'=>'Medicine Type Added Successfully',
            ]);
        }

    } // end mathod

    // Medicine type edit
    public function MedicineTypeEdit($id){
        $medicinetype = Medicine::find($id);
        return response()->json([
            'status' =>200,
            'medicinetype' => $medicinetype,
        ]);
    }

    // Medicine type update
    public function MedicineTypeUpdate(Request $request,$id){

      $validator = Validator::make($request->all(), [
            'name'=> 'required|max:191',
        ],[
            'name.required' => 'Medicine type name is required'
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
            $medicine = Medicine::find($id);
            if($medicine)
            {
                $medicine->name = $request->input('name');
                $medicine->update();
                return response()->json([
                    'status'=>200,
                    'message'=>'Medicine Type Name Updated Successfully.'
                ]);
            }
            else
            {
                return response()->json([
                    'status'=>404,
                    'message'=>'No medicine type Found.'
                ]);
            }

        }  

    }

    // Medicine type delete
    public function MedicineTypeDelete($id){

      $medicinetype = Medicine::findOrFail($id);
      Medicine::findOrFail($id)->delete(); 
      return redirect()->back();
    }

// /////////////////////////////////////Medicine Category//////////////////////////////////////////


     // Medicine Category View
     public function MedicineCategoryView(){

        $medicinecategorys= MedicineCategory::latest()->get();
        return View('Medicine.view_medicine_category',compact('medicinecategorys'));

    }// end method

   
    // Medicine category store
    public function MedicineCategoryStore(Request $request){ 

        $validator = Validator::make($request->all(), [
            'name'=> 'required|max:191',
        ],[
            'name.required' => 'Medicine category name is required'
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
            $medicinecategory = new MedicineCategory;
            $medicinecategory->name = $request->input('name');
            $medicinecategory->save();
            return response()->json([
                'status'=>200,
                'message'=>'Medicine Category Added Successfully',
            ]);
        }
    } // end method


    // medicine categor edit
    public function MedicineCategoryEdit($id){
        $medicinecategory = MedicineCategory::find($id);
        return response()->json([
            'status' =>200,
            'medicinecategory' => $medicinecategory,
        ]);
    }


    // medicince category update
    public function MedicineCategoryUpdate(Request $request, $id){

        $validator = Validator::make($request->all(), [
            'name'=> 'required|max:191',
        ],[
            'name.required' => 'Medicine category name is required'
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
            $medicinecategory = MedicineCategory::find($id);
            if($medicinecategory)
            {
                $medicinecategory->name = $request->input('name');
                $medicinecategory->update();
                return response()->json([
                    'status'=>200,
                    'message'=>'Medicine Category Updated Successfully.'
                ]);
            }
            else
            {
                return response()->json([
                    'status'=>404,
                    'message'=>'No medicine category Found.'
                ]);
            }

        }      
    }

    // medicince category delete
    public function MedicineCategoryDelete($id){

      $medicinecategory = MedicineCategory::findOrFail($id);
      MedicineCategory::findOrFail($id)->delete(); 
      return redirect()->back();
      
    }


///////////////////////////////////////////Medicine Manufacture//////////////////////////////////////////////


     // Medicine Manufacture View
     public function MedicineManufactureView(){

        $medicinemanufactures= Medicine_manufacture::latest()->get();
        return View('Medicine.view_medicine_manufacture', compact('medicinemanufactures'));
  
    }// end method
   
     // Medicine manufacture store
    public function MedicineManufactureStore(Request $request){

        $validator = Validator::make($request->all(), [
            'name'=> 'required|max:191',
            'email' => 'required|unique:medicine_manufactures',
            'phone_number' => 'required|numeric', 
        ],[
            'name.required' => 'Medicine manufacture name is required'
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
            $medicinemanufacture = new Medicine_manufacture;
            $medicinemanufacture->name = $request->input('name');
            $medicinemanufacture->email = $request->input('email');
            $medicinemanufacture->phone_number = $request->input('phone_number');
            $medicinemanufacture->note = $request->input('note');
            $medicinemanufacture->address = $request->input('address');
            $medicinemanufacture->save();
            return response()->json([
                'status'=>200,
                'message'=>'Medicine Manufacturer Added Successfully',
            ]);
        }

    } // end method

    // method for editing medicine manufacture data
        public function MedicineManufactureEdit($id){
        $medicinemanufacture = Medicine_manufacture::find($id);
        return response()->json([
            'status' =>200,
            'medicinemanufacture' => $medicinemanufacture,
        ]);
    }

    // method for updating data
    public function MedicineManufactureUpdate(Request $request,$id){

       $validator = Validator::make($request->all(), [
            'name'=> 'required|max:191',
            'email' => 'required',
            'phone_number' => 'required|numeric', 
        ],[
            'name.required' => 'Medicine manufacture name is required'
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
            $medicinemanufacture = Medicine_manufacture::find($id);
            if($medicinemanufacture)
            {
                $medicinemanufacture->name = $request->input('name');
                $medicinemanufacture->email = $request->input('email');
                $medicinemanufacture->phone_number = $request->input('phone_number');
                $medicinemanufacture->note = $request->input('note');
                $medicinemanufacture->address = $request->input('address');
                $medicinemanufacture->update();
                return response()->json([
                    'status'=>200,
                    'message'=>'Medicine Manufacturer Updated Successfully.'
                ]);
            }
            else
            {
                return response()->json([
                    'status'=>404,
                    'message'=>'No Manufacturer Found.'
                ]);
            }

        }      
    }

    // delete Medicine manufacture
    public function MedicineManufactureDelete($id){

      $medicinemanufacture = Medicine_manufacture::findOrFail($id);
      Medicine_manufacture::findOrFail($id)->delete(); 
      return redirect()->back();
    }
}

