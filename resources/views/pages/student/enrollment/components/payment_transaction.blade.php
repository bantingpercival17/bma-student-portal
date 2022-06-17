@php
$_title = 'STEP 4: PAYMENT TRANSACTION';
@endphp

@section('step-4-dot')
    <div class="timeline-dots timeline-dot1 border-secondary  text-success"></div>
    <h5 class="float-left mb-1 text-muted fw-bolder">
        <i>{{ $_title }}</i>
    </h5>
@endsection


@if (Auth::user()->student->enrollment_application)
    @if (Auth::user()->student->enrollment_assessment)
        @if (Auth::user()->student->enrollment_assessment->payment_assessments)
            @section('step-4-dot-active')
                <div class="timeline-dots1 border-primary text-primary">
                    <svg width="20" viewBox="0 2 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M7.67 2H16.34C19.73 2 22 4.38 22 7.92V16.09C22 19.62 19.73 22 16.34 22H7.67C4.28 22 2 19.62 2 16.09V7.92C2 4.38 4.28 2 7.67 2ZM7.52 13.2C6.86 13.2 6.32 12.66 6.32 12C6.32 11.34 6.86 10.801 7.52 10.801C8.18 10.801 8.72 11.34 8.72 12C8.72 12.66 8.18 13.2 7.52 13.2ZM10.8 12C10.8 12.66 11.34 13.2 12 13.2C12.66 13.2 13.2 12.66 13.2 12C13.2 11.34 12.66 10.801 12 10.801C11.34 10.801 10.8 11.34 10.8 12ZM15.28 12C15.28 12.66 15.82 13.2 16.48 13.2C17.14 13.2 17.67 12.66 17.67 12C17.67 11.34 17.14 10.801 16.48 10.801C15.82 10.801 15.28 11.34 15.28 12Z"
                            fill="currentColor"></path>
                    </svg>
                </div>
                <h5 class="float-left mb-1 text-primary fw-bolder">
                    {{ $_title }}
                </h5>
                <div class="d-inline-block w-100ß">
                    <div class="row">
                        <div class="col-md">
                            <h5 class=" mb-1 fw-bolder">PAYMENT INSTRUCTION</h5>
                            <p>For bank deposit or online fund transfer, please us the bank details
                                below:
                            </p>
                            <div class="row">
                                @if (Auth::user()->student->enrollment_assessment->course_id == 3)
                                    <div class="col-md-12">
                                        <p>
                                            <label for="" class="h6 fw-bolder">SENIOR HIGH
                                                SCHOOL</label><br>
                                            <label for="">Bank: <br>
                                                <span class="fw-bolder text-info">LANDBANK OF THE
                                                    PHILLIPINES</span>
                                            </label>
                                            <br>
                                            <label for="">Account Name: <br>
                                                <span class="fw-bolder text-info">BALIWAG MARITIME
                                                    FOUNDATION,
                                                    INC.</span>
                                            </label><br>
                                            <label for="">Account Number: <br>
                                                <span class="fw-bolder text-info">0102112822</span>
                                            </label>
                                        </p>
                                    </div>
                                @else
                                    <div class="col-md-12">
                                        <p>
                                            <label for="" class="h6 fw-bolder">COLLEGE</label><br>
                                            <label for="">Bank: <br>
                                                <span class="fw-bolder text-info">BANK OF COMMERCE</span>
                                            </label>
                                            <br>
                                            <label for="">Account Name: <br>
                                                <span class="fw-bolder text-info">BALIWAG MARITIME
                                                    ACADEMY INC</span>
                                            </label><br>
                                            <label for="">Account Number: <br>
                                                <span class="fw-bolder text-info">062000001037</span>
                                            </label>
                                        </p>
                                    </div>
                                @endif


                            </div>
                        </div>
                        <div class="col-md">
                            @if (Auth::user()->student->enrollment_assessment->payment_assessments->online_transaction)
                                <h5 class=" mb-1 fw-bolder">PAYMENT VERIFICATION</h5>
                                <div class="align-items-center">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <small class="form-label">
                                                TRANSACTION DATE
                                            </small>
                                            <p class="fw-bolder">
                                                {{ Auth::user()->student->enrollment_assessment->payment_assessments->online_transaction->created_at->format('d, F Y') }}
                                            </p>
                                        </div>
                                        <div class="col-md">
                                            <small class="form-label">
                                                REFERENCE NO:
                                            </small>
                                            <p class="fw-bolder text-primary h5">
                                                {{ Auth::user()->student->enrollment_assessment->payment_assessments->online_transaction->reference_number }}
                                            </p>
                                        </div>
                                        <div class="col-md">
                                            <small class="form-label">
                                                AMOUNT:
                                            </small>
                                            <p class="fw-bolder text-primary h5">
                                                PHP
                                                {{ number_format(Auth::user()->student->enrollment_assessment->payment_assessments->online_transaction->amount_paid) }}
                                            </p>
                                        </div>
                                        <div class="col-md-12">
                                            <small class="form-label">
                                                PROOF OF PAYMENT
                                            </small>
                                            <a href="{{ Auth::user()->student->enrollment_assessment->payment_assessments->online_transaction->reciept_attach_path }}"
                                                target="_blank"
                                                class="btn btn-outline-primary btn-sm ms-3 rounded-pill">view</a>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-between mt-2">

                                        @if (Auth::user()->student->enrollment_assessment->payment_assessments->online_transaction->is_approved === null)
                                            <div>
                                                <span class="text-info">This payment is
                                                    under verification of Accounting
                                                    Office's</span>
                                            </div>
                                        @endif
                                        @if (Auth::user()->student->enrollment_assessment->payment_assessments->online_transaction->is_approved === 0)
                                            <div>
                                                <span class="text-info">This payment was
                                                    disapproved because of this Remarks: </span>
                                                <span
                                                    class="text-danger">{{ Auth::user()->student->enrollment_assessment->payment_assessments->online_transaction->comment_remarks }}</span>
                                            </div>
                                        @endif
                                        @if (Auth::user()->student->enrollment_assessment->payment_assessments->online_transaction->is_approved == 1)
                                            <div>
                                                <span class="text-info">This payment was
                                                    Verified: </span>

                                            </div>
                                        @endif
                                    </div>
                                </div>

                                @if (Auth::user()->student->enrollment_assessment->payment_assessments->online_transaction->is_approved === 0)
                                    <h5 class=" mb-1 fw-bolder">ENTER PAYMENT DETAILS:</h5>
                                    <form action="{{ route('enrollment.online-transaction-payment') }}" method="post"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name="_assessment"
                                            value="{{ base64_encode(Auth::user()->student->enrollment_assessment->payment_assessments->id) }}">
                                        <div class="form-group">
                                            <label for="" class="form-label text-sm">STUDENT
                                                NUMBER</label>
                                            <input type="text" class="form-control"
                                                value="{{ $_student->account->student_number }}" disabled>
                                        </div>
                                        <div class="form-group">
                                            <label for="" class="form-label text-sm">STUDENT
                                                NAME</label>
                                            <input type="text" class="form-control" name="_name"
                                                value="{{ strtoupper($_student->first_name . ' ' . $_student->last_name) }}"
                                                disabled>
                                        </div>
                                        <div class="form-group">
                                            <label for="" class="form-label text-sm">TRANSCATION
                                                DATE</label>
                                            <input type="date" class="form-control" name="_transaction_date"
                                                value="{{ old('_transaction_date') }}">
                                            @error('_transaction_date')
                                                <div class="badge bg-danger mt-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="" class="form-label text-sm">AMOUNT PAID</label>
                                            <input type="text" class="form-control" name="_amount_paid"
                                                value="{{ old('_amount_paid') }}">
                                            @error('_amount_paid')
                                                <div class="badge bg-danger mt-2">{{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="" class="form-label text-sm">REFERENCE
                                                NUMBER</label>
                                            <input type="text" class="form-control" name="_reference_number"
                                                value="{{ old('_reference_number') }}">
                                            @error('_reference_number')
                                                <div class="badge bg-danger mt-2">{{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="" class="form-label text-sm">TRANSACTION
                                                TYPE</label>
                                            <select name="_transaction_type" id="" class="form-select"
                                                value={{ old('_transaction_type') }}>
                                                <option value="_upon_enrollment" selected>Upon
                                                    Enrollment
                                                </option>
                                            </select>
                                            @error('_transaction_type')
                                                <div class="badge bg-danger mt-2">{{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="" class="form-label text-sm">ATTACH
                                                RECEIPT</label>
                                            <input type="file" class="form-control" name="_file"
                                                accept=".png, .jpeg, .jpg, .pdf" value={{ old('_file') }}>
                                            @error('_file')
                                                <div class="badge bg-danger mt-2">{{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <button class="btn btn-primary w-100" type="submit">SUBMIT</button>
                                    </form>
                                @endif
                            @else
                                <h5 class=" mb-1 fw-bolder">ENTER PAYMENT DETAILS:</h5>
                                <form action="{{ route('enrollment.online-transaction-payment') }}" method="post"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="_assessment"
                                        value="{{ base64_encode(Auth::user()->student->enrollment_assessment->payment_assessments->id) }}">
                                    <div class="form-group">
                                        <label for="" class="form-label text-sm">STUDENT NUMBER</label>
                                        <input type="text" class="form-control"
                                            value="{{ $_student->account->student_number }}" disabled>
                                    </div>
                                    <div class="form-group">
                                        <label for="" class="form-label text-sm">STUDENT NAME</label>
                                        <input type="text" class="form-control" name="_name"
                                            value="{{ strtoupper($_student->first_name . ' ' . $_student->last_name) }}"
                                            disabled>
                                    </div>
                                    <div class="form-group">
                                        <label for="" class="form-label text-sm">TRANSCATION
                                            DATE</label>
                                        <input type="date" class="form-control" name="_transaction_date"
                                            value="{{ old('_transaction_date') }}">
                                        @error('_transaction_date')
                                            <div class="badge bg-danger mt-2">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="" class="form-label text-sm">AMOUNT PAID</label>
                                        <input type="text" class="form-control" name="_amount_paid"
                                            value="{{ old('_amount_paid') }}">
                                        @error('_amount_paid')
                                            <div class="badge bg-danger mt-2">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="" class="form-label text-sm">REFERENCE
                                            NUMBER</label>
                                        <input type="text" class="form-control" name="_reference_number"
                                            value="{{ old('_reference_number') }}">
                                        @error('_reference_number')
                                            <div class="badge bg-danger mt-2">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="" class="form-label text-sm">TRANSACTION
                                            TYPE</label>
                                        <select name="_transaction_type" id="" class="form-select"
                                            value={{ old('_transaction_type') }}>
                                            <option value="_upon_enrollment" selected>Upon Enrollment
                                            </option>
                                        </select>
                                        @error('_transaction_type')
                                            <div class="badge bg-danger mt-2">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="" class="form-label text-sm">ATTACH RECEIPT</label>
                                        <input type="file" class="form-control" name="_file"
                                            accept=".png, .jpeg, .jpg, .pdf" value={{ old('_file') }}>
                                        @error('_file')
                                            <div class="badge bg-danger mt-2">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <button class="btn btn-primary w-100" type="submit">SUBMIT</button>
                                </form>
                            @endif

                        </div>
                    </div>
                </div>
            @endsection
            @if (Auth::user()->student->enrollment_assessment->payment_assessments->online_transaction)
                @section('step-4-dot-done')
                    <div class="timeline-dots1 border-secondary text-muted">
                        <svg width="20" viewBox="0 2 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M7.67 2H16.34C19.73 2 22 4.38 22 7.92V16.091C22 19.62 19.73 22 16.34 22H7.67C4.28 22 2 19.62 2 16.091V7.92C2 4.38 4.28 2 7.67 2ZM11.43 14.99L16.18 10.24C16.52 9.9 16.52 9.35 16.18 9C15.84 8.66 15.28 8.66 14.94 9L10.81 13.13L9.06 11.38C8.72 11.04 8.16 11.04 7.82 11.38C7.48 11.72 7.48 12.27 7.82 12.62L10.2 14.99C10.37 15.16 10.59 15.24 10.81 15.24C11.04 15.24 11.26 15.16 11.43 14.99Z"
                                fill="currentColor"></path>
                        </svg>
                    </div>
                    <h5 class="float-left mb-1 text-muted fw-bolder">
                        {{ $_title }}
                    </h5>
                    <div class="d-inline-block w-100">
                        <p class="mb-3">
                            Your payment transaction complete.
                        </p>
                    </div>
                @endsection
            @endif

        @endif
    @endif

@endif
