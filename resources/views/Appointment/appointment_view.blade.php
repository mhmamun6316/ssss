@extends('layouts.admin_master')

@section('super-admin-content')

    <style>
        .topBar {
            margin-top: 4rem;
        }

        .topBar {
            padding: 2rem;
        }

        .card-title {
            display: flex;
            justify-content: space-between;
        }

        .modal-body .row .col-md-6 {
            margin-bottom: 1rem;
        }

        .ImgBox img {
            border-radius: 50%;
        }

        .circle {
            height: 80px;
            width: 80px;
            display: block;
            background-color: darkseagreen;
            border-radius: 80px;
            position: relative;
        }

        .word {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }

        .modal-body select,
        .modal-body input {
            border: none;
            background: #f5f8fa !important;
            border-radius: 5%;
        }

        .addapoint {
            margin-left: 1rem;
        }

        .card-title i {
            color: rgb(70, 75, 104);
        }

        .errorColor {
            color: red;
        }

    </style>

    <div class="container-full topBar">

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">

                        <h4 class="card-title text-center">All Appointment
                            <!-- Button trigger modal -->
                            <div class="d-flex">
                                <a href="{{ url('Appointment/calender') }}"><i class="fas fa-calendar-alt fa-2x"></i></a>
                                <button type="button" class="btn btn-success addapoint" data-bs-toggle="modal"
                                    data-bs-target="#addModal">
                                    New Appointment
                                </button>
                            </div>
                        </h4>

                        <!-- Modal for add doctor -->
                        <div class="modal fade bd-example-modal-lg" id="addModal" tabindex="-1"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Appointment</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>

                                    <form>
                                        @csrf
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Patient<span class="errorColor"> *</span></label>
                                                        <select name="patient_name" class="patient_id form-control"
                                                            required="">
                                                            <option value="" selected="" disabled="">Select Patient Name
                                                            </option>
                                                            @foreach ($patients as $patient)
                                                                <option value="{{ $patient->id }}">{{ $patient->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                        <span id="error_patient" class="errorColor"></span>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Doctor Dept<span class="errorColor"> *</span></label>
                                                        <select name="doctor_dept_id" class="doctor_dept form-control"
                                                            required="">
                                                            <option value="" selected="" disabled="">Select Doctor
                                                                Department
                                                            </option>
                                                            @foreach ($doctors as $doctor)
                                                                <option value="{{ $doctor->doc_dept }}">
                                                                    {{ $doctor->doc_dept }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                        <span id="error_doc_dept" class="errorColor"></span>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Doctor<span class="errorColor"> *</span></label>
                                                        <select name="doctor_name" class="doctor_id form-control"
                                                            required="">
                                                            <option value="" selected="" disabled="">Select Doctor
                                                            </option>
                                                            @foreach ($doctors as $doctor)
                                                                <option value="{{ $doctor->id }}">
                                                                    {{ $doctor->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                        <span id="error_doc_name" class="errorColor"></span>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Date<span class="errorColor"> *</span></label>
                                                        <input type="datetime-local" required class="date form-control">
                                                        <span id="error_datee" class="errorColor"></span>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>title<span class="errorColor"> *</span></label>
                                                        <input type="text" class="title form-control"
                                                            placeholder="Enter description" name="title">
                                                        <span id="error_title" class="errorColor"></span>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Description<span class="errorColor"> *</span></label>
                                                        <textarea class="description form-control"
                                                            name="description"></textarea>
                                                        <span id="error_description" class="errorColor"></span>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Close</button>
                                            <button type="button" class="btn btn-info add_appointment">Save</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <!-- Modal for add Edit doctor -->
                        <div class="modal fade bd-example-modal-lg" id="editModal" tabindex="-1"
                            aria-labelledby="editModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Update Blood Issue</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>

                                    <form>
                                        @csrf
                                        <input type="hidden" id="appointment_id">
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Patient</label>
                                                        <select id="patient_name_id" class="form-control" required="">
                                                            <option value="" selected="" disabled="">Select Patient Name
                                                                <span class="errorColor"> *</span>
                                                            </option>
                                                            @foreach ($patients as $patient)
                                                                <option value="{{ $patient->id }}">
                                                                    {{ $patient->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                        <span id="error_patienttt" class="errorColor"></span>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Doctor Dept</label>
                                                        <select id="doctor_dept_id" class="form-control" required="">
                                                            <option value="" selected="" disabled="">Select Doctor
                                                                Department<span class="errorColor"> *</span>
                                                            </option>
                                                            @foreach ($doctors as $doctor)
                                                                <option value="{{ $doctor->doc_dept }}">
                                                                    {{ $doctor->doc_dept }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                        <span id="error_doc_depttt" class="errorColor"></span>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Doctor</label>
                                                        <select id="doctor_name_id" class="form-control" required="">
                                                            <option value="" selected="" disabled="">Select Doctor<span
                                                                    class="errorColor"> *</span>
                                                            </option>
                                                            @foreach ($doctors as $doctor)
                                                                <option value="{{ $doctor->id }}">
                                                                    {{ $doctor->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                        <span id="error_doc_nameee" class="errorColor"></span>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Date<span class="errorColor"> *</span></label>
                                                        <input type="datetime-local" class="form-control"
                                                            id="appointment_date_id">
                                                        <span id="error_dateee" class="errorColor"></span>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>title<span class="errorColor"> *</span><span
                                                                class="errorColor"> *</span></label>
                                                        <input type="text" class="title form-control"
                                                            placeholder="Enter description" id="title_id">
                                                        <span id="error_titleee" class="errorColor"></span>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Description<span class="errorColor"> *</span></label>
                                                        <textarea class="form-control" id="description_id"></textarea>
                                                        <span id="error_descriptionnn" class="errorColor"></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Close</button>
                                            <button type="button" class="btn btn-info update_appointments">update</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>


                        <div id="datatable-buttons_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                            <div class="row">
                                <div class="col-sm-12">
                                    <table id="datatable-buttons"
                                        class="table table-striped table-bordered dt-responsive nowrap dataTable no-footer dtr-inline text-center align-middle"
                                        style="border-collapse: collapse; border-spacing: 0px; width: 100%;" role="grid"
                                        aria-describedby="datatable-buttons_info">
                                        <thead>
                                            <tr>
                                                <th>Patient</th>
                                                <th>Doctor</th>
                                                <th>Doctor Dept</th>
                                                <th>Date</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>

                                        <tbody class="text-center">
                                            @foreach ($appointments as $appointment)
                                                <td>{{ $appointment['patient']['name'] }}</td>
                                                <td>{{ $appointment['doctor']['name'] }}</td>
                                                <td>{{ $appointment->doctor_dept }}</td>
                                                <td>{{ $appointment['date'] }}</td>
                                                <td>
                                                    <button type="button" value="{{ $appointment->id }}"
                                                        class="btn btn-success editBtn btn-sm"><i
                                                            class="fa fa-pencil-alt"></i></button>
                                                    <a href="{{ route('delete.appointment', $appointment->id) }}"
                                                        class="btn btn-sm btn-danger" id="delete" title="delete data">
                                                        <i class="fa fa-trash"></i>
                                                    </a>
                                                </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> <!-- end col -->
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {

            $(document).on('click', '.editBtn', function() {
                var appointment_id = $(this).val();
                // alert(appointment_id);
                $('#editModal').modal('show');
                $.ajax({
                    type: "GET",
                    url: "/Appointment/edit/" + appointment_id,
                    success: function(response) {
                        // console.log(response.appointments); 
                        $('#appointment_id').val(response.appointments.id);
                        $('#patient_name_id').val(response.appointments.patient_id);
                        $('#doctor_dept_id').val(response.appointments.doctor_dept_id);
                        $('#doctor_name_id').val(response.appointments.doctor_id);
                        $('#appointment_date_id').val(response.appointments.date);
                        $('#description_id').val(response.appointments.description);
                        $('#title_id').val(response.appointments.title);
                    }
                })
            });
            // for adding and validation

            // for adding data using ajax
            $(document).on('click', '.add_appointment', function(e) {
                e.preventDefault();
                $(this).text('Sending..');
                var data = {
                    'patient_id': $('.patient_id').val(),
                    'doctor_dept': $('.doctor_dept').val(),
                    'doctor_id': $('.doctor_id').val(),
                    'date': $('.date').val(),
                    'description': $('.description').val(),
                    'title': $('.title').val(),

                }
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: "POST",
                    url: "/Appointment/store",
                    data: data,
                    dataType: "json",
                    success: function(response) {
                        if (response.status == 400) {
                            $('#error_patient').text(response.errors.patient_id);
                            $('#error_doc_dept').text(response.errors.doctor_dept);
                            $('#error_doc_name').text(response.errors.doctor_id);
                            $('#error_datee').text(response.errors.date);
                            $('#error_description').text(response.errors.description);
                            $('#error_title').text(response.errors.title);
                            $('.add_appointment').text('Save');
                        } else {
                            $('#addModal').find('input').val('');
                            $('.add_appointment').text('Save');
                            $('#addModal').modal('hide');
                            toastr.success(response.message);
                            // fetchstudent();
                            location.reload();
                        }
                    }
                });
            });


            // for update
            $(document).on('click', '.update_appointments', function(e) {
                e.preventDefault();

                $(this).text('Updating..');
                var id = $('#appointment_id').val();
                // alert(id);

                var data = {
                    'patient_name_id': $('#patient_name_id').val(),
                    'doctor_dept_id': $('#doctor_dept_id').val(),
                    'doctor_name_id': $('#doctor_name_id').val(),
                    'appointment_date_id': $('#appointment_date_id').val(),
                    'description_id': $('#description_id').val(),
                    'title_id': $('#title_id').val(),
                }

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type: "PUT",
                    url: "/Appointment/update/" + id,
                    data: data,
                    dataType: "json",
                    success: function(response) {
                        // console.log(response);
                        if (response.status == 400) {
                            $('#error_patienttt').text(response.errors.patient_name_id);
                            $('#error_doc_depttt').text(response.errors.doctor_dept_id);
                            $('#error_doc_nameee').text(response.errors.doctor_name_id);
                            $('#error_dateee').text(response.errors.appointment_date_id);
                            $('#error_descriptionnn').text(response.errors.description_id);
                            $('#error_titleee').text(response.errors.title_id);
                            $('.update_appointments').text('Update');
                        } else {
                            $('#editModal').find('input').val('');
                            $('.update_appointments').text('Update');
                            $('#editModal').modal('hide');
                            toastr.success(response.message);
                            // fetchstudent();
                            location.reload();
                        }
                    }
                });

            });

        });
    </script>
    {{-- for add and validation --}}

@endsection
