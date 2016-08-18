@extends('layouts.master')
@section('title')
Добавление производителя
@endsection
@section('content')
  <div class="page-title">
              <div class="title_left">
                              <h3>Новый производитель</h3>
              </div>
            </div>

            <div class="clearfix"></div>

            <div class="row">
            	<div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Добавление производителя</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <br />
                    <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" action="{{ route('shop.manufacturers.add.post') }}" method="POST" enctype="multipart/form-data">
                      <div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Наименование<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="name" name="name" required="required" class="form-control col-md-7 col-xs-12" size="50" maxlength="50" placeholder="Название производителя">
                        </div>
                      </div>
                      <div class="form-group {{ $errors->has('address') ? 'has-error' : ''}}">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="address">Адрес<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="short_description" name="address" required="required" class="form-control col-md-7 col-xs-12" size="100" maxlength="255" placeholder="Город, улица, дом">
                        </div>
                      </div>

                      {{ csrf_field() }}
                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                          <button type="submit" class="btn btn-primary">Отмена</button>
                          <button type="submit" class="btn btn-success">Создать</button>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
              <div class="clearfix"></div>
            </div>
            <div class="row"></div>
               @if($alert_title !== '')
                 <div class="alert {{ $alert_type }} alert-dismissible fade in" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                    </button>
                    <strong>{{ $alert_title }}</strong> {{ $alert_text }}
                  </div>
              @endif 
                <div class="clearfix"></div>
@endsection
