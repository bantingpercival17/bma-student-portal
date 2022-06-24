@extends('layouts.learning-mode-template')
@php
$_title = 'Lesson';
@endphp
@section('page-title', $_title)
@section('page-content')
    <div class="row">
        <div class="col-md">
            <p class="display-6 text-primary">
                {{ $_subject_lesson['topic'] }}
            </p>
            <div class="card">
                <div class="card-body">
                    <iframe src="{{ $_subject_lesson['presentation'] }}" frameborder="0" width="100%" height="485"
                        allowfullscreen="true" mozallowfullscreen="true" webkitallowfullscreen="true"></iframe>
                    {{-- <iframe src="{{ $_subject_lesson['presentation'] }}" frameborder="0"></iframe> --}}
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <label for="" class="fw-bolder">LESSONS</label>
                </div>
                <div class="card-body">
                    @if (count($_subject_content) > 0)
                        @foreach ($_subject_content as $key => $item)
                            <div class="learning-objective mt-0 p-2">
                                @foreach ($item['learning_outcome'] as $count => $learning_outcome)
                                    <div class="alert alert-left alert-info alert-dismissible fade show"
                                        role="alert">
                                        <a
                                            href="{{ route('academic.subject-lesson') }}?_subject={{ request()->input('_subject') }}_index={{ $key }}&_content={{ $count }}">
                                            <span class="fw-bolder text-nuted">{{ $learning_outcome['topic'] }}</span>
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        @endforeach
                    @else
                        <div class="alert alert-left alert-secondary alert-dismissible fade show" role="alert">
                            This Subject is under maintaince..
                        </div>
                    @endif
                </div>
            </div>

        </div>
    </div>
@endsection
