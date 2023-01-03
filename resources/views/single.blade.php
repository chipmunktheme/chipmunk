@extends('layouts.app')

@section('view')
  @posts
    @includeFirst(['partials.content-single-' . get_post_type(), 'partials.content-single'])
  @endposts
@endsection
