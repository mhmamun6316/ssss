<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Nurse\NurseController;
use App\Http\Controllers\Admin\AdminProfileController;

use App\Http\Controllers\Admin\AccountantController;
use App\Http\Controllers\Admin\PatientController;
use App\Http\Controllers\Admin\DoctorController;
use App\Http\Controllers\Admin\DoctorDeptController;
use App\Http\Controllers\Laboratorist\LaboratoristController;
use App\Http\Controllers\Admin\ReceptionistController;
use App\Http\Controllers\Pharmacist\PharmacistController;
use App\Http\Controllers\Blood_Bank\BloodDonorController;
use App\Http\Controllers\Blood_Bank\BloodDonationController;
use App\Http\Controllers\Blood_Bank\BloodIssueController;
use App\Http\Controllers\Blood_Bank\BloodGroupController;
use App\Http\Controllers\Bed\NewBedController;
use App\Http\Controllers\Bed\BedAssignController;
use App\Http\Controllers\CheckController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\Appointment\AppointmentController;
use App\Http\Controllers\Diagnosis\NewDiagnosisController;
use App\Http\Controllers\Diagnosis\DiagnosisController;
use App\Http\Controllers\Medicine\MedicineController;
use App\Http\Controllers\Medicine\MedicineListController;

use App\Http\Controllers\Record\RecordController;
use App\Http\Controllers\Admin\IndexController;
use App\Http\Controllers\Schedule\ScheduleController;
use App\Http\Controllers\Schedule\SchedulelistController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix'=> 'admin', 'middleware'=>['admin:admin']], function(){
	Route::get('/login', [AdminController::class, 'loginForm']);
	Route::post('/login',[AdminController::class, 'store'])->name('admin.login');
});

//// admin profile view
Route::get('/admin/profile', [AdminProfileController::class, 'AdminProfile'])->name('admin.profile');


// Admin Login View
// Route::middleware(['auth.admin:admin', 'verified'])->get('/admin/dashboard', function () {
//     return view('super_admin.home');
// })->name('dashboard');

route::get('admin/dashboard',[IndexController::class,'DashboardView']);


// frontend dashboard
Route::middleware(['auth:sanctum,web', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

//Schedule
Route::prefix('schedule')->group(function (){
  Route::get('/view',[ScheduleController::class,'ViewTimeSlot'])->name('all.timeslot');
  Route::post('/store',[ScheduleController::class,'StoreTimeSlot'])->name('store.timeslot');
  Route::get('delete/{id}',[ScheduleController::class,'DeleteTimeSlot'])->name('delete.timeslot');
  Route::get('edit-schedule/{id}',[ScheduleController::class,'EditTimeSlot'])->name('edit.timeslot');
  Route::put('/update/{id}',[ScheduleController::class,'UpdateTimeSlot'])->name('update.timeslot');
});

//Schedule
Route::prefix('schedulelist')->group(function (){
  Route::get('/view',[SchedulelistController::class,'ViewTimeSlotlist'])->name('all.timeslotlist');
  Route::post('/store',[SchedulelistController::class,'StoreTimeSlotlist'])->name('store.timeslotlist');
  Route::get('delete/{id}',[SchedulelistController::class,'DeleteTimeSlotlist'])->name('delete.timeslotlist');
  Route::get('edit-schedulelist/{id}',[SchedulelistController::class,'EditTimeSlotlist'])->name('edit.timeslotlist');
  Route::put('/update/{id}',[SchedulelistController::class,'UpdateTimeSlotlist'])->name('update.timeslotlist');
});

// Nurse Start
Route::prefix('nurse')->group(function () {
  Route::get('/view',[NurseController::class,'ViewNurse'])->name('view.nurse');
  Route::post('/add',[NurseController::class,'AddNurse'])->name('add.nurse');
  Route::post('/update',[NurseController::class,'UpdateNurse'])->name('update.nurse');
  Route::get('/delete/{id}',[NurseController::class,'DeleteNurse'])->name('delete.nurse');
  Route::get('edit-nurse/{id}',[NurseController::class,'EditNurse'])->name('edit.nurse'); 
  Route::get('/list/view',[NurseController::class,'ListNurseView'])->name('list.nurses'); 
  });
// Nurse End
Route::get('check/view',[CheckController::class,'index'])->name('view.nurse');
//All pharmacist  
Route::prefix('pharmacist')->group(function () {
  Route::get('/view',[PharmacistController::class,'ViewPharmacist'])->name('view.pharmacist');
  Route::post('/add',[PharmacistController::class,'AddPharmacist'])->name('add.pharmacist');
  Route::post('/update',[PharmacistController::class,'UpdatePharmacist'])->name('update.pharmacist');
  Route::get('/delete/{id}',[PharmacistController::class,'DeletePharmacist'])->name('delete.pharmacist');
  Route::get('edit-pharmacist/{id}',[PharmacistController::class,'EditPharmacist'])->name('edit.pharmacist');
  Route::get('/list/view',[PharmacistController::class,'ListPharmacistView'])->name('list.pharmacists'); 
 });
//pharmacist end


//admin login
Route::group(['prefix'=> 'admin', 'middleware'=>['admin:admin']], function(){

    // Admin Profile
	Route::get('/login', [AdminController::class, 'loginForm']);
	Route::post('/login',[AdminController::class, 'store'])->name('admin.login');

});
// admin logout route 
Route::get('admin/logout', [AdminController::class, 'loginForm'])->name('admin.logout');

// Patients routes goes here
Route::prefix('patient')->group(function (){
Route::get('/view',[PatientController::class,'index'])->name('all.patient');
Route::post('/store',[PatientController::class,'StorePatient'])->name('store.patient');
Route::get('delete/{id}',[PatientController::class,'DeletePatient'])->name('delete.patient');
Route::get('edit-patient/{id}',[PatientController::class,'EditPatient'])->name('edit.patient');
Route::post('/update',[PatientController::class,'UpdatePatient'])->name('update.patient');
Route::get('/list/view',[PatientController::class,'AllPatientView'])->name('list.patients');
});


// Doctors routes goes here
Route::prefix('doctor')->group(function () {
  Route::get('/all',[DoctorController::class,'index'])->name('all.doctor');
  Route::post('/store',[DoctorController::class,'StoreDoctor'])->name('store.doctor');
  Route::get('edit-doctor/{id}',[DoctorController::class,'EditDoctor'])->name('edit.doctor');
  Route::post('/update',[DoctorController::class,'UpdateDoctor'])->name('update.doctor');
  Route::get('/delete/{id}',[DoctorController::class,'DeleteDoctor'])->name('delete.doctor');
  Route::get('/list/view',[DoctorController::class,'AllDoctorView'])->name('list.doctors'); 
  Route::get('/single/view/{id}',[DoctorController::class,'SingleDoctorView'])->name('single.doctor');
});// Accountant All Route Group End 

// doctor department route goes here
Route::prefix('doctor/dept')->group(function () {
  Route::get('/all',[DoctorDeptController::class,'index'])->name('all.department');
  Route::post('/store',[DoctorDeptController::class,'StoreDoctorDept']);
  Route::get('/edit/{id}',[DoctorDeptController::class,'EditDoctorDept']);
  Route::post('/update',[DoctorDeptController::class,'UpdateDoctorDept']);
  Route::get('/delete/{id}',[DoctorDeptController::class,'DeleteDoctorDept'])->name('delete.doctorDept');
  // Route::get('/list/view',[DoctorDeptController::class,'AllDoctorView'])->name('list.doctors'); 
  // Route::get('/single/view/{id}',[DoctorDeptController::class,'SingleDoctorView'])->name('single.doctor');
});

// Accountant Start
Route::prefix('accountant')->group(function () {
  Route::get('/view', [AccountantController::class, 'AccountantView'])->name('all.accountant'); 
  Route::post('/add', [AccountantController::class, 'AccountantStore'])->name('accountant.add'); 
  Route::get('edit-accountant/{id}', [AccountantController::class, 'AccountEdit']); 
  Route::post('/update', [AccountantController::class, 'AccountUpdate'])->name('account.update');
  Route::get('/delete/{id}', [AccountantController::class, 'AccountDelete'])->name('accountant.delete'); 
  Route::get('changeStatus', [AccountantController::class, 'changeStatus']);
  Route::get('/list/view',[AccountantController::class,'ListAccountView'])->name('list.accountant'); 
  // Route::get('/deactive/{id}', [AccountantController::class, 'AccountantDeactive'])->name('accountant.deactive'); 
  // Route::get('/active/{id}', [AccountantController::class, 'AccountantActive'])->name('accountant.active');

  });// Admin Brand All Route Group End 

// Labroatorist Start
Route::prefix('laboratorist')->group(function () {
    Route::get('/view', [LaboratoristController::class, 'LaboratoristView'])->name('all.laboratorist'); 
    Route::post('/add', [LaboratoristController::class, 'LaboratoristStore'])->name('laboratorist.add'); 
    Route::get('edit-laboratorist/{id}', [LaboratoristController::class, 'LaboratoristEdit']); 
    Route::post('/update', [LaboratoristController::class, 'LaboratoristUpdate'])->name('laboratorist.update');
    Route::get('/delete/{id}', [LaboratoristController::class, 'LaboratoristDelete'])->name('laboratorist.delete');  
    Route::get('/list/view',[LaboratoristController::class,'ListlaboratoristView'])->name('list.laboratorist');   
  });
  // Admin  Labroatorist Route Group End

//    Receptionist Start
Route::prefix('receptionist')->group(function () {
    Route::get('/view', [ReceptionistController::class, 'ReceptionistView'])->name('all.receptionist'); 
    Route::post('/add', [ReceptionistController::class, 'ReceptionistStore'])->name('receptionist.add'); 
    Route::get('edit-receptionist/{id}', [ReceptionistController::class, 'ReceptionistEdit']); 
    Route::post('/update', [ReceptionistController::class, 'ReceptionistUpdate'])->name('receptionist.update');
    Route::get('/delete/{id}', [ReceptionistController::class, 'ReceptionistDelete'])->name('receptionist.delete');
    Route::get('/list/view', [ReceptionistController::class, 'ListReceptionistView'])->name('list.receptionists'); 
    });// Admin Brand All Route Group End 


  // Blood Issue
   Route::prefix('blood')->group(function () {
        Route::get('/issue/view', [BloodIssueController::class, 'BloodIssueView'])->name('blood.issue');  
        Route::get('/donor/group/{donor_id}', [BloodIssueController::class, 'BloodDonorGroup']);
        Route::post('/issue/store', [BloodIssueController::class, 'BloodIssueStore'])->name('blood_issue.store');
        Route::get('/issue/delete/{id}', [BloodIssueController::class, 'BloodIssueDelete'])->name('delete.blood.issue');
        Route::get('/issue/edit/{bloodissue_id}', [BloodIssueController::class, 'BloodIssueEdit']);
        Route::get('/donor/group/edit/{blood_id}', [BloodIssueController::class, 'BloodDonorGroupEdit']);
        Route::put('/issue/update/{id}', [BloodIssueController::class, 'BloodDonorGroupUpdate'])->name('bloodissue.update');  
  });

 // Blood Donor Start
 Route::prefix('bloodDonor')->group(function () {
    Route::get('/view', [BloodDonorController::class, 'BloodDonorView'])->name('all.blooddonor'); 
    Route::post('/add', [BloodDonorController::class, 'BloodDonorStore'])->name('blooddonor.add'); 
    Route::get('edit-blooddonor/{id}', [BloodDonorController::class, 'BloodDonorEdit']); 
    Route::put('/update/{id}', [BloodDonorController::class, 'BloodDonorUpdate'])->name('blooddonor.update');
    Route::get('/delete/{id}', [BloodDonorController::class, 'BloodDonorDelete'])->name('blooddonor.delete');   
  });

//Blood Donor End

// Blood Donation Start
Route::prefix('bloodDonation')->group(function () {
    Route::get('/view', [BloodDonationController::class, 'BloodDonationView'])->name('all.blooddonation'); 
    Route::post('/add', [BloodDonationController::class, 'BloodDonationStore'])->name('blooddonation.add'); 
    Route::get('edit-blooddonation/{id}', [BloodDonationController::class, 'BloodDonationEdit']); 
    Route::put('/update/{id}', [BloodDonationController::class, 'BloodDonationUpdate'])->name('blooddonation.update');
    Route::get('/delete/{id}', [BloodDonationController::class, 'BloodDonationDelete'])->name('blooddonation.delete'); 
  });
//Blood Donation End

// Blood Donation Start
Route::prefix('bloodgroup')->group(function () {
    Route::get('/view', [BloodGroupController::class, 'BloodGroupView'])->name('all.bloodgroup'); 
    Route::post('/add', [BloodGroupController::class, 'BloodGroupStore']); 
    Route::get('/edit-bloodgroup/{id}', [BloodGroupController::class, 'BloodGroupedit']); 
    Route::put('/update/{id}', [BloodGroupController::class, 'BloodGroupUpdate']);
    Route::get('/delete/{id}', [BloodGroupController::class, 'BloodGroupDelete'])->name('bloodgroup.delete'); 
  });
//Blood Donation End

Route::prefix('NewBedType')->group(function () {
  Route::get('/view', [NewBedController::class, 'NewBedTypeView'])->name('all.newbedtype'); 
  Route::post('/add', [NewBedController::class, 'NewBedTypeStore'])->name('newbedtype.add'); 
  Route::get('/edit-newbedtype/{id}', [NewBedController::class, 'NewBedTypeEdit']); 
  Route::put('/update/{id}', [NewBedController::class, 'NewBedTypeUpdate'])->name('newbedtype.update');
  Route::get('/delete/{id}', [NewBedController::class, 'NewBedTypeDelete'])->name('newbedtype.delete'); 
});
//New Bed Type End

// New Bed Start
Route::prefix('NewBed')->group(function () {
  Route::get('/view', [NewBedController::class, 'NewBedView'])->name('all.newbed'); 
  Route::post('/add', [NewBedController::class, 'NewBedStore'])->name('newbed.add'); 
  Route::get('/edit-newbed/{id}', [NewBedController::class, 'NewBedEdit']); 
  Route::put('/update/{id}', [NewBedController::class, 'NewBedUpdate'])->name('newbed.update');
  Route::get('/delete/{id}', [NewBedController::class, 'NewBedDelete'])->name('newbed.delete');
}); 

// New Bed Start
Route::prefix('BedAssign')->group(function () {
  Route::get('/view', [BedAssignController::class, 'BedAssignView'])->name('all.assignbed');
  Route::post('/add', [BedAssignController::class, 'BedAssignStore']);
  Route::get('/status', [BedAssignController::class, 'BedAssignStatus'])->name('bed.status');
  Route::get('/edit/{id}', [BedAssignController::class, 'BedAssignEdit']);
  Route::put('/update/{id}', [BedAssignController::class, 'BedAssignUpdate']);
  Route::get('/delete/{id}', [BedAssignController::class, 'BedAssignDelete'])->name('allotment.delete');
});

// Appointment start
Route::prefix('Appointment')->group(function () {
  Route::get('/view', [AppointmentController::class, 'AppointmentView'])->name('all.appointment');
  Route::post('/store', [AppointmentController::class, 'AppointmentStore'])->name('appointment.store');
  Route::get('/edit/{id}', [AppointmentController::class, 'AppointmentEdit'])->name('edit.appointment');
  Route::get('/delete/{id}', [AppointmentController::class, 'AppointmentDelete'])->name('delete.appointment');
  Route::put('/update/{id}', [AppointmentController::class, 'AppointmentUpdate'])->name('update.appointment');

  Route::get('/calender', [AppointmentController::class, 'index']);
});
// For Diagonosis
Route::prefix('Diagnosis')->group(function (){
  Route::get('/view', [NewDiagnosisController::class, 'DiagnosisCategoryView'])->name('all.diagnosisCategory');
  Route::post('/store', [NewDiagnosisController::class, 'DiagnosisCategoryStore'])->name('diagnosisCategory.add');
  Route::get('/edit/{id}', [NewDiagnosisController::class, 'DiagnosisCategoryEdit']);
  Route::put('/update/{id}', [NewDiagnosisController::class, 'DiagnosisCategoryUpdate'])->name('update.diagnosisCategory');
  Route::get('/delete/{id}', [NewDiagnosisController::class, 'DiagnosisCategoryDelete'])->name('delete.diagnosisCategory');
});


// Appointment start
Route::prefix('Diagnsosis')->group(function () {  
  Route::get('/view', [DiagnosisController::class, 'DignsosisTestView'])->name('all.diagnosis_test');
  Route::post('/store', [DiagnosisController::class, 'DignsosisTestStore'])->name('store.diagnosis_test');
  Route::get('/delete/{id}', [DiagnosisController::class, 'DignsosisTestDelete'])->name('delete.diagnosisTest');
  Route::get('/edit-Diagnosis-test/{id}', [DiagnosisController::class, 'DiagnosisCategoryEdit']);
  Route::post('/update/test', [DiagnosisController::class, 'DiagnosisCategoryUpdate'])->name('update.diagnosisTest');   
});  



Route::prefix('Medicine')->group(function () {  

  // Medicine type start
  Route::get('/type/view', [MedicineController::class, 'MedicineTypeView'])->name('all.medicine');
  Route::post('/type/store', [MedicineController::class, 'MedicineTypeStore'])->name('store.medicine');
  Route::get('/type/edit/{id}', [MedicineController::class, 'MedicineTypeEdit']);
  Route::put('/type/update/{id}', [MedicineController::class, 'MedicineTypeUpdate'])->name('update.medicine');
  Route::get('/type/delete/{id}', [MedicineController::class, 'MedicineTypeDelete'])->name('delete.medicine');
  //Medicine type end

  //  Medicine category start
  Route::get('/category/view', [MedicineController::class, 'MedicineCategoryView'])->name('all.medicinecategory');
  Route::post('/category/store', [MedicineController::class, 'MedicineCategoryStore'])->name('store.medicinecategory');
  Route::get('/category/edit/{id}', [MedicineController::class, 'MedicineCategoryEdit']);
  Route::put('/category/update/{id}', [MedicineController::class, 'MedicineCategoryUpdate'])->name('update.medicinecategory');
  Route::get('/category/delete/{id}', [MedicineController::class, 'MedicineCategoryDelete'])->name('delete.medicinecategory');
  //  Medicine category end

  //  Medicine Manufacture start
  Route::get('/manufacture/view', [MedicineController::class, 'MedicineManufactureView'])->name('all.medicinemanufacture');
  Route::post('/manufacture/store', [MedicineController::class, 'MedicineManufactureStore'])->name('store.medicinemanufacture');
  Route::get('/manufacture/edit/{id}', [MedicineController::class, 'MedicineManufactureEdit']);
  Route::put('/manufacture/update/{id}', [MedicineController::class, 'MedicineManufactureUpdate'])->name('update.medicinemanufacture');
  Route::get('/manufacture/delete/{id}', [MedicineController::class, 'MedicineManufactureDelete'])->name('delete.medicinemanufacture');
  //  Medicine manufacture end

  //  Medicine List start
  Route::get('/list/view', [MedicineListController::class, 'MedicineListView'])->name('all.medicinelist');
  Route::post('/list/store', [MedicineListController::class, 'MedicineListStore'])->name('store.medicinelist');
  Route::get('/list/edit/{id}', [MedicineListController::class, 'MedicineListEdit']);
  Route::post('/list/update', [MedicineListController::class, 'MedicineListUpdate'])->name('update.medicinelist');
  Route::get('/list/delete/{id}', [MedicineListController::class, 'MedicineListDelete'])->name('delete.medicinelist');
  //  Medicine List end

});



// Birth & Death Record Start
Route::prefix('Record')->group(function () {  
  // birth record
  Route::get('/birth/view', [RecordController::class, 'BirthView'])->name('all.birth_record'); 
  Route::post('/birth/store', [RecordController::class, 'BirthStore'])->name('store.birth_record');
  Route::get('/birth/delete/{id}', [RecordController::class, 'BirthDelete'])->name('delete.birth_record');
  Route::get('/birth/edit/{id}', [RecordController::class, 'BirthEdit']);
  Route::post('/birth/update', [RecordController::class, 'BirthUpdate'])->name('update.birth_record');

  // birth record
  Route::get('/death/view', [RecordController::class, 'DeathView'])->name('all.death_record'); 
  Route::post('/death/store', [RecordController::class, 'DeathStore'])->name('store.death_record');
  Route::get('/death/delete/{id}', [RecordController::class, 'DeathDelete'])->name('delete.death_record');
  Route::get('/death/edit/{id}', [RecordController::class, 'DeathEdit']);
  Route::post('/death/update', [RecordController::class, 'DeathUpdate'])->name('update.death_record');
}); 




