@extends('pages.applicant.examination-layout.examination-template')
@php
$_title = 'Entrance Examination - Baliwag Maritime Academy';
@endphp
@section('page-title', $_title)
@section('page-content')
    <div class="row mt-5">
        <div class="col-sm-12 col-lg-12">
            <div class="card">
                <div class="card-body">
                    <form id="form-wizard1" class="text-center mt-3" action="{{ route('applicant.examination-store') }}"
                        method="post">
                        @csrf
                        <ul id="top-tab-list" class="p-0 row list-inline">
                            @foreach ($_examination->distinct_categories() as $key => $item)
                                <li id="personal"
                                    class="col-lg-3 col-md-6 mb-2 text-center {{ $key == 0 ? 'active' : '' }}">
                                    <a href="javascript:void();">
                                        <div class="iq-icon me-3">
                                            <svg height="20" width="20" fill="none" viewBox="0 0 24 24"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                    d="M14.7379 2.76175H8.08493C6.00493 2.75375 4.29993 4.41175 4.25093 6.49075V17.2037C4.20493 19.3167 5.87993 21.0677 7.99293 21.1147C8.02393 21.1147 8.05393 21.1157 8.08493 21.1147H16.0739C18.1679 21.0297 19.8179 19.2997 19.8029 17.2037V8.03775L14.7379 2.76175Z"
                                                    stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                                    stroke-linejoin="round"></path>
                                                <path
                                                    d="M14.4751 2.75V5.659C14.4751 7.079 15.6231 8.23 17.0431 8.234H19.7981"
                                                    stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                                    stroke-linejoin="round"></path>
                                                <path d="M14.2882 15.3584H8.88818" stroke="currentColor" stroke-width="1.5"
                                                    stroke-linecap="round" stroke-linejoin="round"></path>
                                                <path d="M12.2432 11.606H8.88721" stroke="currentColor" stroke-width="1.5"
                                                    stroke-linecap="round" stroke-linejoin="round"></path>
                                            </svg>
                                        </div>
                                        <br>
                                        <span class="mt-4">{{ $item->subject_name }}</span>
                                    </a>
                                </li>
                            @endforeach

                        </ul>
                        @foreach ($_examination->distinct_categories() as $key_form => $category)
                            <fieldset>
                                <div class="form-card text-start">
                                    <div class="row">
                                        <div class="col-7">
                                            <h3 class="mb-4 fw-bolder">{{ $category->subject_name }}</h3>
                                        </div>
                                    </div>

                                    @foreach ($_examination->categories as $_category)
                                        @if ($category->subject_name == $_category->subject_name)
                                            <div class="category mt-5">
                                                <p class="fw-bolder h4 text-primary">{{ $_category->category_name }}</p>
                                                <span class="text-muted h6">
                                                    @php
                                                        echo $_category->instruction;
                                                    @endphp
                                                </span>
                                                <div class="mt-5">
                                                    @foreach ($_category->questions as $key_question => $question)
                                                        <div class="form-group">
                                                            {{-- Questioner --}}
                                                            <p class="fw-bolder mb-0">
                                                                @if ($question->question != 'none')
                                                                    @php
                                                                        echo $key_question + 1 . '. ' . $question->question;
                                                                    @endphp
                                                                @else
                                                                    @php
                                                                        $_question_count = $key_question + 1;
                                                                        echo $_question_count . '. Question ' . $_question_count;
                                                                    @endphp
                                                                @endif
                                                            </p>
                                                            {{-- Image Question --}}
                                                            @if ($question->image_path != 'none' && $question->image_path != null)
                                                                <img style="width:50%; height:50%;"
                                                                    src="{{ asset('assets/image/questions/' . $question->image_path) }}"
                                                                    alt="">
                                                            @endif
                                                            <div class="question-choices ">
                                                                <div class="form-group">
                                                                    @foreach ($question->choices as $choices)
                                                                        <div class="form-check d-block">
                                                                            <input class="form-check-input" type="radio"
                                                                                name="{{ base64_encode($question->id) }}"
                                                                                id="choices_{{ $choices->id }}"
                                                                                value="{{ $choices->id }}"
                                                                                {{ old(base64_encode($question->id)) == $choices->id ? 'checked' : '' }}>
                                                                            <label class="form-check-label"
                                                                                for="choices_{{ $choices->id }}">
                                                                                {{ $choices->choice_name }}
                                                                            </label>
                                                                        </div>
                                                                    @endforeach
                                                                </div>
                                                            </div>

                                                            @error(base64_encode($question->id))
                                                                <span class="mt-2 badge bg-danger">This field is required</span>
                                                            @enderror
                                                        </div>
                                                    @endforeach
                                                </div>

                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                                @if ($key_form > 0)
                                    @if ($key_form == count($_examination->distinct_categories()) - 1)
                                        <button type="submit"
                                            class="btn btn-primary next action-button float-end">Submit</button>
                                        <button type="button" name="previous"
                                            class="btn btn-info previous text-white action-button-previous float-end me-1"
                                            value="Previous">Previous</button>
                                    @else
                                        <button type="button" name="next"
                                            class="btn btn-primary next action-button float-end" value="Next">Next</button>
                                        <button type="button" name="previous"
                                            class="btn btn-info previous text-white action-button-previous float-end me-1"
                                            value="Previous">Previous</button>
                                    @endif
                                @else
                                    <button type="button" name="next" class="btn btn-primary next action-button float-end"
                                        value="Next">Next</button>
                                @endif

                            </fieldset>
                        @endforeach
                     {{--    @foreach ($errors->all() as $item)
                            <span class="me-2 badge bg-danger">{{ $item }}</span>
                        @endforeach --}}
                    </form>
                </div>
            </div>
        </div>
    </div>


@endsection
