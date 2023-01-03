{{--
  Template Name: Custom Template
--}}

@extends('layouts.app')

@section('view')
  @while(have_posts()) @php(the_post())
    @include('partials.page-header')
    @include('partials.content-page')
  @endwhile
@endsection
