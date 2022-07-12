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
                    <form id="form-wizard1" class="mt-3" action="{{ route('applicant.examination-store') }}" method="post">
                        @csrf
                        @foreach ($_examinations as $key_question => $category)
                            <div class="form-group">
                                {{-- Questioner --}}
                                <p class="fw-bolder mb-0">
                                    @if ($category->question != 'none')
                                        @php
                                            echo $key_question + 1 . '. ' . $category->question->question;
                                        @endphp
                                    @else
                                        @php
                                            $_question_count = $key_question + 1;
                                            echo $_question_count . '. Question ' . $_question_count;
                                        @endphp
                                    @endif
                                </p>
                                {{-- Image Question --}}
                                @if ($category->question->image_path != 'none' && $category->question->image_path != null)
                                    <img class="img-fluid"
                                        src="{{ asset('assets/image/questions/' . str_replace('http:bma.edu.ph/assests/image/questions/', '', $category->question->image_path)) }}"
                                        alt="">
                                @endif
                                <div class="question-choices mt-0">
                                    <div class="form-group">
                                        <input type="hidden" name="question[]" value="{{ $category->question->id }}">
                                        @foreach ($category->question->choices as $choices)
                                            <div class="form-check d-block">

                                                <input class="form-check-input" type="radio"
                                                    name="{{ base64_encode($category->question->id) }}"
                                                    id="choices_{{ $choices->id }}" value="{{ $choices->id }}"
                                                    {{ old(base64_encode($category->question->id)) == $choices->id ? 'checked' : '' }}>
                                                <label class="form-check-label" for="choices_{{ $choices->id }}">
                                                    @php
                                                        echo $choices->choice_name;
                                                    @endphp
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>

                            </div>
                        @endforeach
                        <button type="submit" class="btn btn-primary next action-button float-end">Submit</button>

                    </form>
                </div>
            </div>
        </div>
    </div>
@section('js')
    {{-- <script>
        var timer = "{{ Auth::user()->examination->created_at }}";
    </script>
    <script src="{{ asset('js/script.js') }}">

    </script> --}}
@endsection

@endsection
