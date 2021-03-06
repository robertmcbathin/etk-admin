@extends('layouts.master')
@section('title')
Редактирование пользователя
@endsection
@section('content')
  <div class="page-title">
              <div class="title_left">
                @if ($category !== NULL) 
                <h3>Редактирование пользователя <small></small></h3>
                @endif
              </div>
            </div>

            <div class="clearfix"></div>

            <div class="row">
            	<div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Изменение товара №{{ $product->id }} <small>Создан:<strong>{{$product->created_at}}</strong> Последнее изменение: <strong>{{ $product->updated_at }}</strong> Рейтинг: <strong>{{ $product->rating_cache }}</strong> Отзывов: <strong>{{ $product->rating_count }}</strong></small></h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <br />
                    <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" action="/shop/products/{{$product->id}}/edit" method="POST">
                      <div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name" >Наименование<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="name" name="name" required="required" class="form-control col-md-7 col-xs-12" size="100" maxlength="255" placeholder="" value="{{ $product->name }}">
                        </div>
                      </div>
                      <div class="form-group {{ $errors->has('short_description') ? 'has-error' : ''}}">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="short_description">Описание краткое<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="short_description" name="short_description" required="required" class="form-control col-md-7 col-xs-12" size="200" maxlength="255" placeholder="" value="{{ $product->short_description }}">
                        </div>
                      </div>
                      <div class="form-group {{ $errors->has('long_description') ? 'has-error' : ''}}">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="serie">Описание полное<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <textarea class="form-control" rows="5" placeholder="" name="long_description">{{ $product->long_description }}</textarea>
                        </div>
                      </div>
                       <div class="form-group {{ $errors->has('subcategory_id') ? 'has-error' : ''}}">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="subcategory_id">Подкатегория</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <select class="select2_single form-control select2-hidden-accessible" tabindex="-1" aria-hidden="true" name="subcategory_id" {{ $product->short_description }}>
                          @if ($subcategories !== NULL)
                            @foreach ($subcategories as $subcategory)
                              <option value="{{$subcategory->id}}">{{ $subcategory->name }}</option>
                            @endforeach
                          @endif
                          </select><span class="select2 select2-container select2-container--default select2-container--above" dir="ltr" style="width: 551px;"><span class="selection"><span class="select2-selection select2-selection--single" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="-1" aria-labelledby="select2-ba1p-container"><span class="select2-selection__rendered" id="select2-ba1p-container"><span class="select2-selection__placeholder">Выберите категорию</span></span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span>
                        </div>
                      </div>
                      <hr>
                      <div class="form-group {{ $errors->has('price') ? 'has-error' : ''}}">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="price">Цена (розничная без карты) <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="price" name="price" required="required" class="form-control col-md-7 col-xs-12" size="10" maxlength="12" placeholder="1000.00" value="{{ $product->price }}">
                        </div>
                      </div>
                      <div class="form-group {{ $errors->has('price_by_card') ? 'has-error' : ''}}">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="price_by_card">Цена (розничная по карте) <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="price_by_card" name="price_by_card" required="required" class="form-control col-md-7 col-xs-12" size="10" maxlength="12" placeholder="900.00" value="{{ $product->price_by_card }}">
                        </div>
                      </div>
                      <div class="form-group {{ $errors->has('price_by_action') ? 'has-error' : ''}}">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="price_by_action">Цена (розничная по акции). P.S. Если акция проводится
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="price_by_action" name="price_by_action" class="form-control col-md-7 col-xs-12" size="10" maxlength="12" placeholder="" value="{{ $product->price_by_action }}">
                        </div>
                      </div>
                      <div class="form-group {{ $errors->has('price_by_purchase') ? 'has-error' : ''}}">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="price_by_purchase">Цена (по закупке без карты)
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="price_by_purchase" name="price_by_purchase" class="form-control col-md-7 col-xs-12" size="10" maxlength="12" placeholder="" value="{{ $product->price_by_purchase }}">
                        </div>
                      </div>
                      <div class="form-group {{ $errors->has('price_by_purchase_card') ? 'has-error' : ''}}">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="price_by_purchase_card">Цена (по закупке по карте) 
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="price_by_purchase_card" name="price_by_purchase_card" class="form-control col-md-7 col-xs-12" size="10" maxlength="12" placeholder="750.00" value="{{ $product->price_by_purchase_card }}">
                        </div>
                      </div>
                      <hr>
                      <img src="{{ $product->path_to_img }}" alt="" height="300">
                      <div class="form-group {{ $errors->has('path_to_img') ? 'has-error' : ''}}">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="path_to_img">Изображение (путь к нему) 
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="path_to_img" name="path_to_img" class="form-control col-md-7 col-xs-12" size="100" maxlength="255" placeholder="http://path.to/img.jpg" value="{{ $product->path_to_img }}">
                        </div>
                      </div>
                      <hr>
                      <div class="form-group {{ $errors->has('in_stock') ? 'has-error' : ''}}">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Статус</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <select class="select2_single form-control select2-hidden-accessible" tabindex="-1" aria-hidden="true" name="in_stock" value="{{ $product->in_stock }}">
                          <option value="1">В наличии</option>
                          <option value="2">На заказ</option>
                          <option value="3">По закупке</option>
                          <option value="4">Снято с продажи</option>
                          </select><span class="select2 select2-container select2-container--default select2-container--above" dir="ltr" style="width: 551px;"><span class="selection"><span class="select2-selection select2-selection--single" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="-1" aria-labelledby="select2-ba1p-container"><span class="select2-selection__rendered" id="select2-ba1p-container"><span class="select2-selection__placeholder">Выберите статус</span></span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span>
                        </div>
                      </div>

                      <hr>
                      <div class="form-group {{ $errors->has('availability') ? 'has-error' : ''}}">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="availability">На складе (количество) 
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="availability" name="availability" class="form-control col-md-7 col-xs-12" size="10" maxlength="12" placeholder="" value="{{ $product->availability }}">
                        </div>
                      </div>
                      <input type="hidden" value="{{ $product->id }}" name="product_id">
                      {{ csrf_field() }}
                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                          <button type="submit" class="btn btn-primary">Отмена</button>
                          <button type="submit" class="btn btn-success">Сохранить изменения</button>
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
