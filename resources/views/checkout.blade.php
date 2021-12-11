@extends('layouts.admin_master')


@section('super-admin-content')


<div class="" style="margin:20rem;">
  <select id='selUser' style='width: 200px;'>
    <option value='0'>Select User</option>
    <option value='1'>Yogesh singh</option>
    <option value='2'>Sonarika Bhadoria</option>
    <option value='3'>Anil Singh</option>
    <option value='4'>Vishal Sahu</option>
    <option value='5'>Mayank Patidar</option>
    <option value='6'>Vijay Mourya</option>
    <option value='7'>Rakesh sahu</option>
  </select>

<br/>
<div id='result'></div>
</div>
    
 @endsection

@section('super-admin-content')
    <style>
        .mail {
            color: #abb0ac;
        }

        .total {
            border: 2px dotted #ededed;
            width: 180px;
            padding: 20px 20px 20px 20px;

        }

        .total h6 {
            color: #abb0ac;
        }

        h6 .ta {
            font-size: 5px;
        }

        .padding-0 {
            padding-right: 0;
            padding-left: 0;
        }

        .overview ul li {
            list-style: none;
            font-size: 15px;
            color: #8d8d91;
        }

        .overview1 ul li {
            list-style: none;
            font-size: 15px;

        }

        .card {
            margin: 0 auto;
            float: none;
            margin-bottom: 10px;
        }

        .namebadge .badg {
            color: #326e2c;
            background-color: #e8fff3;
            font-size: 12px;
        }

    </style>

    <div class="container-full topBar">
        <div class="row">
            <div class="col-12 overall">
                <div class="card" style="width: 1000px;">
                    <div class="card-body" style="align-items: center;">
                        <div class="conatiner">
                            <div class="row">
                            </div>
                            <div class="row">
                                <div class="col-md-2">
                                    <img src="uploads/accountant/1.jpg" class="rounded avatar-lg" alt=""
                                        style="width: 150px; height:195px;">
                                </div>
                                <div class="col-md-10">
                                    <div class="namebadge">
                                        {{-- <span class="badge badge-success">Success</span> --}}
                                        <h3><b>Channing Mcmillan</b> <span class="badge  badg">Available</span></h3>
                                    </div>
                                    <div class="mail">
                                        <i class="fas fa-envelope"></i>&nbsp;<span>qycuxu@mailinator.com</span>&nbsp;<i
                                            class="fas fa-map-marker-alt"></i>&nbsp;<span>Lorem ipsum dolor sit amet
                                            consectetur Lorem ipsum dolor sit amet</span>
                                    </div>
                                    <br>
                                    <div class="row no-gutters">
                                        <div class="col-md-4 ">
                                            <div class="total">
                                                <i class="fas fa-2x fa-notes-medical"></i>&nbsp; &nbsp;<span><b>3</b></span>
                                                <h6><b>Total Classes</b></h6>
                                            </div>
                                        </div>
                                        <div class="col-md-4 ">
                                            <div class="total">
                                                <i class="fas fa-2x fa-notes-medical" style="color: yellow;"></i>&nbsp;
                                                &nbsp;<span><b>3</b></span>
                                                <h6><b>Patients</b></h6>
                                            </div>
                                        </div>
                                        <div class="col-md-4 ">
                                            <div class="total">
                                                <i class="fas fa-2x fa-notes-medical" style="color: #7d2877;"></i>&nbsp;
                                                &nbsp;<span><b>3</b></span>
                                                <h6 class="ta"><b>Total Appointments</b></h6>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <br>

                                </div>

                                <nav>
                                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                        <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab"
                                            data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home"
                                            aria-selected="true">Overview</button>

                                        <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab"
                                            data-bs-target="#nav-profile" type="button" role="tab"
                                            aria-controls="nav-profile" aria-selected="false">Cases</button>
                                        <button class="nav-link" id="nav-contact-tab" data-bs-toggle="tab"
                                            data-bs-target="#nav-contact" type="button" role="tab"
                                            aria-controls="nav-contact" aria-selected="false">Patients</button>
                                        <button class="nav-link" id="nav-contact-tab" data-bs-toggle="tab"
                                            data-bs-target="#nav-contact" type="button" role="tab"
                                            aria-controls="nav-contact" aria-selected="false">Appointments</button>
                                        <button class="nav-link" id="nav-contact-tab" data-bs-toggle="tab"
                                            data-bs-target="#nav-contact" type="button" role="tab"
                                            aria-controls="nav-contact" aria-selected="false">schedules</button>
                                        <button class="nav-link" id="nav-contact-tab" data-bs-toggle="tab"
                                            data-bs-target="#nav-contact" type="button" role="tab"
                                            aria-controls="nav-contact" aria-selected="false">My Payrolls</button>
                                    </div>
                                </nav>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="card" style="width: 1000px;">
                    <div class="card-body">
                        <div class="tab-content" id="nav-tabContent">
                            <div class="tab-pane fade show active" id="nav-home" role="tabpanel"
                                aria-labelledby="nav-home-tab">
                                <h5 style="margin-left:30px;"><b>Over View</b></h5>

                                <hr>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="overview">
                                            <ul>
                                                <li>
                                                    <b>Designation</b>
                                                </li>
                                                <br>
                                                <li>
                                                    <b> Phone</b>
                                                </li>
                                                <br>
                                                <li>
                                                    <b>Doctor Department</b>
                                                </li>
                                                <br>
                                                <li>
                                                    <b>Qualification</b>
                                                </li>
                                                <br>
                                                <li>
                                                    <b> Blood Group</b>
                                                </li>
                                                <br>
                                                <li>
                                                    <b> Date Of Birth</b>
                                                </li>
                                                <br>
                                                <li>
                                                    <b>Specialist<< /b>
                                                </li>
                                                <br>
                                                <li>
                                                    <b> Gender</b>
                                                </li>
                                                <br>
                                                <li>
                                                    <b> Created on</b>
                                                </li>
                                                <br>
                                                <li>
                                                    <b>Last Updated</b>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="overview1">
                                            <ul>
                                                <li>
                                                    <b>Designation</b>
                                                </li>
                                                <br>
                                                <li>
                                                    <b> Phone</b>
                                                </li>
                                                <br>
                                                <li>
                                                    <b>Doctor Department</b>
                                                </li>
                                                <br>
                                                <li>
                                                    <b>Qualification</b>
                                                </li>
                                                <br>
                                                <li>
                                                    <b> Blood Group</b>
                                                </li>
                                                <br>
                                                <li>
                                                    <b> Date Of Birth</b>
                                                </li>
                                                <br>
                                                <li>
                                                    <b>Specialist</b>
                                                </li>
                                                <br>
                                                <li>
                                                    <b> Gender</b>
                                                </li>
                                                <br>
                                                <li>
                                                    <b> Created on</b>
                                                </li>
                                                <br>
                                                <li>
                                                    <b>Last Updated</b>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                            </div>
                            <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quae tenetur odit mollitia?</div>
                            <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
                                Lorem ipsum, dolor sit amet consectetur adipisicing elit. Consectetur delectus laboriosam
                                voluptatem.</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection

