@extends('layouts.app')

@section('view')
  <x-section type="double">
    @include('partials.page-header')

    @if (! have_posts())
      <x-alert type="warning">
        {!! __('Sorry, but the page you are trying to view does not exist.', 'chipmunk') !!}
      </x-alert>

      {!! get_search_form(false) !!}
    @endif
  </x-section>
@endsection
