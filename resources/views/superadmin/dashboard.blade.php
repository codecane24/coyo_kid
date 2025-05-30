<?php $page = 'index'; ?>
@extends('layout.mainlayout')
@section('content')
	<!-- Page Wrapper -->
    <div class="page-wrapper">
        <div class="content">

            <!-- Page Header -->
            <div class="d-md-flex d-block align-items-center justify-content-between mb-3">
                <div class="my-auto mb-2">
                    <h3 class="page-title mb-1">Super Admin Dashboard</h3>
                     <nav>
                           <ol class="breadcrumb mb-0">
                              <li class="breadcrumb-item">
                                <a href="javascript:void(0);">Dashboard</a>
                              </li>
                              <li class="breadcrumb-item active" aria-current="page">Super Admin Dashboard</li>
                        </ol>
                      </nav>
                </div>
                <div class="d-flex my-xl-auto right-content align-items-center flex-wrap">
                    <div class="mb-2">
                        <a href="{{url('add-student')}}" class="btn btn-primary d-flex align-items-center me-3"><i
                            class="ti ti-square-rounded-plus me-2"></i>Add New Student</a>
                      </div>
                      <div class="mb-2">
                        <a href="{{url('collect-fees')}}" class="btn btn-light d-flex align-items-center">Fees Details</a>
                      </div>
                </div>
            </div>
            <!-- /Page Header -->

            <div class="row">
                <div class="col-md-12">
                    {{-- <div class="alert-message">
                        <div class="alert alert-success rounded-pill d-flex align-items-center justify-content-between border-success mb-4" role="alert">
                            <div class="d-flex align-items-center">
                                <span class="me-1 avatar avatar-sm flex-shrink-0"><img src="{{URL::asset('build/img/profiles/avatar-27.jpg')}}" alt="" class="img-fluid rounded-circle"></span>
                                <p>Fahed III,C has paid Fees for the <strong class="mx-1">“Term1”</strong></p>
                            </div>
                            <button type="button" class="btn-close p-0" data-bs-dismiss="alert" aria-label="Close"><span><i class="ti ti-x"></i></span></button>
                        </div>
                    </div> --}}

                    <!-- Dashboard Content -->
                    <div class="card bg-dark">
                        <div class="overlay-img">
                            <img src="{{URL::asset('build/img/bg/shape-04.png')}}" alt="img" class="img-fluid shape-01">
                            <img src="{{URL::asset('build/img/bg/shape-01.png')}}" alt="img" class="img-fluid shape-02">
                            <img src="{{URL::asset('build/img/bg/shape-02.png')}}" alt="img" class="img-fluid shape-03">
                            <img src="{{URL::asset('build/img/bg/shape-03.png')}}" alt="img" class="img-fluid shape-04">
                        </div>
                        <div class="card-body">
                            <div class="d-flex align-items-xl-center justify-content-xl-between flex-xl-row flex-column">
                                <div class="mb-3 mb-xl-0">
                                    <div class="d-flex align-items-center flex-wrap mb-2">
                                        <h1 class="text-white me-2">Welcome Back, {{ Auth::user()->name }}</h1>
                                        <a href="{{url('profile')}}" class="avatar avatar-sm img-rounded bg-gray-800 dark-hover"><i class="ti ti-edit text-white"></i></a>
                                    </div>
                                    <p class="text-white">Have a Good day at work</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /Dashboard Content -->

                </div>
            </div>

            <div class="row">

                <!-- Total Students -->
                <div class="col-xxl-3 col-sm-6 d-flex">
                    <div class="card flex-fill animate-card border-0">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="avatar avatar-xl bg-danger-transparent me-2 p-1">
                                    <img src="{{URL::asset('build/img/icons/student.svg')}}" alt="img">
                                </div>
                                <div class="overflow-hidden flex-fill">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <h2 class="counter">3654</h2>
                                        <span class="badge bg-danger">1.2%</span>
                                    </div>
                                    <p>Total Students</p>
                                </div>
                            </div>
                            <div class="d-flex align-items-center justify-content-between border-top mt-3 pt-3">
                                <p class="mb-0">Active : <span class="text-dark fw-semibold">3643</span></p>
                                <span class="text-light">|</span>
                                <p>Inactive : <span class="text-dark fw-semibold">11</span></p>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /Total Students -->

                <!-- Total Teachers -->
                <div class="col-xxl-3 col-sm-6 d-flex">
                    <div class="card flex-fill animate-card border-0">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="avatar avatar-xl me-2 bg-secondary-transparent p-1">
                                    <img src="{{URL::asset('build/img/icons/teacher.svg')}}" alt="img">
                                </div>
                                <div class="overflow-hidden flex-fill">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <h2 class="counter">284</h2>
                                        <span class="badge bg-pending">1.2%</span>
                                    </div>
                                    <p class="text-gray">Total Teachers</p>
                                </div>
                            </div>
                            <div class="d-flex align-items-center justify-content-between border-top mt-3 pt-3">
                                <p class="mb-0">Active : <span class="text-dark fw-semibold">254</span></p>
                                <span class="text-light">|</span>
                                <p>Inactive : <span class="text-dark fw-semibold">30</span></p>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /Total Teachers -->

                <!-- Total Staff -->
                <div class="col-xxl-3 col-sm-6 d-flex">
                    <div class="card flex-fill animate-card border-0">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="avatar avatar-xl me-2 bg-warning-transparent p-1">
                                    <img src="{{URL::asset('build/img/icons/staff.svg')}}" alt="img">
                                </div>
                                <div class="overflow-hidden flex-fill">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <h2 class="counter">162</h2>
                                        <span class="badge bg-warning">1.2%</span>
                                    </div>
                                    <p class="text-gray">Total Staff</p>
                                </div>
                            </div>
                            <div class="d-flex align-items-center justify-content-between border-top mt-3 pt-3">
                                <p class="mb-0">Active : <span class="text-dark fw-semibold">161</span></p>
                                <span class="text-light">|</span>
                                <p>Inactive : <span class="text-dark fw-semibold">02</span></p>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /Total Staff -->

                <!-- Total Subjects -->
                <div class="col-xxl-3 col-sm-6 d-flex">
                    <div class="card flex-fill animate-card border-0">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="avatar avatar-xl me-2 bg-success-transparent p-1">
                                    <img src="{{URL::asset('build/img/icons/subject.svg')}}" alt="img">
                                </div>
                                <div class="overflow-hidden flex-fill">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <h2 class="counter">82</h2>
                                        <span class="badge bg-success">1.2%</span>
                                    </div>
                                    <p class="text-gray">Total Subjects</p>
                                </div>
                            </div>
                            <div class="d-flex align-items-center justify-content-between border-top mt-3 pt-3">
                                <p class="mb-0">Active : <span class="text-dark fw-semibold">81</span></p>
                                <span class="text-light">|</span>
                                <p>Inactive : <span class="text-dark fw-semibold">01</span></p>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /Total Subjects -->

            </div>

            </div>
        </div>

    </div>
    <!-- /Page Wrapper -->
    @component('components.modal-popup')
    @endcomponent
@endsection
