@extends('layouts.master')
@section('title')
Настройки | Пользователи
@endsection
@section('content')
<div class="page-title">
  <div class="title_left">
    <h3>Пользователи</h3>
  </div>
  <div class="title_right">
    <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search"></div>
  </div>
</div>
<div class="clearfix"></div>
<div class="row">
<div class="col-md-12">
<div class="x_panel">
<div class="x_content">
<div class="row">
@foreach ($users as $user)
<div class="col-md-4 col-sm-4 col-xs-12 profile_details">
                        <div class="well profile_view">
                          <div class="col-sm-12">
                            <h4 class="brief"><i>{{ $user->post }}</i></h4>
                            <div class="left col-xs-7">
                              <h2>{{ $user->first_name }} {{ $user->second_name }}</h2>
                              <ul class="list-unstyled">
                                <li><i class="fa fa-building"></i> Email: </li>
                                <li><i class="fa fa-phone"></i> Телефон: </li>
                              </ul>
                            </div>
                            <div class="right col-xs-5 text-center">
                              <img src="{{ URL::to('/src/images/employees/' . $user->username . '.jpg') }}" alt="" class="img-circle img-responsive">
                            </div>
                          </div>
                          <div class="col-xs-12 bottom text-center">
                            <div class="col-xs-12 col-sm-6 emphasis">
                            </div>
                            <div class="col-xs-12 col-sm-6 emphasis">
                              <button type="button" class="btn btn-primary btn-xs">
                                <i class="fa fa-user"> </i> Профиль
                              </button>
                            </div>
                          </div>
                        </div>
                      </div>
@endforeach
</div>
</div>
</div>
</div>
</div>
<div class="clearfix"></div>

<div class="row"></div>
<div class="clearfix"></div>
@endsection