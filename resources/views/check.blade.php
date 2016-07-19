@extends('layouts.master')
@section('title')
ETK-Admin
@endsection
@section('content')
<div class="col-md-12">
	<h1>{{ $username }}</h1>
	<h1>{{ $status }}</h1>
	<h1>{{ $b_inputed_password }}</h1>
	<h1>{{ $db_username }}</h1>
	<h1>{{ $db_password }}</h1>
</div>
@endsection
