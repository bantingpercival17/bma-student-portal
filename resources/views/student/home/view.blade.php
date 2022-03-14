@extends('app-main')
@php
$_title = 'Home';
@endphp
@section('page-title', $_title)
@section('content-title', $_title)
@section('beardcrumb-content')
    <li class="breadcrumb-item active" aria-current="page">
        <svg width="14" height="14" class="me-2" viewBox="0 0 22 22" fill="none"
            xmlns="http://www.w3.org/2000/svg">
            <path
                d="M8.15722 19.7714V16.7047C8.1572 15.9246 8.79312 15.2908 9.58101 15.2856H12.4671C13.2587 15.2856 13.9005 15.9209 13.9005 16.7047V16.7047V19.7809C13.9003 20.4432 14.4343 20.9845 15.103 21H17.0271C18.9451 21 20.5 19.4607 20.5 17.5618V17.5618V8.83784C20.4898 8.09083 20.1355 7.38935 19.538 6.93303L12.9577 1.6853C11.8049 0.771566 10.1662 0.771566 9.01342 1.6853L2.46203 6.94256C1.86226 7.39702 1.50739 8.09967 1.5 8.84736V17.5618C1.5 19.4607 3.05488 21 4.97291 21H6.89696C7.58235 21 8.13797 20.4499 8.13797 19.7714V19.7714"
                stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
        </svg>Home
    </li>
@endsection
@section('page-content')


    <div class="card mb-0 iq-content rounded-bottom">
        <div class="d-flex flex-wrap align-items-center justify-content-between mx-3 my-3">
            <div class="d-flex flex-wrap align-items-center">
                <div class="profile-img position-relative me-3 mb-3 mb-lg-0">
                    <img src="{{ asset(Auth::user()->student->profile_pic(Auth::user())) }}" alt="User-Profile"
                        class="img-fluid avatar avatar-90 rounded-circle">
                </div>
                <div class="d-flex align-items-center mb-3 mb-sm-0">
                    <div>
                        <h4 class="me-2 text-primary">
                            {{ Auth::user()->student->last_name . ', ' . Auth::user()->student->first_name }}</h4>
                        <span><svg width="19" height="19" class="me-2" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M21 10.8421C21 16.9172 12 23 12 23C12 23 3 16.9172 3 10.8421C3 4.76697 7.02944 1 12 1C16.9706 1 21 4.76697 21 10.8421Z"
                                    stroke="#07143B" stroke-width="1.5" />
                                <circle cx="12" cy="9" r="3" stroke="#07143B" stroke-width="1.5" />
                            </svg><small
                                class="mb-0 text-dark">{{ ucwords(Auth::user()->student->municipality . ', ' . Auth::user()->student->province) }}</small></span>
                    </div>
                    {{-- <div class="ms-4">
                        <p class="mb-0 text-dark">UI/UX Designer</p>
                        <p class="me-2 mb-0 text-dark">Email - Hello@gmail.com</p>
                    </div> --}}
                </div>
            </div>
            <ul class="d-flex mb-0 text-center ">
                {{-- <li class="badge bg-primary py-2 me-2">
                    <p class="mb-2 mt-1">142</p>
                    <small class="mb-1 fw-normal">Reviews</small>
                </li>
                <li class="badge bg-primary py-2 me-2">
                    <p class="mb-2 mt-1">201</p>
                    <small class="mb-1 fw-normal">Photos</small>
                </li> --}}
                @php
                    $_enrollment = Auth::user()->student->enrollment_assessment;
                    if ($_enrollment->course_id == 3) {
                        $_layout = asset('/assets/files/ADDENDUM-TO-THE-PROVISIONS-OF-SENIOR-HIGH-SCHOOL-HANDBOOK2020.QMR.pdf');
                    } else {
                        $_layout = asset('/assets/files/ADDENDUM-TO-THE-PROVISIONS-OF-SENIOR-HIGH-SCHOOL-HANDBOOK2020.QMR.pdf');
                    }
                @endphp
                <li class="badge bg-primary py-2 me-2 btn-form-document" data-bs-toggle="modal"
                    data-bs-target=".document-view-modal" data-document-url="{{ $_layout }}">
                    <p class="mb-2 mt-1">SCHOOL </p>
                    <small class="mb-1 fw-normal">HANDBOOK</small>
                </li>
            </ul>
        </div>
    </div>

    <div class="col-12 mt-4">
        <div class="card">
            <div class="card-header pb-0 p-3">
                <div class="header-title">
                    <div class="row">
                        <div class="col-md">
                            <h5 class="mb-1"><b>PROFILE INFORMATION</b></h5>
                            <p class="text-sm">Student Information of the cadet's/ student's at Baliwag Maritime
                                Academy</p>
                        </div>
                        <div class="col-md-3">
                            <a href="{{ route('update-profile') }}" class="btn btn-primary btn-sm">Update Student
                                Information</a>
                        </div>
                    </div>

                </div>

            </div>
            <div class="card-body p-3">

                <div class="form-view">
                    <h6 class="mb-1"><b>FULL NAME</b></h6>
                    <div class="row">
                        <div class="col-xl col-md-6 ">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label">Last name</label>
                                <span class="form-control">{{ ucwords(Auth::user()->student->last_name) }}</span>
                            </div>
                        </div>
                        <div class="col-xl col-md-6 ">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label">First name</label>
                                <span class="form-control">{{ ucwords(Auth::user()->student->first_name) }}</span>
                            </div>
                        </div>
                        <div class="col-xl col-md-6 ">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label">Middle name</label>
                                <span class="form-control">{{ ucwords(Auth::user()->student->middle_name) }}</span>
                            </div>
                        </div>
                        <div class="col-xl-2 col-md-6 ">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label">Extension</label>
                                <span
                                    class="form-control">{{ Auth::user()->student->extention_name ? ucwords(Auth::user()->student->extention_name) : 'none' }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-2 col-md-6 mb-xl-0">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label">Gender</label>
                                <span class="form-control">{{ ucwords(Auth::user()->student->sex) }}</span>
                            </div>
                        </div>
                        <div class="col-xl-2 col-md-6 mb-xl-0">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label">Birthday</label>
                                <span class="form-control">{{ Auth::user()->student->birthday }}</span>
                            </div>
                        </div>
                        <div class="col-xl-4 col-md-6 mb-xl-0">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label">Birth Place</label>
                                <span class="form-control">{{ ucwords(Auth::user()->student->birth_place) }}</span>
                            </div>
                        </div>
                        <div class="col-xl-2 col-md-6 mb-xl-0">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label">Civil Status</label>
                                <span class="form-control">{{ ucwords(Auth::user()->student->civil_status) }}</span>
                            </div>
                        </div>
                        <div class="col-xl-2 col-md-6 mb-xl-0">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label">Nationality</label>
                                <span class="form-control">{{ Auth::user()->student->nationality }}</span>
                            </div>
                        </div>
                    </div>


                    <h6 class="mb-1"><b>ADDRESS</b></h6>
                    <div class="row">
                        <div class="col-xl-5 col-md-6 mb-xl-0">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label">Hous no / Street / Bldg
                                    no</label>
                                <span class="form-control">{{ ucwords(Auth::user()->student->street) }}</span>
                            </div>
                        </div>
                        <div class="col-xl-4 col-md-6 mb-xl-0">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label">Barangay</label>
                                <span class="form-control">{{ ucwords(Auth::user()->student->barangay) }}</span>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6 mb-xl-0">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label">Zip Code</label>
                                <span class="form-control">{{ ucwords(Auth::user()->student->zip_code) }}</span>
                            </div>
                        </div>
                        <div class="col-xl-6 col-md-6 mb-xl-0">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label">Municipality</label>
                                <span class="form-control">{{ ucwords(Auth::user()->student->municipality) }}</span>
                            </div>
                        </div>
                        <div class="col-xl-6 col-md-6 mb-xl-0">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label">Province</label>
                                <span class="form-control">{{ ucwords(Auth::user()->student->province) }}</span>
                            </div>
                        </div>
                    </div>
                    <h6 class="mb-1"><b>CONTACT DETIALS</b></h6>
                    <div class="row">
                        <div class="col-xl-6 col-md-6 mb-xl-0">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label">Contact Number</label>

                                <span class="form-control">{{ Auth::user()->student->contact_number ?: '-' }}</span>
                            </div>
                        </div>
                        <div class="col-xl-6 col-md-6 mb-xl-0">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label">Email</label>
                                <span class="form-control">{{ Auth::user()->personal_email }}</span>
                            </div>
                        </div>
                    </div>
                    <h6 class="mb-1"><b>PARENTS DETIALS</b></h6>
                    @php
                        $_parent_details = Auth::user()->student->parent_details;
                    @endphp
                    <label for="example-text-input" class="form-control-label"><b>Father Information</b></label>
                    <div class="row">
                        <div class="col-xl col-md-6 ">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label">Last name</label>
                                <span
                                    class="form-control">{{ $_parent_details ? ucwords($_parent_details->father_last_name) : '-' }}</span>
                            </div>
                        </div>
                        <div class="col-xl col-md-6 ">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label">First name</label>
                                <span
                                    class="form-control">{{ $_parent_details ? ucwords($_parent_details->father_first_name) : '-' }}</span>
                            </div>
                        </div>
                        <div class="col-xl col-md-6 ">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label">Middle name</label>
                                <span
                                    class="form-control">{{ $_parent_details ? ucwords($_parent_details->father_middle_name) : '-' }}</span>
                            </div>
                        </div>
                        <div class="col-xl-2 col-md-6 ">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label">Contact Number</label>
                                <span
                                    class="form-control">{{ $_parent_details ? ucwords($_parent_details->father_contact_number) : '-' }}</span>
                            </div>
                        </div>
                    </div>
                    <label for="example-text-input" class="form-control-label"><b>Mother Information</b></label>
                    <div class="row">
                        <div class="col-xl col-md-6 ">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label">Last name</label>
                                <span
                                    class="form-control">{{ $_parent_details ? ucwords($_parent_details->mother_last_name) : '-' }}</span>
                            </div>
                        </div>
                        <div class="col-xl col-md-6 ">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label">First name</label>
                                <span
                                    class="form-control">{{ $_parent_details ? ucwords($_parent_details->mother_first_name) : '-' }}</span>
                            </div>
                        </div>
                        <div class="col-xl col-md-6 ">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label">Middle name</label>
                                <span
                                    class="form-control">{{ $_parent_details ? ucwords($_parent_details->mother_middle_name) : '-' }}</span>
                            </div>
                        </div>
                        <div class="col-xl-2 col-md-6 ">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label">Contact Number</label>
                                <span
                                    class="form-control">{{ $_parent_details ? ucwords($_parent_details->mother_contact_number) : '-' }}</span>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>
    <div class="modal fade document-view-modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel1">SCHOOL MANUAL</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <iframe class="iframe-container form-view iframe-placeholder" src="" width="100%" height="600px">
                </iframe>
            </div>
        </div>
    </div>
@section('js')
    <script>
        $(document).on('click', '.btn-form-document', function(evt) {
            var fileExtension = ['jpeg', 'jpg', 'png', 'gif', 'bmp', 'webp'];
            var file = $(this).data('document-url');
            console.log(file)
            $('.form-view').attr('src', $(this).data('document-url'))
            //console.log(fileExtension);
            // $('.image-fr').empty()
            /* if (fileExtension.includes(file)) {
                $(".form-view").contents().find("body").html('');
                $('.form-view').contents().find('body').append($("<img/>").attr('class', 'image-frame').attr("src",
                    $(this).data('document-url')).attr("title",
                    "sometitle").attr('width', '100%'))
                console.log(file)
            } else {
                $('.form-view').attr('src', $(this).data('document-url'))
                console.log(file)
            } */

        });
    </script>
@endsection
@endsection
