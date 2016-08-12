@extends('layouts.master')
@section('title')
Добавление баннера
@endsection
@section('content')
  <div class="page-title">
              <div class="title_left">
                <h3>Новый баннер</h3>
              </div>
            </div>

            <div class="clearfix"></div>

            <div class="row">
            	<div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Добавление баннера</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <br />
                    <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" action="{{ route('shop.banners.add.post') }}" method="POST" enctype="multipart/form-data">
                      <div class="form-group {{ $errors->has('title') ? 'has-error' : ''}}">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Заголовок<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="title" name="title" required="required" class="form-control col-md-7 col-xs-12" size="45" maxlength="45" placeholder="Только до конца месяца!">
                        </div>
                      </div>
                      <div class="form-group {{ $errors->has('description') ? 'has-error' : ''}}">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="description">Описание<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="description" name="description" required="required" class="form-control col-md-7 col-xs-12" size="255" maxlength="255" placeholder="Распродажа всякого хлама со склада!">
                        </div>
                      </div>
                       <div class="form-group {{ $errors->has('show_in') ? 'has-error' : ''}}">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="subcategory_id">Показывать в разделе</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <select class="select2_single form-control select2-hidden-accessible" tabindex="-1" aria-hidden="true" name="show_in">
                              <option value="-1">Выберите раздел для показа баннера</option>
                              <option value="0">Не показывать вообще (0)</option>
                              <option value="1">Интернет-магазин (1)</option>
                              <option value="2">Совместные покупки (2)</option>
                          </select><span class="select2 select2-container select2-container--default select2-container--above" dir="ltr" style="width: 551px;"><span class="selection"><span class="select2-selection select2-selection--single" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="-1" aria-labelledby="select2-ba1p-container"><span class="select2-selection__rendered" id="select2-ba1p-container"><span class="select2-selection__placeholder">Выберите раздел для показа</span></span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span>
                        </div>
                      </div>
                      <hr>
                      <div class="form-group {{ $errors->has('path_to_img') ? 'has-error' : ''}}">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="path_to_img">Изображение (путь к нему) 
                        </label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <input type="text" id="path_to_img" name="path_to_img" class="form-control col-md-7 col-xs-12" size="100" maxlength="255" placeholder="http://path.to/img.jpg">
                        </div><br>
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="image">Или загрузите файл 
                        </label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <input type="file" id="image" name="image" class="form-control col-md-7 col-xs-12" size="100" maxlength="255" >
                        </div>
                      </div>
                      <hr>
                      <div class="form-group {{ $errors->has('order') ? 'has-error' : ''}}">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Приоритет показа</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <select class="select2_single form-control select2-hidden-accessible" tabindex="-1" aria-hidden="true" name="order">
                          <option value="1">1</option>
                          <option value="2">2</option>
                          <option value="3">3</option>
                          <option value="4">4</option>
                          <option value="1">5</option>
                          <option value="2">6</option>
                          <option value="3">7</option>
                          <option value="4">8</option>
                          </select><span class="select2 select2-container select2-container--default select2-container--above" dir="ltr" style="width: 551px;"><span class="selection"><span class="select2-selection select2-selection--single" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="-1" aria-labelledby="select2-ba1p-container"><span class="select2-selection__rendered" id="select2-ba1p-container"><span class="select2-selection__placeholder">Выберите приоритет</span></span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span>
                        </div>
                      </div>
                      <input type="hidden" name="created_by" value="{{ Auth::user()->id }}">
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
