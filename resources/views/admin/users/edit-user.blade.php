@extends('admin.layout')

@section('main')

    @if(Session::has('success'))
        <div class="alert alert-success col-xs-12" role="alert">{{ Session::get('success') }}</div>
    @endif

    @include('errors.form-errors')

    @if ($title !== 'User add')
        <form class="col-xs-12" method="POST" action="/master/users/edit/{{$post->id}}">
    @else
        <form class="col-xs-12" method="POST" action="/master/users/add">
    @endif
        {!! csrf_field() !!}
        <label>Name</label>
        <input type="text" name="name" value="{{$post->name}}" class="form-control" required>
        <label>E-mail</label>
        <input type="email" name="email" value="{{$post->email}}" class="form-control" required>
        <label>Password</label>
        <input type="password" name="password" class="form-control">
        <input type="submit" value="Save" class="form-control btn-success">
    </form>

@endsection

@push('style')
<link rel="stylesheet" property='stylesheet' href="/admin/css/edit-user.min.css">
@endpush

@push('script')
<script type="text/javascript" src="/admin/js/edit-user.min.js"></script>
@endpush