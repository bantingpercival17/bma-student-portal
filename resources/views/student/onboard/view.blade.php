@extends('app')
@php
$_title = 'On Board Training';
@endphp
@section('page-title', $_title)
@section('content-title', $_title)
@section('beardcrumb-content')
    <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
        <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="/">BMA Student Portal</a>
        </li>
        <li class="breadcrumb-item text-sm text-dark active" aria-current="page">{{ $_title }}</li>
    </ol>
@endsection
@section('page-content')
    <div class="row">
        <div class="col-md-7 mt-4">
            <div class="card">
                <div class="card-header pb-0 px-3">
                    <h6 class="mb-0">Billing Information</h6>
                </div>
                <div class="card-body pt-4 p-3">
                    <ul class="list-group">
                        <li class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-100 border-radius-lg">
                            <div class="d-flex flex-column">
                                <h6 class="mb-3 text-sm">Oliver Liam</h6>
                                <span class="mb-2 text-xs">Company Name: <span
                                        class="text-dark font-weight-bold ms-sm-2">Viking Burrito</span></span>
                                <span class="mb-2 text-xs">Email Address: <span
                                        class="text-dark ms-sm-2 font-weight-bold">oliver@burrito.com</span></span>
                                <span class="text-xs">VAT Number: <span
                                        class="text-dark ms-sm-2 font-weight-bold">FRB1235476</span></span>
                            </div>
                            <div class="ms-auto text-end">
                                <a class="btn btn-link text-danger text-gradient px-3 mb-0" href="javascript:;"><i
                                        class="far fa-trash-alt me-2"></i>Delete</a>
                                <a class="btn btn-link text-dark px-3 mb-0" href="javascript:;"><i
                                        class="fas fa-pencil-alt text-dark me-2" aria-hidden="true"></i>Edit</a>
                            </div>
                        </li>
                        <li class="list-group-item border-0 d-flex p-4 mb-2 mt-3 bg-gray-100 border-radius-lg">
                            <div class="d-flex flex-column">
                                <h6 class="mb-3 text-sm">Lucas Harper</h6>
                                <span class="mb-2 text-xs">Company Name: <span
                                        class="text-dark font-weight-bold ms-sm-2">Stone Tech Zone</span></span>
                                <span class="mb-2 text-xs">Email Address: <span
                                        class="text-dark ms-sm-2 font-weight-bold">lucas@stone-tech.com</span></span>
                                <span class="text-xs">VAT Number: <span
                                        class="text-dark ms-sm-2 font-weight-bold">FRB1235476</span></span>
                            </div>
                            <div class="ms-auto text-end">
                                <a class="btn btn-link text-danger text-gradient px-3 mb-0" href="javascript:;"><i
                                        class="far fa-trash-alt me-2"></i>Delete</a>
                                <a class="btn btn-link text-dark px-3 mb-0" href="javascript:;"><i
                                        class="fas fa-pencil-alt text-dark me-2" aria-hidden="true"></i>Edit</a>
                            </div>
                        </li>
                        <li class="list-group-item border-0 d-flex p-4 mb-2 mt-3 bg-gray-100 border-radius-lg">
                            <div class="d-flex flex-column">
                                <h6 class="mb-3 text-sm">Ethan James</h6>
                                <span class="mb-2 text-xs">Company Name: <span
                                        class="text-dark font-weight-bold ms-sm-2">Fiber Notion</span></span>
                                <span class="mb-2 text-xs">Email Address: <span
                                        class="text-dark ms-sm-2 font-weight-bold">ethan@fiber.com</span></span>
                                <span class="text-xs">VAT Number: <span
                                        class="text-dark ms-sm-2 font-weight-bold">FRB1235476</span></span>
                            </div>
                            <div class="ms-auto text-end">
                                <a class="btn btn-link text-danger text-gradient px-3 mb-0" href="javascript:;"><i
                                        class="far fa-trash-alt me-2"></i>Delete</a>
                                <a class="btn btn-link text-dark px-3 mb-0" href="javascript:;"><i
                                        class="fas fa-pencil-alt text-dark me-2" aria-hidden="true"></i>Edit</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-5 mt-4">
            <div class="card h-100 mb-4">
                <div class="card-header pb-0 px-3">
                    <div class="row">
                        <div class="col-md">
                            <h6 class="mb-0">TRAINING & CERTIFICATES</h6>
                        </div>
                        
                    </div>
                </div>
                <div class="card-body pt-4 p-3">
                    <h6 class="text-uppercase text-body text-xs font-weight-bolder my-3">Yesterday</h6>
                    <ul class="list-group">
                        <li class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                            <div class="d-flex align-items-center">
                                <button
                                    class="btn btn-icon-only btn-rounded btn-outline-success mb-0 me-3 btn-sm d-flex align-items-center justify-content-center"><i
                                        class="fas fa-arrow-up"></i></button>
                                <div class="d-flex flex-column">
                                    <h6 class="mb-1 text-dark text-sm">Stripe</h6>
                                    <span class="text-xs">26 March 2020, at 13:45 PM</span>
                                </div>
                            </div>
                            <div class="d-flex align-items-center text-success text-gradient text-sm font-weight-bold">
                                + $ 750
                            </div>
                        </li>
                        <li class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                            <div class="d-flex align-items-center">
                                <button
                                    class="btn btn-icon-only btn-rounded btn-outline-success mb-0 me-3 btn-sm d-flex align-items-center justify-content-center"><i
                                        class="fas fa-arrow-up"></i></button>
                                <div class="d-flex flex-column">
                                    <h6 class="mb-1 text-dark text-sm">HubSpot</h6>
                                    <span class="text-xs">26 March 2020, at 12:30 PM</span>
                                </div>
                            </div>
                            <div class="d-flex align-items-center text-success text-gradient text-sm font-weight-bold">
                                + $ 1,000
                            </div>
                        </li>
                        <li class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                            <div class="d-flex align-items-center">
                                <button
                                    class="btn btn-icon-only btn-rounded btn-outline-success mb-0 me-3 btn-sm d-flex align-items-center justify-content-center"><i
                                        class="fas fa-arrow-up"></i></button>
                                <div class="d-flex flex-column">
                                    <h6 class="mb-1 text-dark text-sm">Creative Tim</h6>
                                    <span class="text-xs">26 March 2020, at 08:30 AM</span>
                                </div>
                            </div>
                            <div class="d-flex align-items-center text-success text-gradient text-sm font-weight-bold">
                                + $ 2,500
                            </div>
                        </li>
                        <li class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                            <div class="d-flex align-items-center">
                                <button
                                    class="btn btn-icon-only btn-rounded btn-outline-dark mb-0 me-3 btn-sm d-flex align-items-center justify-content-center"><i
                                        class="fas fa-exclamation"></i></button>
                                <div class="d-flex flex-column">
                                    <h6 class="mb-1 text-dark text-sm">Webflow</h6>
                                    <span class="text-xs">26 March 2020, at 05:00 AM</span>
                                </div>
                            </div>
                            <div class="d-flex align-items-center text-dark text-sm font-weight-bold">
                                Pending
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
