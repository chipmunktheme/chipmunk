@extends('layouts.app')

@section('view')
  @include('partials.page-header')

  @noposts
    <x-alert type="warning">
      {!! __('Sorry, no results were found.', 'chipmunk') !!}
    </x-alert>

    {!! get_search_form(false) !!}
  @endnoposts

  @posts
    @includeFirst(['partials.content-' . get_post_type(), 'partials.content'])
  @endposts

  {!! get_the_posts_navigation() !!}
@endsection

@section('sidebar')
  @include('sections.sidebar')
@endsection
