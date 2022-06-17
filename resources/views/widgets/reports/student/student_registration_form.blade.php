@extends('widgets.reports.grade.report_layout_1')
@section('title-report', 'FORM RG-03 - STUDENT REGISTRATION : ' . strtoupper($_student->last_name . ', ' .
    $_student->first_name . ' ' . $_student->middle_name))
@section('form-code', 'RG - 03')
@section('content')
    <main class="content">
        <div class="form-rg-information">
            <h3 class="text-center">STUDENT'S REGISTRATION FORM</h3>
            <h6 class="text-center">A.Y.
                {{ strtoupper(Auth::user()->student->enrollment_application->academic->school_year . ' | ' . Auth::user()->student->enrollment_application->academic->semester) }}
            </h6>
            <div class="student-information">
                <h5 for="" class="text-header">A. STUDENT'S INFORMATION</h5>
                <table class="form-rg-table">
                    <tbody>
                        <tr>
                            <td colspan="4"></td>
                            <td width="60px"><small>DATE:</small></td>
                            <td class="text-fill-in">
                                <b>{{ strtoupper(date('F j, Y', strtotime(Auth::user()->student->enrollment_application->created_at))) }}</b>
                            </td>
                        </tr>
                    </tbody>
                    <tbody>
                        <tr>
                            <td width="80px">
                                <small>NAME (PRINT):</small>
                            </td>
                            <td class="text-fill-in"><b>{{ strtoupper($_student->last_name) }},</b> </td>
                            <td class="text-fill-in"> <b>{{ strtoupper($_student->first_name) }}</b></td>
                            <td class="text-fill-in"> <b>{{ strtoupper($_student->middle_name) }}</b></td>
                            <td>
                                <small>STUDENT #:</small>

                            </td>
                            <td class="text-fill-in"><b>{{ $_student->account->student_number }}</b></td>
                        </tr>
                        <tr class="text-center">
                            <td colspan="1"></td>
                            <td> <small>SURNAME</small> </td>
                            <td><small>FIRST NAME</small></td>
                            <td><small>MIDDLE NAME</small></td>
                            <td colspan="2"></td>
                    </tbody>
                </table>
                <table class="form-rg-table">
                    <tbody>
                        <tr>
                            <td width="5%"><small>COURSE:</small></td>
                            <td width="40%" class="text-fill-in">
                                <b> {{ Auth::user()->student->enrollment_application->course->course_name }}</b>
                            </td>
                            <td width="3%"><small>YEAR:</small></td>
                            <td class="text-fill-in">
                                <b>{{ Auth::user()->student->enrollment_application->course_id == 3 ? 'GRADE ' . Auth::user()->student->enrollment_application->year_level : Auth::user()->student->enrollment_application->year_level . ' CLASS' }}</b>
                            </td>
                            <td width="5%"><small>SEMESTER:</small></td>
                            <td class="text-fill-in">
                                <b> {{ strtoupper(Auth::user()->student->enrollment_application->academic->semester) }}</b>
                            </td>

                            <td width="3%"><small>AY:</small></td>
                            <td class="text-fill-in">
                                <b> {{ Auth::user()->student->enrollment_application->academic->school_year }}</b>
                            </td>

                    </tbody>
                </table>
                <table class="form-rg-table">
                    <tbody>
                        <tr>
                            <td><small>COMPLETE ADDRESS:</small></td>
                            <td class="text-fill-in">
                                <b>{{ strtoupper($_student->street . ' ' . $_student->barangay) }}</b>
                            </td>
                            <td class="text-fill-in">
                                <b>{{ strtoupper($_student->municipality) }}</b>
                            </td>
                            <td class="text-fill-in">
                                <b>{{ strtoupper($_student->province) }}</b>
                            </td>
                            <td> <small>ZIP CODE: </small> </td>
                            <td class="text-fill-in"> <b>{{ $_student->zip_code }}</b></td>
                        </tr>
                        <tr class="text-center">
                            <td></td>
                            <td><small>(Street / Barangay)</small></td>
                            <td><small>(Town/ City/ Municipality)</small></td>
                            <td><small>(Pronvince)</small></td>
                            <td colspan="2"></td>
                        </tr>
                    </tbody>
                </table>
                <table class="form-rg-table">
                    <tbody>
                        <tr>
                            <td width="10%"><small> DATE OF BIRTH:</small> </td>
                            <td class="text-fill-in">
                                <b>{{ strtoupper(date('F j, Y', strtotime($_student->birthday))) }}</b>
                            </td>
                            <td width="3%"><small> AGE:</small></td>
                            <td width="15%" class="text-fill-in">
                                <b>@php
                                    echo date_diff(date_create($_student->birthday), date_create(date('Y-m-d')))->format('%y');
                                @endphp
                                    years old
                                </b>
                            </td>
                            <td width="10%"><small>BIRTH PLACE:</small> </td>
                            <td class="text-fill-in">
                                <b>{{ strtoupper($_student->birth_place) }}</b>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <table class="form-rg-table">
                    <tbody>
                        <tr>
                            <td width="10%"> <small>NATIONALITY:</small></td>
                            <td class="text-fill-in">
                                <b> {{ strtoupper($_student->nationality) }}</b>
                            </td>
                            <td width="6%"> <small>STATUS:</small></td>
                            <td class="text-fill-in">
                                <b>{{ $_student->status ? strtoupper($_student->status) : 'SINGLE' }}</b>
                            </td>
                            <td width="3%"> <small>SEX:</small> </td>
                            <td class="text-fill-in">
                                <b>{{ strtoupper($_student->sex) }}</b>
                            </td>
                            <td width="7%"> <small>RELIGION:</small></td>
                            <td class="text-fill-in">
                                <b>{{ $_student->religion ? strtoupper($_student->religion) : '-' }}</b>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <table class="form-rg-table">
                    <tbody>
                        <tr>
                            <td width="21%"><small>PARENT / GUARDIAN'S ADDRESS:</small></td>
                            <td class="text-fill-in">

                                <b>{{ strtoupper($_student->parent_address) }}</b>

                            </td>
                        </tr>
                    </tbody>
                </table>
                <table class="form-rg-table">
                    <tbody>
                        <tr>
                            <td width="10%"><small>CONTACT NO.:</small></td>
                            <td class="text-fill-in">
                                <b> {{ $_student->contact_number }}</b>
                            </td>
                            <td width="12%"><small>EMAIL ADDRESS: </small></td>
                            <td class="text-fill-in">
                                <b>{{ $_student->account->personal_email }}</b>
                            </td>

                        </tr>
                    </tbody>
                </table>
                <br>
                <div class="educational-background">
                    <h6><b>EDUCATIONAL BACKGROUND</b></h6>
                    <table class="form-rg-table">
                        @if (Auth::user()->student->enrollment_application->course_id != 3)
                            <tbody>
                                @foreach ($_student->educational_background as $_data)
                                    <tr>
                                        <td width="15%"><small>{{ strtoupper($_data->school_level) }}:</small>
                                        </td>
                                        <td class="text-fill" width="68%">
                                            <b>{{ strtoupper($_data->school_name) }}</b>
                                        </td>
                                        <td width="3%"><small>AY:</small></td>
                                        <td class="text-fill-in"><b>{{ $_data->graduated_year }}</b></td>
                                    </tr>
                                @endforeach

                                <tr>
                                    <td colspan="2"><small>COLLEGE (IF ANY):</small>

                                    </td>
                                    <td><small>AY:</td>
                                    <td></td>
                                </tr>

                            </tbody>
                        @else
                            <tbody>
                                @foreach ($_student->educational_background as $_data)
                                    <tr>
                                        @if (strtoupper($_data->school_level) != 'SENIOR HIGH SCHOOL')
                                            <td colspan="2"><small>{{ strtoupper($_data->school_level) }}:</small>
                                                <b>{{ strtoupper($_data->school_name) }}</b>
                                            </td>
                                            <td><small>AY:</small> </td>
                                            <td class="text-fill-in"><b>{{ $_data->graduated_year }}</b></td>
                                        @endif
                                    </tr>
                                @endforeach
                            </tbody>
                        @endif
                    </table>
                </div>
            </div>
            <div class="parent-information">
                <br>
                <h5 for="" class="text-header">B. PARENT / GUARDIAN INFOMATION</h5>
                @php
                    $_parent = $_student->parent_details;
                    $_educational_attainment = ['Elementary Graduate', 'High School Graduate', 'College', 'Vocational', "Master's / Doctorate Degree", 'Did not attend school', 'Other: ________'];
    $_employment_status = ['Full Time', 'Part Time', 'Self-employed (i.e. Family Business)', 'Unemployed due to community quarantine', 'Not Working'];
    $_arrangement = ['WFH', 'Office', 'Field Work'];
    $_income = ['Below 10,000', '10,000-20,000', '20,000-40,000', '40,000-60,000', '60,000 Above'];
    $_dswd = ['Yes', 'No'];
    $_homeownership = ['Owned', 'Mortgaged', 'Rented'];
    $_cars = ['0', '1', '2', '3', 'Others'];
    $_device = ['Cable TV', 'Non-Cable TV', 'Basic Cellphone', 'Smartphone', 'Tablet', 'Radio', 'Desktop Computer', 'Laptop', 'None', 'Others ______'];
    $_connect = ['Yes', 'No'];
    $_provider = ['own mobile data', 'own broadband (DSL, Wireless Fiber, Satellite)', 'computer shop', 'other places outside the home with internet connection (library, barangay,municipal hall neighbor, relatives)', 'none'];
    $_learning_modality = ['online learning', 'Blended', 'Face-to-Face'];
    $_inputs = ['lack of available gadgets / equipment', 'insufficient load/data allowance', 'existing health condition/s', 'difficulty in independent learning', 'conflict with other activities (i.e. house chores)', 'none or lack of available space for studying', 'distractions (i.e. social media, noise from community/ neighbor)', 'none'];
                    
                @endphp
                <table class="form-rg-table">
                    <tbody>
                        <tr>
                            <th><b>FATHER</b></th>
                            <th><b>MOTHER</b></th>
                            <th><b>GUARIAN</b></th>
                        </tr>
                        <tr>
                            <td> <small>B1. FULL NAME (Last name, First name, Middle name)</small></td>
                            <td> <small>B6. FULL MAIDEN (Last name, First name, Middle name)</small></td>
                            <td> <small>B11. FULL NAME (Last name, First name, Middle name)</small></td>
                        </tr>
                        <tr>
                            <td class="text-fill-in">
                                <b>
                                    {{ $_parent ? strtoupper($_parent->father_last_name . ', ' . $_parent->father_first_name . ' ' . $_parent->father_middle_name) : '-' }}
                                </b>
                            </td>
                            <td class="text-fill-in">
                                <b>
                                    {{ $_parent ? strtoupper($_parent->mother_last_name . ', ' . $_parent->mother_first_name . ' ' . $_parent->mother_middle_name) : '-' }}
                                </b>
                            </td>
                            <td class="text-fill-in">
                                <b>
                                    {{ $_parent ? strtoupper($_parent->guardian_last_name . ', ' . $_parent->guardian_first_name . ' ' . $_parent->guardian_middle_name) : '-' }}
                                </b>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <p><small>B2. HIGHEST EDUCATIONAL ATTAINMENT:</small></p>
                                @foreach ($_educational_attainment as $_key => $_education)
                                    <p>
                                        <input type="checkbox" class="form-input-check" id="educ-{{ $_key }}"
                                            {{ $_parent ? ($_parent->father_educational_attainment == $_education ? 'checked' : '') : '' }}>
                                        <label class="form-label"
                                            for="educ-{{ $_key }}">{{ $_education }}</label>
                                    </p>
                                @endforeach
                            </td>
                            <td>
                                <p><small>B7. HIGHEST EDUCATIONAL ATTAINMENT:</small></p>
                                @foreach ($_educational_attainment as $_key => $_education)
                                    <p>
                                        <input type="checkbox" class="form-input-check" id="educ-{{ $_key }}"
                                            {{ $_parent ? ($_parent->mother_educational_attainment == $_education ? 'checked' : '') : '' }}>
                                        <label class="form-label"
                                            for="educ-{{ $_key }}">{{ $_education }}</label>
                                    </p>
                                @endforeach
                            </td>
                            <td>
                                <p><small>B12. HIGHEST EDUCATIONAL ATTAINMENT:</small></p>
                                @foreach ($_educational_attainment as $_key => $_education)
                                    <p>
                                        <input type="checkbox" class="form-input-check" id="educ-{{ $_key }}"
                                            {{ $_parent ? ($_parent->guardian_educational_attainment == $_education ? 'checked' : '') : '' }}>
                                        <label class="form-label"
                                            for="educ-{{ $_key }}">{{ $_education }}</label>
                                    </p>
                                @endforeach
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <small>B3. EMPLOYMENT STATUS</small>
                                @foreach ($_employment_status as $_key => $_status)
                                    <p>
                                        <input type="checkbox" class="form-input-check" id="educ-{{ $_key }}"
                                            {{ $_parent ? ($_parent->father_employment_status == $_status ? 'checked' : '') : '' }}>
                                        <label class="form-label"
                                            for="educ-{{ $_key }}">{{ $_status }}</label>

                                    </p>
                                @endforeach
                            </td>
                            <td>
                                <small>B8. EMPLOYMENT STATUS</small>
                                @foreach ($_employment_status as $_key => $_status)
                                    <p>
                                        <input type="checkbox" class="form-input-check" id="educ-{{ $_key }}"
                                            {{ $_parent ? ($_parent->mother_employment_status == $_status ? 'checked' : '') : '' }}>
                                        <label class="form-label"
                                            for="educ-{{ $_key }}">{{ $_status }}</label>

                                    </p>
                                @endforeach
                            </td>
                            <td>
                                <small>B13. EMPLOYMENT STATUS</small>
                                @foreach ($_employment_status as $_key => $_status)
                                    <p>
                                        <input type="checkbox" class="form-input-check" id="educ-{{ $_key }}"
                                            {{ $_parent ? ($_parent->guardian_employment_status == $_status ? 'checked' : '') : '' }}>
                                        <label class="form-label"
                                            for="educ-{{ $_key }}">{{ $_status }}</label>

                                    </p>
                                @endforeach
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <small>B4. WORKING ARRANGEMENT</small>


                                @foreach ($_arrangement as $_key => $_data)
                                    <p>
                                        <input type="checkbox" class="form-input-check" id="educ-{{ $_key }}"
                                            {{ $_parent ? ($_parent->father_working_arrangement == $_data ? 'checked' : '') : '' }}>
                                        <label class="form-label"
                                            for="educ-{{ $_key }}">{{ $_data }}</label>
                                    </p>
                                @endforeach
                            </td>
                            <td>
                                <small>B9. WORKING ARRANGEMENT</small>
                                @foreach ($_arrangement as $_key => $_data)
                                    <p>
                                        <input type="checkbox" name="form-input-check" id="educ-{{ $_key }}"
                                            {{ $_parent ? ($_parent->mother_working_arrangement == $_data ? 'checked' : '') : '' }}>
                                        <label class="form-label"
                                            for="educ-{{ $_key }}">{{ $_data }}</label>
                                    </p>
                                @endforeach
                            </td>
                            <td>
                                <small>B14. WORKING ARRANGEMENT</small>
                                @foreach ($_arrangement as $_key => $_data)
                                    <p>
                                        <input type="checkbox" class="form-input-check" id="educ-{{ $_key }}"
                                            {{ $_parent ? ($_parent->guardian_working_arrangement == $_data ? 'checked' : '') : '' }}>
                                        <label for="educ-{{ $_key }}"
                                            class="form-label">{{ $_data }}</label>
                                    </p>
                                @endforeach
                            </td>
                        </tr>
                        <tr>
                            <td>B5. CONTACT NUMBER/s</td>
                            <td>B10. CONTACT NUMBER/s</td>
                            <td>B15. CONTACT NUMBER/s</td>
                        </tr>
                        <tr>
                            <td class="text-fill-in">
                                <b>{{ $_parent ? $_parent->father_contact_number : '-' }}</b>
                            </td>
                            <td class="text-fill-in">
                                <b>{{ $_parent ? $_parent->mother_contact_number : '-' }}</b>
                            </td>
                            <td class="text-fill-in">
                                <b>{{ $_parent ? $_parent->guardian_contact_number : '-' }}</b>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="">
                                <small>B16. HOUSEHOLD CAPITAL INCOME:</small><br>
                                @foreach ($_income as $_key => $_data)
                                    <div class="">
                                        <input type="checkbox" class="form-check-input" name=""
                                            id="b16-{{ $_key }}"
                                            {{ $_parent ? ($_parent->household_income == $_data ? 'checked' : '') : '' }}>
                                        <label class="form-label" for="b16-{{ $_key }}">

                                            {{ $_data }}
                                        </label>

                                    </div>
                                @endforeach
                            </td>
                            <td colspan="" colspan="1" valign="top">
                                <small>B17. IS YOUR FAMILY A BENEFICIARY OF DSWD LISTHAN / 4P's :</small><br>
                                @foreach ($_dswd as $_key => $_data)
                                    <p>
                                        <input type="checkbox" class="form-check-input" id="educ-{{ $_key }}"
                                            {{ $_parent ? ($_parent->dswd_listahan == $_data ? 'checked' : '') : '' }}>
                                        <label for="b17-{{ $_key }}"
                                            class="form-label">{{ $_data }}</label>
                                    </p>
                                @endforeach
                            </td>
                            <td colspan="1" colspan="1" valign="top">
                                <small>B18. HOMEOWERSHIP:</small><br>
                                @foreach ($_homeownership as $_key => $_data)
                                    <p>
                                        <input type="checkbox" class="form-check-input" id="educ-{{ $_key }}"
                                            {{ $_parent ? ($_parent->homeownership == $_data ? 'checked' : '') : '' }}>
                                        <label for="educ-{{ $_key }}"
                                            class="form-label">{{ $_data }}</label>
                                    </p>
                                @endforeach
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3" colspan="1" valign="top">
                                <small>B19. CAR ONWNERSHIP :</small><br>
                                @foreach ($_cars as $_key => $_data)
                                    <input type="checkbox" class="form-check-input" id="educ-{{ $_key }}"
                                        {{ $_parent ? ($_parent->car_ownership == $_data ? 'checked' : '') : '' }}>
                                    <label for="educ-{{ $_key }}" class="form">{{ $_data }}</label>
                                @endforeach
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="page-break"></div>
            <div class="survey-information">
                <br>
                <h5 for="" class="text-header">C. ACCESS TO DISTANCE LEARNING</h5>
                <table class="form-rg-table">
                    <tr>
                        <td colspan="1">
                            <small>C1. WHAT DEVICES ARE AVAILABLE AT HOME THAT THE STUDENT CAN USE FOR LEARNING?
                            </small><br>

                            @php
                                $_device_1 = $_parent ? unserialize($_parent->available_devices) : [];
                            @endphp
                            @foreach ($_device as $_data)
                                <div>
                                    <input class="form-input-check" type="checkbox"
                                        {{ in_array($_data, $_device_1) ? 'checked' : '' }}>
                                    <label class="form-label">
                                        {{ $_data }}
                                    </label>
                                </div>
                            @endforeach

                        </td>
                        <td colspan="1" valign="top">
                            <small>C2. DO YOU HAVE A WAY TO CONNECT TO THE INTERNET? </small> <br>
                            @foreach ($_connect as $_data)
                                <div>
                                    <input type="checkbox" class="form-input-check"
                                        {{ $_parent ? ($_parent->available_connection == $_data ? 'checked' : '') : '' }}>
                                    <label class="form-label" for="">{{ $_data }}</label>
                                </div>
                            @endforeach
                        </td>
                        <td colspan="1" valign="top">
                            <small>C3. HOW DO YOU CONNECT TO THE INTERNET? </small><br>
                            @php
                                $_array = $_parent ? unserialize($_parent->available_provider) : [];
                            @endphp
                            @foreach ($_provider as $_data)
                                <div>
                                    <input class="form-input-check" type="checkbox"
                                        {{ in_array($_data, $_array) ? 'checked' : '' }}>
                                    <label class="form-label">{{ $_data }}</label>
                                </div>
                            @endforeach
                        </td>
                    </tr>

                    <tr>
                        <td colspan="1" valign="top">
                            <small>C4. WHAT LEARNING MODALITY DO YOU PREFER? </small><br>
                            @php
                                $_array = $_parent ? unserialize($_parent->learning_modality) : [];
                            @endphp
                            @foreach ($_learning_modality as $_data)
                                <div>
                                    <input class="form-input-label" type="checkbox"
                                        {{ in_array($_data, $_array) ? 'checked' : '' }}>
                                    <label for="" class="form-label">{{ $_data }}</label>
                                </div>
                            @endforeach
                        </td>
                        <td colspan="2" valign="top">
                            <small>C6. WHAT ARE THE CHALLENGES THAT MAY AFFECT YOUR LEARNING PROCESS THROUGH DISTANCE
                                EDUCATIONAL? </small><br>
                            @php
                                $_array = $_parent ? unserialize($_parent->distance_learning_effect) : [];
                            @endphp
                            @foreach ($_inputs as $_data)
                                <div>
                                    <input class="form-input-label" type="checkbox"
                                        {{ in_array($_data, $_array) ? 'checked' : '' }}>
                                    <label for="" class="form-label">{{ $_data }}</label>
                                </div>
                            @endforeach
                        </td>
                    </tr>
                </table>
            </div>
            <br><br>
            <p class="note">
                I hereby certify that the above information given are true and correct to the best of my knowledge and I
                allow the Baliwag Maritime Academy Inc, to use the information provided herein for the purpose of the
                Learner Information System and personal porfile. The information herein shall be treated as confidential in
                compliance with the Data Privacy Act of 2012.
            </p>
            <div class="signature">
                <br>
                <table class="form-rg-table">
                    <tbody>
                        <tr class="text-center">
                            <td colspan="1">
                                <b><u>{{ strtoupper($_student->last_name . ', ' . $_student->first_name . ' ' . $_student->middle_name) }}</u>
                                </b>
                            </td>
                            <td colspan="2">
                                <u><b>{{ strtoupper(date('F j, Y', strtotime(Auth::user()->student->enrollment_application->created_at))) }}</b></u>
                            </td>
                        </tr>
                        <tr class="text-center">
                            <td colspan="1">Signature Over Printend Name of Student/Midshipman</td>
                            <td colspan="2">Date</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </main>
@endsection
