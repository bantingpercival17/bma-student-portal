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
                    <h4 class="fw-bolder">CREATE TICKET</h4>
                    <div class="contact-form mt-3">
                        <form action="{{ route('website.contact-us-store') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="form-group col-md">
                                    <label for="" class="form-label fw-bolder">NAME</label>
                                    <input type="text" class="form-control" name="full_name" placeholder="Full name"
                                        value="{{ old('full_name') }}">
                                    @error('full_name')
                                        <span class="badge bg-danger"> <strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                                <div class="form-group col-md">
                                    <label for="" class="form-label fw-bolder">EMAIL</label>
                                    <input type="email" name="email" id="" class="form-control"
                                        placeholder="Google Email Address" value="{{ old('email') }}">
                                    @error('email')
                                        <span class="badge bg-danger"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-8">
                                    <label for="" class="form-label fw-bolder">ADDRESS</label>
                                    <input type="text" name="address" id="" class="form-control" placeholder="Address"
                                        value="{{ old('address') }}">
                                    @error('address')
                                        <span class="badge bg-danger"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                                <div class="form-group col-4">
                                    <label for="" class="form-label fw-bolder">CONTACT NUMBER</label>
                                    <input type="text" class="form-control" name="contact_number"
                                        placeholder="Contact Number" value="{{ old('contact_number') }}">
                                    @error('contact_number')
                                        <span class="badge bg-danger"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="" class="form-label fw-bolder">CONCERN ISSUE</label>
                                <select name="concern" class="form-select">
                                    <option value="" selected disabled>Select Concern</option>
                                    @if ($_concern)
                                        @foreach ($_concern as $item)
                                            <option value="{{ $item->id }}"
                                                {{ old('concern') == $item->id ? 'selected' : '' }}>
                                                {{ $item->issue_name }}</option>
                                        @endforeach

                                    @endif
                                </select>
                                @error('concern')
                                    <span class="badge bg-danger"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <textarea name="concern_message" id="" cols="30" rows="10" class="form-control"
                                    placeholder="Write your concern...."></textarea>
                                @error('concern_message')
                                    <span class="badge bg-danger"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary btn-rounded">SUBMIT</button>
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
                    <form action="{{ route('ticket-login') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <input type="text" class="form-control" name="ticket" placeholder="Ticket Number">
                            @error('ticket')
                                <span class="mt-2 badge bg-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>


@endsection
