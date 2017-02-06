@extends('layouts.master')
@section('title')
Добавление новости
@endsection
@section('content')
  <div class="page-title">
              <div class="title_left">
                <h3>Новая запись</h3>
              </div>
            </div>

            <div class="clearfix"></div>

            <div class="row">
            	<div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_content">
                    <br />
                    <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" action="{{ route('etk.articles.add.post') }}" method="POST">
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="article_title">Заголовок<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="article_title" name="article_title" required="required" class="form-control col-md-7 col-xs-12" size="50" maxlength="255">
                        </div>
                      </div>
                      <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="article_short_content">Содержание краткое<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="article_short_content" name="article_short_content" required="required" class="form-control col-md-7 col-xs-12" size="50" maxlength="255">
                        </div>
                      </div>
                      <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="article_content">Содержание полное<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="article_content" name="article_content" required="required" class="form-control col-md-7 col-xs-12" size="50" maxlength="255">
                        </div>
                      </div>
                      <hr>
                      <div class="form-group {{ $errors->has('path_to_img') ? 'has-error' : ''}}">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="path_to_img">Изображение основное (путь к нему) 
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
                      <div class="form-group {{ $errors->has('path_to_thumbnail') ? 'has-error' : ''}}">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="path_to_thumbnail">Thumbnail (путь к нему) 
                        </label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <input type="text" id="path_to_thumbnail" name="path_to_thumbnail" class="form-control col-md-7 col-xs-12" size="100" maxlength="255" placeholder="http://path.to/img.jpg">
                        </div><br>
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="image">Или загрузите файл 
                        </label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <input type="file" id="thumbnail" name="thumbnail" class="form-control col-md-7 col-xs-12" size="100" maxlength="255" >
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
                <div class="clearfix"></div>
            </div>
@endsection
