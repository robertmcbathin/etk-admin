@extends('layouts.master')
@section('title')
Добавление карты
@endsection
@section('content')
  <div class="page-title">
              <div class="title_left">
                <h3>Новая карта</h3>
              </div>
              <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                  <div class="input-group">
                    <input type="text" class="form-control" placeholder="Поиск...">
                    <span class="input-group-btn">
                      <button class="btn btn-default" type="button">Искать</button>
                    </span>
                  </div>
                </div>
              </div>
            </div>

            <div class="clearfix"></div>

            <div class="row">
            	<div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Добавление карты</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <br />
                    <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" action="{{ route('club.cards.add.post') }}" method="POST">
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="serie">Серия<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="serie" name="card_serie" required="required" class="form-control col-md-7 col-xs-12" size="3" maxlength="3">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="num">Номер<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="num" name="card_number" required="required" class="form-control col-md-7 col-xs-12" size="9" maxlength="15">
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
            </div>
@endsection
