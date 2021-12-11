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

        .circle {
            height: 100px;
            width: 100px;
            display: block;
            border: 1px solid black;
            border-radius: 100px;
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

                        <h4 class="card-title text-center">Medicine List
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-success" data-bs-toggle="modal"
                                data-bs-target="#AddmedicineList">
                                Medicine List
                            </button>
                        </h4>

                        <!-- AddModal -->
                        <div class="modal fade bd-example-modal-lg" id="AddmedicineList" tabindex="-1"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Add Medicine List</h5>
                                        <button style="-moz-user-focus{outline:none}; " type="button" class="btn-close"
                                            data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Manufacture Name</label>
                                                        <select name="manufacture_id" class="manufacture_id form-control">
                                                            <option value="" selected="" disabled="">Select Manufacture Name
                                                            </option>
                                                            @foreach ($medicine_manufacture as $medicine_manufactur)
                                                                <option value="{{ $medicine_manufactur->id }}">
                                                                    {{ $medicine_manufactur->name }}</option>
                                                            @endforeach
                                                        </select>
                                                        <span id="error_manufacture_id" class="errorColor"></span>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Medicine Category</label>
                                                        <select name="category_id" class="category_id form-control">
                                                            <option value="" selected="" disabled="">Select Category Name
                                                            </option>
                                                            @foreach ($medicine_cat as $medicine_catt)
                                                                <option value="{{ $medicine_catt->id }}">
                                                                    {{ $medicine_catt->name }}</option>
                                                            @endforeach
                                                        </select>
                                                        <span id="error_category_id" class="errorColor"></span>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Medicine Type</label>
                                                        <select name="type_id" class="type_id form-control">
                                                            <option value="" selected="" disabled="">Select Medicine Type
                                                            </option>
                                                            @foreach ($medicine_type as $medicine_typee)
                                                                <option value="{{ $medicine_typee->id }}">
                                                                    {{ $medicine_typee->name }}</option>
                                                            @endforeach
                                                        </select>
                                                        <span id="error_type_id" class="errorColor"></span>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Medicine Name</label>
                                                        <input type="text" class="name form-control"
                                                            placeholder="Enter medicine name" name="name">
                                                        <span id="error_name" class="errorColor"></span>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Quantity</label>
                                                        <input type="text" class="quantity form-control"
                                                            placeholder="Enter " name="quantity">
                                                        <span id="error_quantity" class="errorColor"></span>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Price</label>
                                                        <input type="text" class="price form-control"
                                                            placeholder="Enter price" name="price">
                                                        <span id="error_price" class="errorColor"></span>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Image</label>
                                                        <input type="file" class="image form-control" name="image">
                                                        <span id="error_image" class="errorColor"></span>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Expire Date</label>
                                                        <input type="date" class="expire_date form-control"
                                                            placeholder="Enter medicine name" name="expire_date">
                                                        <span id="error_expire_date" class="errorColor"></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Close</button>
                                            <input type="submit" class="btn btn-rounded btn-info add_medicine_list"
                                                value="Add Medicine List">
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        {{-- modal end --}}
                        <!-- Edit Modal -->
                        <div class="modal fade bd-example-modal-lg" id="editModal" tabindex="-1"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Edit Blood Donation</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>

                                    <form action="{{ route('update.medicinelist') }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf

                                        <input type="hidden" id="medicinelist_id" name="medicinelist_id">

                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Manufacture Name</label>
                                                        <select name="manufacture_id" class="form-control"
                                                            id="manufacture_id">
                                                            <option value="" selected="" disabled="">Select Manufacture Name
                                                            </option>
                                                            @foreach ($medicine_manufacture as $medicine_manufactur)
                                                                <option value="{{ $medicine_manufactur->id }}">
                                                                    {{ $medicine_manufactur->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Medicine Category</label>
                                                        <select name="category_id" class="form-control" id="category_id">
                                                            <option value="" selected="" disabled="">Select Category Name
                                                            </option>
                                                            @foreach ($medicine_cat as $medicine_catt)
                                                                <option value="{{ $medicine_catt->id }}">
                                                                    {{ $medicine_catt->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Medicine Type</label>
                                                        <select name="type_id" class="form-control" id="type_id">
                                                            <option value="" selected="" disabled="">Select Medicine Type
                                                            </option>
                                                            @foreach ($medicine_type as $medicine_typee)
                                                                <option value="{{ $medicine_typee->id }}">
                                                                    {{ $medicine_typee->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Medicine Name</label>
                                                        <input type="text" class="form-control"
                                                            placeholder="Enter medicine name" name="name" id="name">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Quantity</label>
                                                        <input type="number" class="form-control" placeholder="Enter "
                                                            name="quantity" id="quantity">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Price</label>
                                                        <input type="text" class="form-control" placeholder="Enter price"
                                                            name="price" id="price">
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label>Details</label>
                                                        <textarea name="description" placeholder="Enter details"
                                                            id="description"></textarea>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Image</label>
                                                        <input type="file" class="form-control" name="image" id="image">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Expire Date</label>
                                                        <input type="date" class="form-control"
                                                            placeholder="Enter medicine name" name="expire_date"
                                                            id="expire_date">
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-rounded btn-info">update</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        {{-- Edit  modal end --}}

                        <div id="datatable-buttons_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                            <div class="row">
                                <div class="col-sm-12">
                                    <table id="datatable-buttons"
                                        class="table table-striped table-bordered dt-responsive nowrap dataTable no-footer dtr-inline text-center align-middle"
                                        style="border-collapse: collapse; border-spacing: 0px; width: 100%;" role="grid"
                                        aria-describedby="datatable-buttons_info">
                                        <thead>
                                            <tr role="row">

                                                <th class="sorting_asc" tabindex="0" aria-controls="datatable-buttons"
                                                    rowspan="1" colspan="1" style="width: 120px;" aria-sort="ascending"
                                                    aria-label="Name: activate to sort column descending">Image</th>

                                                <th class="sorting" tabindex="0" aria-controls="datatable-buttons"
                                                    rowspan="1" colspan="1" style="width: 89px;"
                                                    aria-label="Salary: activate to sort column ascending">Medicine Name
                                                </th>
                                                <th class="sorting" tabindex="0" aria-controls="datatable-buttons"
                                                    rowspan="1" colspan="1" style="width: 89px;"
                                                    aria-label="Salary: activate to sort column ascending">Manufacture</th>
                                                <th class="sorting" tabindex="0" aria-controls="datatable-buttons"
                                                    rowspan="1" colspan="1" style="width: 89px;"
                                                    aria-label="Salary: activate to sort column ascending">Category</th>
                                                <th class="sorting" tabindex="0" aria-controls="datatable-buttons"
                                                    rowspan="1" colspan="1" style="width: 89px;"
                                                    aria-label="Salary: activate to sort column ascending">Medicine Types
                                                </th>
                                                <th class="sorting" tabindex="0" aria-controls="datatable-buttons"
                                                    rowspan="1" colspan="1" style="width: 89px;"
                                                    aria-label="Salary: activate to sort column ascending">Details</th>

                                                <th class="sorting" tabindex="0" aria-controls="datatable-buttons"
                                                    rowspan="1" colspan="1" style="width: 89px;"
                                                    aria-label="Salary: activate to sort column ascending">Action</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            @foreach ($medicinelsts as $medicinelistt)
                                                <tr>
                                                    <td class="dtr-control sorting_1" tabindex="0">
                                                        <img src="{{ asset($medicinelistt->image) }} "
                                                            class="rounded avatar-lg" height="80px;" width="80px;">
                                                    </td>
                                                    <td>{{ $medicinelistt->name }}</td>
                                                    <td>
                                                        {{ $medicinelistt['MedicineManufacture']['name'] }} </td>
                                                    <td class="dtr-control sorting_1" tabindex="0">
                                                        {{ $medicinelistt['Medicinecategory']['name'] }} </td>
                                                    <td class="dtr-control sorting_1" tabindex="0">
                                                        {{ $medicinelistt['Medicinetype']['name'] }} </td>
                                                    <td class="text-start">
                                                        <b>Price:</b> {{ $medicinelistt->price }} <br>
                                                        <b>Quantity:</b>{{ $medicinelistt->quantity }} <br>
                                                        <b>Expire_date:</b>{{ $medicinelistt->expire_date }} <br>
                                                        <b>Description:</b>{{ $medicinelistt->description }}
                                                    </td>
                                                    <td>
                                                        <button type="button" value="{{ $medicinelistt->id }}"
                                                            class="btn btn-success editBtn btn-sm">
                                                            <i class="fa fa-pencil-alt"></i></button>

                                                        <a href="{{ route('delete.medicinelist', $medicinelistt->id) }}"
                                                            class="btn btn-danger btn-sm" id="delete"><i
                                                                class="fa fa-trash"></i></a>
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

            // for adding data using ajax
            $(document).on('click', '.add_medicine_list', function(e) {

                e.preventDefault();
                $(this).text('Sending..');

                var data = {
                    'manufacture_id': $('.manufacture_id').val(),
                    'category_id': $('.category_id').val(),
                    'type_id': $('.type_id').val(),
                    'name': $('.name').val(),
                    'quantity': $('.quantity').val(),
                    'price': $('.price').val(),
                    'image': $('.image').val(),
                    'expire_date': $('.expire_date').val(),
                }

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type: "POST",
                    url: "/Medicine/list/store",
                    data: data,
                    dataType: "json",
                    async: true,
                    success: function(response) {
                        if (response.status == 400) {
                            $('#error_manufacture_id').text(response.errors.manufacture_id);
                            $('#error_category_id').text(response.errors.category_id);
                            $('#error_type_id').text(response.errors.type_id);
                            $('#error_name').text(response.errors.name);
                            $('#error_quantity').text(response.errors.quantity);
                            $('#error_price').text(response.errors.price);
                            $('#error_image').text(response.errors.image);
                            $('#error_expire_date').text(response.errors.expire_date);
                            $('.add_medicine_list').text('Save');
                        } else {
                            $('#AddmedicineList').find('input').val('');
                            $('.add_medicine_list').text('Save');
                            $('#AddmedicineList').modal('hide');
                            location.reload();
                            toastr.success(response.message);
                        }
                    }
                });
            });

            // for editing data using ajax
            $(document).on('click', '.editBtn', function() {
                var medicinelist_id = $(this).val();
                $('#editModal').modal('show');
                $.ajax({
                    type: "GET",
                    url: "/Medicine/list/edit/" + medicinelist_id,
                    success: function(response) {
                        $('#medicinelist_id').val(response.medicinelist.id);
                        $('#manufacture_id').val(response.medicinelist.manufacture_id);
                        $('#category_id').val(response.medicinelist.category_id);
                        $('#type_id').val(response.medicinelist.type_id);
                        $('#name').val(response.medicinelist.name);
                        $('#quantity').val(response.medicinelist.quantity);
                        $('#price').val(response.medicinelist.price);
                        $('#expire_date').val(response.medicinelist.expire_date);
                        $('#image').val(response.medicinelist.image);
                        $('#description').val(response.medicinelist.description);
                    }
                })
            });

        });
    </script>
@endsection
