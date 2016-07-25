@extends('layouts.master')
@section('title')
Добавление подкатегории
@endsection
@section('content')
  <div class="page-title">
              <div class="title_left">
                <h3>Новая подкатегория</h3>
              </div>
            </div>

            <div class="clearfix"></div>

            <div class="row">
            	<div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Добавление подкатегории</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <br />
                    <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" action="{{ route('shop.categories.subcategory.add.post') }}" method="POST">
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="serie">Название<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="subcategory_name" name="subcategory_name" required="required" class="form-control col-md-7 col-xs-12" size="50" maxlength="255">
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Категория</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <select class="select2_single form-control select2-hidden-accessible" tabindex="-1" aria-hidden="true" name="category_name">
                          @if ($categories !== '')
                            @foreach ($categories as $category)
                              <option value="{{$category->name}}">{{ $category->name }}</option>
                            @endforeach
                          @endif
                          </select><span class="select2 select2-container select2-container--default select2-container--above" dir="ltr" style="width: 551px;"><span class="selection"><span class="select2-selection select2-selection--single" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="-1" aria-labelledby="select2-ba1p-container"><span class="select2-selection__rendered" id="select2-ba1p-container"><span class="select2-selection__placeholder">Выберите категорию</span></span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span>
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
