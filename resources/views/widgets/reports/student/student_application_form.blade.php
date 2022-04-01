@extends('widgets.reports.grade.report_layout_1')
@php
$_form_number = $_account->course_id == 3 ? ' RG-02' : ' RG-01';
$_department = $_account->course_id == 3 ? 'SENIOR HIGH SCHOOL' : 'COLLGE';
@endphp
@section('title-report', $_form_number . ' - STUDENT REGISTRATION : ' . strtoupper($_account->applicant->last_name . ', ' .
    $_account->applicant->first_name . ' ' . $_account->applicant->middle_name))
@section('form-code', $_form_number)
@section('content')
    <main class="content">
        <h3 class="text-center">STUDENT'S APPLICATION FORM</h3>
        <small></small>
        <h5 class="text-center">
            {{ $_department . ' - ' . $_account->course->course_name }}</h5>
        <br>
        <p class="title-header"><b>| PERSONAL INFORMATION</b></p>
        <table class="table">
            <tbody>
                <tr>
                    <td colspan="2"><small>APPLICANT NO:</small> <b>-{{ $_account->applicant->account_number }}</b> </td>
                    <td> <small>APPLICATION DATE:</small>
                        <b>{{-- {{ strtoupper(date('F j, Y', strtotime($_account->applicant->created_at))) }} --}}-</b>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <small>APPLICANT NAME: </small>
                        <b>{{ strtoupper($_account->applicant->last_name . ', ' . $_account->applicant->first_name . ' ' . $_account->applicant->middle_name) }}</b>
                    </td>
                    <td><small>BIRTH DATE:</small> <b>{{ Str::upper(date('F j, Y', strtotime($_account->applicant->birthday))) }}</b>
                    </td>
                </tr>
                <tr>

                    <td> <small>BIRTH PLACE:</small> <b>{{ Str::upper($_account->applicant->birth_place) }}</b></td>
                </tr>
                <tr>
                    <td><small>GENDER: </small><b>MALE</td>
                    <td><small>HEIGHT: </small><b> -{{ $_account->applicant->height }} Ft/In</td>
                    <td><small>WEIGHT: </small><b> -{{ $_account->applicant->weight }} Kg</td>
                </tr>
                <tr>
                    <td colspan="2"><small>RELIGION: </small><b>{{ strtoupper($_account->applicant->religion) }}</td>
                    <td><small>CITIZENSHIP:</small> <b>{{ Str::upper($_account->applicant->nationality) }}</b></td>
                </tr>
            </tbody>

        </table>
        <br>
        <p class="title-header"><b>| CONTACT DETAILS</b></p>
        <table class="table">
            <tbody>
                <tr>
                    <td colspan="3">CONTACT NUMBER: <b>{{ $_account->contact_number }}</td>
                    <td colspan="2">EMAIL ADDRESS: <b>{{ $_account->email }}</td>
                </tr>
                <tr>
                    <td colspan=""><small>ADDRESS:</small>
            <tbody>
                <tr class="text-center">
                    <td><b>{{ Str::upper($_account->applicant->street) }}</td>
                    <td><b>{{ Str::upper($_account->applicant->barangay) }}</b></td>
                    <td><b>{{ Str::upper($_account->applicant->municipality) }}</b></td>
                    <td><b>{{ Str::upper($_account->applicant->province) }}</b></td>
                </tr>
                <tr class="text-center">
                    <td> <small>STREET</small></td>
                    <td><small>BARANGAY</small></td>
                    <td><small>MUNICIPALITY / CITY</small></td>
                    <td> <small>PROVINCE</small></td>
                </tr>
            </tbody>

            </td>
            </tr>

            </tbody>
        </table>
        <br>
        <p class="title-header"><b>| PARENT'S INFOMATION</b></p>
        <table class="table">
            <tbody>
                <tr>
                    <td colspan="2">
                        <small>FATHER NAME:</small>
                        <b>{{ strtoupper($_account->applicant->father_last_name .', ' .$_account->applicant->father_first_name .' ' .$_account->applicant->father_middle_name) }}</b>
                    </td>
                    <td><small>CONTACT NUMBER:</small> <b>{{ $_account->applicant->father_contact_number }}</td>
                </tr>
                <tr>
                    <td colspan="2">
                        <small>MOTHER'S MAIDEN NAME:</small>
                        <b>{{ strtoupper($_account->applicant->mother_last_name .', ' .$_account->applicant->mother_first_name .' ' .$_account->applicant->mother_middle_name) }}</b>
                    </td>
                    <td><small>CONTACT NUMBER:</small> <b>{{ $_account->applicant->mother_contact_number }}</td>
                </tr>
            </tbody>
        </table>
        <br>
        <p class="title-header"><b>| SCHOOL ATTENDED</b></p>
        <br>
        <table class="table">
            @if ($_account->course_id != 3)
                <tbody>
                </tbody>
            @else
                <tbody>
                    
                </tbody>
            @endif
        </table>
    </main>
@endsection
