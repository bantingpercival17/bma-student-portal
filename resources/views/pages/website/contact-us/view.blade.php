@extends('layouts.website-template')
@php
$_title = 'Contact Us - Baliwag Maritime Academy';
@endphp
@section('page-title', $_title)
@section('page-content')
    <h2 class="text-primary text-center home-title">CONTACT US</h2>
    <div class="row mt-5">
        <div class="col-8">
            <div class="card">
                <div class="card-body">
                    <h4 class="fw-bolder">CREATE REPORT TICKET</h4>
                    <div class="contact-form mt-3">
                        @if (Session::get('error-message'))
                            <div class="alert alert-danger">
                                <label for="">{{ Session::get('error-message') }}</label>
                            </div>
                        @endif
                        <form action="/application-form" method="POST">
                            <div class="row">
                                <div class="form-group col-md">
                                    <label for="" class="form-label"></label>
                                    <input type="text" class="form-control" name="first_name" placeholder="First Name"
                                        value="{{ old('first_name') }}">
                                    @error('first_name')
                                        <span class="badge bg-danger"> <strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                                <div class="form-group col-md">
                                    <input type="text" class="form-control" name="last_name" placeholder="Last Name"
                                        value="{{ old('last_name') }}">
                                    @error('last_name')
                                        <span class="badge bg-danger"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-8">
                                    <input type="email" name="email" id="" class="form-control"
                                        placeholder="Google Email Address" value="{{ old('email') }}">
                                    @error('email')
                                        <span class="badge bg-danger"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                                <div class="form-group col-4">
                                    <input type="text" class="form-control" name="contact_number"
                                        placeholder="Contact Number" value="{{ old('contact_number') }}">
                                    @error('contact_number')
                                        <span class="badge bg-danger"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group">
                                <select name="_course" id="" class="form-select" value="{{ old('_course') }}">
                                    <option value="" disable>Select Course / Strand</option>
                                    <option value="1">BS MARINE ENGINEERING - COLLEGE</option>
                                    <option value="2">BS MARINE TRANSPORTATION - COLLEGE</option>
                                    <option value="3">PRE-BACCALAUREATE - SENIOR HIGHSCHOOL</option>
                                </select>
                                @error('_course')
                                    <span class="badge bg-danger"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <textarea name="" id="" cols="30" rows="10" class="form-control" placeholder="Write your concern...."></textarea>
                                @error('agreement')
                                    <span class="badge bg-danger"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary btn-rounded">APPLY NOW</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-4">
            <div class="card">
                <div class="card-header">
                    <span>SIGN IN TICKER NUMBER</span>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Ticket Number">
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
