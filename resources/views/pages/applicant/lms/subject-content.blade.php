@extends('layouts.applicant-learning-mode-template')
@php
$_title = 'Subject Class';
@endphp
@section('page-title', $_title)
@section('page-content')
    <div class="row">
        <div class="col-md">
            @if (count($_subject_content) > 0)
                @foreach ($_subject_content as $key => $item)
                    <div class="learning-objective mt-0 p-2">
                        <h4 class="card-title text-primary">{{ $item['course_objective'] }}</h4>
                        <ul class="navbar-nav iq-main-menu" id="sidebar-menu">
                            @foreach ($item['learning_outcome'] as $count => $learning_outcome)
                                <li class="nav-item">
                                    <div class="alert alert-left alert-secondary alert-dismissible fade show" role="alert">
                                        <a class="nav-link" data-bs-toggle="collapse"
                                            href="#learning-content-{{ $key . '-' . $count }}" role="button"
                                            aria-expanded="false"
                                            aria-controls="learning-content-{{ $key . '-' . $count }}">
                                            <span class="item-name text-black">{{ $learning_outcome['lo'] }}</span>
                                            <i class="right-icon">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="18" fill="none"
                                                    viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M9 5l7 7-7 7" />
                                                </svg>
                                            </i>
                                        </a>
                                    </div>
                                    <div class=" card sub-nav collapse" id="learning-content-{{ $key . '-' . $count }}"
                                        data-bs-parent="#sidebar">
                                        <div class="card-body">
                                            <a href="{{ route('academic.subject-lesson') }}?_subject={{request()->input('_subject')}}&_index={{ $key }}&_content={{ $count }}"
                                                class=""> <span
                                                    class="fw-bolder h5">{{ $learning_outcome['topic'] }}</span>
                                                <small>VIEW</small> </a>
                                            <div class="card-title">Assessment</div>
                                        </div>
                                    </div>

                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endforeach
            @else
                <div class="alert alert-left alert-secondary alert-dismissible fade show" role="alert">
                    This Subject is under maintaince..
                </div>
            @endif

        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <label for="" class="fw-bolder">ANNOUNCEMENT</label>
                </div>
                <div class="card-body"></div>
            </div>
            <div class="card">
                <div class="card-header">
                    <label for="" class="fw-bolder">UPCOMING DEADLINE</label>
                </div>
                <div class="card-body"></div>
            </div>
        </div>
    </div>
@endsection
