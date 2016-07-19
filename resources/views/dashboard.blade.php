@extends('layouts.master')
@section('title')
ETK-Admin
@endsection
@section('content')
<h1>{{ $user->USERNAME }}</h1>
<?php var_dump($user) ?>
@endsection
