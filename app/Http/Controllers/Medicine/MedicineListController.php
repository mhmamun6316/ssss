<?php

namespace App\Http\Controllers\Medicine;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Medicine\MedicineList;
use App\Models\Medicine\MedicineCategory;
use App\Models\Medicine\Medicine_manufacture;
use App\Models\Medicine\Medicine;
use Image;

class MedicineListController extends Controller
{
    //
    
     // Medicine List View
     public function MedicineListView(){
        $medicine_cat = MedicineCategory::orderBy('name', 'ASC')->get();
        $medicine_type = Medicine::orderBy('name', 'ASC')->get();
        $medicine_manufacture = Medicine_manufacture::orderBy('name', 'ASC')->get();
        $medicinelsts= MedicineList::with('Medicinecategory','Medicinetype','MedicineManufacture')->get();

        // dd($medicinelsts);
        
        return View('Medicine.view_medicine_list', compact('medicinelsts','medicine_manufacture','medicine_type','medicine_cat'));
  
    }// end method
   
     // Medicine List store
          public function MedicineListStore(Request $request){

        //  dd($request->all());
          // Medicine list validation
          
        

             $image = $request->file('image');
            $name_gen=hexdec(uniqid()).'.'.$image->getClientOriginalExtension();

             dd($name_gen);
             
          $request->validate([
          'name' => 'required',   
        //   'image' => 'required',
        //   'medicine_name' => 'required',  
        //   'manufacture_id' => 'required',  
        //   'category_id' => 'required', 
        //   'type_id' => 'required',
        //   'details' => 'required',
          
          ]);
        

           $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
           Image::make($image)->resize(300,300)->save('uploads/medicine/'.$name_gen);
           $save_url = 'uploads/medicine/'.$name_gen;
 
          // Medicine list Insert    
          MedicineList::insert([
          'manufacture_id' => $request->manufacture_id,
          'category_id' => $request->category_id,
          'type_id' => $request->type_id,
          'name' => $request->name,
          'quantity' => $request->quantity,
          'price' => $request->price,
          'expire_date' => $request->expire_date,
          'image' => $save_url,  
          'description' => $request->description,                          
          ]);    
          $notification = array(
              'message' =>  'Medicine List Added Successfuly',
              'alert-type' => 'success'
          );     
          return redirect()->back()->with($notification);   
       } // end method

        // method for editing medicine list data
            public function MedicineListEdit($id){
            $medicine_cat = MedicineCategory::orderBy('name', 'ASC')->get();
            $medicine_type = Medicine::orderBy('name', 'ASC')->get();
            $medicine_manufacture = Medicine_manufacture::orderBy('name', 'ASC')->get();
            $medicinelist = MedicineList::find($id);
            return response()->json([
                'status' =>200,
                'medicinelist' => $medicinelist,
                'medicine_manufacture'=>$medicine_manufacture,
                'medicine_type'=>$medicine_type,
                'medicine_cat'=>$medicine_cat,
            ]);
        }


    // method for updating data
    public function MedicineListUpdate(Request $request){
        $old_img  = $request->old_image;

    if ($request->file('image')) {

        unlink($old_img);
        $image = $request->file('image');
        $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        Image::make($image)->resize(300,300)->save('uploads/medicine/'.$name_gen);
        $save_url = 'uploads/medicine/'.$name_gen;
  

      $medicinelist_id=$request->input('medicinelist_id');
      $medicinelist =MedicineList::find($medicinelist_id);
      $medicinelist->manufacture_id=$request->manufacture_id;
      $medicinelist->category_id=$request->category_id;
      $medicinelist->type_id=$request->type_id;
      $medicinelist->name=$request->name;
      $medicinelist->quantity=$request->quantity;
      $medicinelist->price=$request->price;
      $medicinelist->expire_date=$request->expire_date;
      $medicinelist->image=$save_url;
      $medicinelist->description=$request->description;
      $medicinelist->update();

      $notification=array(
          'message'=>' Medicine List Updated Success',
          'alert-type'=>'success'
      );

      return Redirect()->back()->with($notification);
    }
    else{
        $medicinelist_id=$request->input('medicinelist_id');
        $medicinelist =MedicineList::find($medicinelist_id);
        $medicinelist->manufacture_id=$request->manufacture_id;
        $medicinelist->category_id=$request->category_id;
        $medicinelist->type_id=$request->type_id;
        $medicinelist->name=$request->name;
        $medicinelist->quantity=$request->quantity;
        $medicinelist->price=$request->price;
        $medicinelist->expire_date=$request->expire_date;
        $medicinelist->description=$request->description;
        $medicinelist->update();
  
        $notification=array(
            'message'=>' Medicine List Updated Success',
            'alert-type'=>'success'
        );
  
        return Redirect()->back()->with($notification);
    }
}

    // delete Medicine List
    public function MedicineListDelete($id){

      $medicinelist = MedicineList::findOrFail($id);
      MedicineList::findOrFail($id)->delete(); 
      return redirect()->back();
    }
}