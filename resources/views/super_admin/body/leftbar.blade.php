 <div id="sidebar-menu">
     <!-- Left Menu Start -->
     <ul class="metismenu list-unstyled" id="side-menu">
         <li class="menu-title">Main</li>

         <li>
             <a href="{{ url('/admin/dashboard') }}" class="waves-effect">
                 <i class="ti-home"></i>
                 <span>Dashboard</span>
             </a>
         </li>

         <li>
            <a href="javascript: void(0);" class="has-arrow waves-effect">
                <i class="ti-email"></i>
                <span>Schedule</span>
            </a>
            <ul class="sub-menu" aria-expanded="false">
                <li><a href="{{ route('all.timeslot') }}">Time Slot List</a></li>
            </ul>
            <ul class="sub-menu" aria-expanded="false">
                <li><a href="{{ route('all.timeslotlist') }}">Schedule list</a></li>
            </ul>
        </li>
         <li>
             <a href="{{ route('all.patient') }}" class="waves-effect">
                 <i class="ti-home"></i>
                 <span>Manage Patient</span>
             </a>
         </li>
         <li>
             <a href="javascript: void(0);" class="has-arrow waves-effect">
                 <i class="ti-email"></i>
                 <span> Manage Doctor</span>
             </a>
             <ul class="sub-menu" aria-expanded="false">
                 <li><a href="{{ route('all.department') }}">Doctor Department</a></li>
             </ul>
             <ul class="sub-menu" aria-expanded="false">
                 <li><a href="{{ route('all.doctor') }}">All Doctor</a></li>
             </ul>
         </li>
         <li>
             <a href="{{ route('all.laboratorist') }}" class="waves-effect">
                 <i class="ti-home"></i>
                 <span>Manage Laboratorist</span>
             </a>
         </li>
         <li>
             <a href="{{ route('all.receptionist') }}" class="waves-effect">
                 <i class="ti-home"></i>
                 <span>Manage Receptionist</span>
             </a>
         </li>
         <li>
             <a href="{{ route('view.pharmacist') }}" class="waves-effect">
                 <i class="ti-home"></i>
                 <span>Manage Pharmacist</span>
             </a>
         </li>

         <li>
             <a href="{{ route('view.nurse') }}" class="waves-effect">
                 <i class="ti-email"></i>
                 <span>Manage Nurse</span>
             </a>
         </li>
         {{-- For Blood Bank --}}
         <li>
             <a href="javascript: void(0);" class="has-arrow waves-effect">
                 <i class="ti-email"></i>
                 <span>Blood Bank</span>
             </a>
             <ul class="sub-menu" aria-expanded="false">
                 <li><a href="{{ route('blood.issue') }}">Blood Issue</a></li>
             </ul>
             <ul class="sub-menu" aria-expanded="false">
                 <li><a href="{{ route('all.bloodgroup') }}">Blood Group</a></li>
             </ul>
             <ul class="sub-menu" aria-expanded="false">
                 <li><a href="{{ route('all.blooddonation') }}">Blood Donation</a></li>
             </ul>
             <ul class="sub-menu" aria-expanded="false">
                 <li><a href="{{ route('all.blooddonor') }}">Blood Donor</a></li>
             </ul>
         </li>
         {{-- for patient Bed --}}
         <li>
             <a href="javascript: void(0);" class="has-arrow waves-effect">
                 <i class="ti-email"></i>
                 <span>Manage Bed</span>
             </a>
             <ul class="sub-menu" aria-expanded="false">
                 <li><a href="{{ route('all.assignbed') }}">New Bed Assign</a></li>
             </ul>
             <ul class="sub-menu" aria-expanded="false">
                 <li><a href="{{ route('all.newbed') }}">New Bed</a></li>
             </ul>
             <ul class="sub-menu" aria-expanded="false">
                 <li><a href="{{ route('all.newbedtype') }}">New Bed Type</a></li>
             </ul>
         </li>
         <li>
             <a href="{{ route('all.appointment') }}" class="waves-effect">
                 <i class="ti-home"></i>
                 <span>Appointment</span>
             </a>
         </li>

         <li>
             <a href="javascript: void(0);" class="has-arrow waves-effect">
                 <i class="ti-email"></i>
                 <span>Manage Diagnosis</span>
             </a>
             <ul class="sub-menu" aria-expanded="false">
                 <li><a href="{{ route('all.diagnosisCategory') }}">Diagnosis Categeory</a></li>
             </ul>
             <ul class="sub-menu" aria-expanded="false">
                 <li><a href="{{ route('all.diagnosis_test') }}">Diagnosis Test</a></li>
             </ul>
         </li>
         <li>
             <a href="javascript: void(0);" class="has-arrow waves-effect">
                 <i class="ti-email"></i>
                 <span>Manage Medicine</span>
             </a>
             <ul class="sub-menu" aria-expanded="false">
                 <li><a href="{{ route('all.medicinemanufacture') }}">Medicine Manufacture</a></li>
             </ul>
             <ul class="sub-menu" aria-expanded="false">
                 <li><a href="{{ route('all.medicinecategory') }}">Medicine Category</a></li>
             </ul>
             <ul class="sub-menu" aria-expanded="false">
                 <li><a href="{{ route('all.medicine') }}">Medicine Type</a></li>
             </ul>
             <ul class="sub-menu" aria-expanded="false">
                 <li><a href="{{ route('all.medicinelist') }}">Medicine List</a></li>
             </ul>

         </li>

         <li>
             <a href="javascript: void(0);" class="has-arrow waves-effect">
                 <i class="ti-email"></i>
                 <span>Manage Record</span>
             </a>
             <ul class="sub-menu" aria-expanded="false">
                 <li><a href="{{ route('all.birth_record') }}">Birth Record</a></li>
             </ul>
             <ul class="sub-menu" aria-expanded="false">
                 <li><a href="{{ route('all.death_record') }}">Death Record</a></li>
             </ul>
         </li>


         <li>
             <a href="{{ route('all.accountant') }}" class="waves-effect">
                 <i class="ti-home"></i>
                 <span>Manage Accountant</span>
             </a>
         </li>


     </ul>
 </div>
