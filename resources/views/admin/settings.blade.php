@extends('admin.layout')

@section('main')

    <form class="form-group col-xs-12" method="POST" action="/master/settings">
        {!! csrf_field() !!}
        <label>Site name</label>
        <input class="form-control" type="text" name="site_name" value="{{$settings->site_name}}" required>
        <label>Title</label>
        <input class="form-control" type="text" name="title" value="{{$settings->title}}" required>
        <label>Meta keywords</label>
        <input class="form-control" type="text" name="meta_keywords" value="{{$settings->meta_keywords}}" required>
        <label>Meta description</label>
        <input class="form-control" type="text" name="meta_description" value="{{$settings->meta_description}}" required>
        <input type="submit" class="form-control" value="Save">
    </form>

@endsection

@push('style')
<link rel="stylesheet" property='stylesheet' href="/admin/css/settings.min.css">
@endpush

@push('script')
<script type="text/javascript" src="/admin/js/settings.min.js"></script>
@endpush