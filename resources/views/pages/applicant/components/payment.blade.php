@section('step-3-dot-active')
    <div class="timeline-dots1 border-primary text-primary">
        <svg width="20" viewBox="0 2 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd" clip-rule="evenodd"
                d="M7.67 2H16.34C19.73 2 22 4.38 22 7.92V16.09C22 19.62 19.73 22 16.34 22H7.67C4.28 22 2 19.62 2 16.09V7.92C2 4.38 4.28 2 7.67 2ZM7.52 13.2C6.86 13.2 6.32 12.66 6.32 12C6.32 11.34 6.86 10.801 7.52 10.801C8.18 10.801 8.72 11.34 8.72 12C8.72 12.66 8.18 13.2 7.52 13.2ZM10.8 12C10.8 12.66 11.34 13.2 12 13.2C12.66 13.2 13.2 12.66 13.2 12C13.2 11.34 12.66 10.801 12 10.801C11.34 10.801 10.8 11.34 10.8 12ZM15.28 12C15.28 12.66 15.82 13.2 16.48 13.2C17.14 13.2 17.67 12.66 17.67 12C17.67 11.34 17.14 10.801 16.48 10.801C15.82 10.801 15.28 11.34 15.28 12Z"
                fill="currentColor"></path>
        </svg>
    </div>
    <h5 class="float-left mb-1 text-primary fw-bolder">
        STEP 3: Entrance Examination Payment
    </h5>
@endsection


@section('step-3-dot-done')
    <div class="timeline-dots1 border-secondary text-muted">
        <svg width="20" viewBox="0 2 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd" clip-rule="evenodd"
                d="M7.67 2H16.34C19.73 2 22 4.38 22 7.92V16.091C22 19.62 19.73 22 16.34 22H7.67C4.28 22 2 19.62 2 16.091V7.92C2 4.38 4.28 2 7.67 2ZM11.43 14.99L16.18 10.24C16.52 9.9 16.52 9.35 16.18 9C15.84 8.66 15.28 8.66 14.94 9L10.81 13.13L9.06 11.38C8.72 11.04 8.16 11.04 7.82 11.38C7.48 11.72 7.48 12.27 7.82 12.62L10.2 14.99C10.37 15.16 10.59 15.24 10.81 15.24C11.04 15.24 11.26 15.16 11.43 14.99Z"
                fill="currentColor"></path>
        </svg>
    </div>
    <h5 class="float-left mb-1 text-muted fw-bolder">
        STEP 3: Entrance Examination Payment
    </h5>
    <div class="d-inline-block w-100">
        <p class="mb-0">
            Your Payment was Verified. You may can now take the Entrance Examination
        </p>
    </div>
@endsection

@section('step-3-dot')
    <div class="timeline-dots timeline-dot1 border-secondary  text-success"></div>
    <h5 class="float-left mb-1 text-muted fw-bolder">
        <i> STEP 3 Entrance Examination Payment</i>
    </h5>
@endsection


@section('payment-view')
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md">
                    <h5 class=" mb-1 fw-bolder text-info">PAYMENT INSTRUCTION</h5>
                    <p>For bank deposit or online fund transfer, please us the bank details
                        below:
                    </p>
                    <div class="row">
                        <div class="col-md-12">
                            <label for="" class="fw-bolder h6 text-muted">SENIOR HIGH
                                SCHOOL</label><br>
                            <div class="d-inline-block">
                                <div><small>Bank:</small></div>
                                <div>
                                    <span class="fw-bolder text-info">LANDBANK OF THE
                                        PHILLIPINES</span>
                                </div>
                            </div>
                            <div class="d-inline-block">
                                <div><small>Account Name:</small></div>
                                <div>
                                    <span class="fw-bolder text-info">BALIWAG MARITIME
                                        FOUNDATION,
                                        INC.</span>
                                </div>
                            </div>
                            <div class="d-inline-block">
                                <div><small>Account Number:</small></div>
                                <div>
                                    <span class="fw-bolder text-info">0102112822</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 mt-3">
                            <label for="" class="fw-bolder h6 text-muted">COLLEGE</label><br>
                            <div class="d-inline-block">
                                <div><small>Bank:</small></div>
                                <div>
                                    <span class="fw-bolder text-info">BANK OF COMMERCE</span>
                                </div>
                            </div>
                            <div class="d-inline-block">
                                <div><small>Account Name:</small></div>
                                <div>
                                    <span class="fw-bolder text-info">BALIWAG MARITIME ACADEMY
                                        INC</span>
                                </div>
                            </div> <br>
                            <div class="d-inline-block">
                                <div><small>Account Number:</small></div>
                                <div>
                                    <span class="fw-bolder text-info">062000001037</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <h5 class=" mb-1 fw-bolder">ENTER PAYMENT DETAILS:</h5>
                    <form action="{{ route('applicant.payment-transaction') }}" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="" class="form-label text-sm">APPLICANT NUMBER</label>
                            <input type="text" class="form-control"
                                value="{{ $_applicant ? $_applicant->account->applicant_number : '' }}" disabled>
                        </div>
                        <div class="form-group">
                            <label for="" class="form-label text-sm">APPLICANT NAME</label>
                            <input type="text" class="form-control" name="_name"
                                value="{{ $_applicant ? ucwords($_applicant->first_name . '  ' . $_applicant->last_name) : '' }}"
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
                                <option value="entrance-examination-fee">Entrance Examination
                                </option>
                            </select>
                            @error('_transaction_type')
                                <div class="badge bg-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="" class="form-label text-sm">ATTACH RECEIPT</label>
                            <input type="file" class="form-control" name="_file" accept=".png, .jpeg, .jpg, .pdf"
                                value={{ old('_file') }}>
                            @error('_file')
                                <div class="badge bg-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                        <button class="btn btn-primary w-100" type="submit">SUBMIT</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection

@if (Auth::user()->payment)
    @section('payment-transaction-view')
        <div class="stories-data ">
            <p class="mb-0">
                {{ auth::user()->payment->created_at->format('d, F Y') }}</p>
            <div class="row">
                <div class="col-md">
                    <small>REFERENCE NO: </small> <br>
                    <h5><span class="text-primary">{{ auth::user()->payment->reference_number }}</span>
                    </h5>
                </div>
                <div class="col-md">
                    <small>AMOUNT: </small> <br>
                    <h5><span class="text-primary">{{ number_format(auth::user()->payment->amount_paid) }}</span>
                    </h5>
                </div>
                <div class="col-md">
                    <a href="{{ auth::user()->payment->reciept_attach_path }}" target="_blank"
                        class="btn btn-primary btn-sm">view</a>
                </div>
            </div>
            <div class="d-flex justify-content-between mt-2">

                @if (auth::user()->payment->is_approved === null)
                    <div>
                        <span class="text-info">This payment is
                            under verification of Accounting
                            Office's</span>
                    </div>
                @endif
                @if (auth::user()->payment->is_approved === 0)
                    <div>
                        <span class="text-info">This payment was
                            disapproved because of this Remarks: </span>
                        <span class="text-danger">{{ auth::user()->payment->comment_remarks }}</span>
                    </div>
                @endif
                @if (auth::user()->payment->is_approved == 1)
                    <div>
                        <span class="text-info">This payment was
                            Verified: </span>

                    </div>
                @endif
            </div>
            @if (Auth::user()->payment->is_approved === 0)
                <div class="row">
                    <div class="col-md">
                        <h5 class=" mb-1 fw-bolder text-info">PAYMENT INSTRUCTION</h5>
                        <p>For bank deposit or online fund transfer, please us the bank details
                            below:
                        </p>
                        <div class="row">
                            <div class="col-md-12">
                                <label for="" class="fw-bolder h6 text-muted">SENIOR HIGH
                                    SCHOOL</label><br>
                                <div class="d-inline-block">
                                    <div><small>Bank:</small></div>
                                    <div>
                                        <span class="fw-bolder text-info">LANDBANK OF THE
                                            PHILLIPINES</span>
                                    </div>
                                </div>
                                <div class="d-inline-block">
                                    <div><small>Account Name:</small></div>
                                    <div>
                                        <span class="fw-bolder text-info">BALIWAG MARITIME
                                            FOUNDATION,
                                            INC.</span>
                                    </div>
                                </div>
                                <div class="d-inline-block">
                                    <div><small>Account Number:</small></div>
                                    <div>
                                        <span class="fw-bolder text-info">0102112822</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 mt-3">
                                <label for="" class="fw-bolder h6 text-muted">COLLEGE</label><br>
                                <div class="d-inline-block">
                                    <div><small>Bank:</small></div>
                                    <div>
                                        <span class="fw-bolder text-info">BANK OF COMMERCE</span>
                                    </div>
                                </div>
                                <div class="d-inline-block">
                                    <div><small>Account Name:</small></div>
                                    <div>
                                        <span class="fw-bolder text-info">BALIWAG MARITIME ACADEMY
                                            INC</span>
                                    </div>
                                </div> <br>
                                <div class="d-inline-block">
                                    <div><small>Account Number:</small></div>
                                    <div>
                                        <span class="fw-bolder text-info">062000001037</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <h5 class=" mb-1 fw-bolder">ENTER PAYMENT DETAILS:</h5>
                        <form action="{{ route('applicant.payment-transaction') }}" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="" class="form-label text-sm">APPLICANT NUMBER</label>
                                <input type="text" class="form-control"
                                    value="{{ $_applicant ? $_applicant->account->applicant_number : '' }}" disabled>
                            </div>
                            <div class="form-group">
                                <label for="" class="form-label text-sm">APPLICANT NAME</label>
                                <input type="text" class="form-control" name="_name"
                                    value="{{ ucwords($_applicant->first_name . '  ' . $_applicant->last_name) }}"
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
                                    <option value="entrance-examination-fee">Entrance Examination
                                    </option>
                                </select>
                                @error('_transaction_type')
                                    <div class="badge bg-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="" class="form-label text-sm">ATTACH RECEIPT</label>
                                <input type="file" class="form-control" name="_file" accept=".png, .jpeg, .jpg, .pdf"
                                    value={{ old('_file') }}>
                                @error('_file')
                                    <div class="badge bg-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>
                            <button class="btn btn-primary w-100" type="submit">SUBMIT</button>
                        </form>

                    </div>
                </div>
            @endif
        </div>
    @endsection
@endif
