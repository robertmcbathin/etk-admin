@extends('layouts.master')
@section('title')
Изменение товара
@endsection
@section('content')
  <div class="page-title">
              <div class="title_left">
                @if ($category !== NULL) 
                <h3>Изменение товара в категории <strong>{{ $category->name }}</strong>.</h3>
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
                    <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" action="/shop/products/{{$product->id}}/edit" method="POST" enctype="multipart/form-data">
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
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="serie">Описание полное
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <textarea class="form-control" rows="5" placeholder="" name="long_description">{{ $product->long_description }}</textarea>
                        </div>
                      </div>
                       <hr>
                        <div class="form-group {{ $errors->has('keywords') ? 'has-error' : ''}}">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="keywords">Ключевые слова
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="keywords" name="keywords" class="form-control col-md-7 col-xs-12" size="200" maxlength="255" value="{{ $product->keywords }}">
                        </div>
                      </div>
                      <div class="form-group {{ $errors->has('description') ? 'has-error' : ''}}">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="description">Описание
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="description" name="description" class="form-control col-md-7 col-xs-12" size="200" maxlength="255" value="{{ $product->description }}">
                        </div>
                      </div>
                      <hr>
                       <div class="form-group {{ $errors->has('subcategory_id') ? 'has-error' : ''}}">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="subcategory_id">Подкатегория</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <select class="select2_single form-control select2-hidden-accessible" tabindex="-1" aria-hidden="true" name="subcategory_id" value="{{ $product->subcategory_id }}">
                          @if ($subcategories !== NULL)
                             <option value="{{$product->subcategory_id}}">Выберите категорию (по умолчанию {{$product->subcategory_id}})</option>
                            @foreach ($subcategories as $subcategory)
                              <option value="{{$subcategory->id}}">{{ $subcategory->name }} ({{$subcategory->id}})</option>
                            @endforeach
                          @endif
                          </select><span class="select2 select2-container select2-container--default select2-container--above" dir="ltr" style="width: 551px;"><span class="selection"><span class="select2-selection select2-selection--single" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="-1" aria-labelledby="select2-ba1p-container"><span class="select2-selection__rendered" id="select2-ba1p-container"><span class="select2-selection__placeholder">Выберите категорию</span></span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Теги</label>
                      <div class="col-md-9 col-sm-9 col-xs-12">
                          <input id="tags_1" type="text" class="tags form-control" value="social, adverts, sales" data-tagsinput-init="true" style="display: none;"><div id="tags_1_tagsinput" class="tagsinput" style="width: auto; min-height: 100px; height: 100px;">
                          @if ($tags !== NULL)
                            @foreach ($tags as $tag)
                              <span class="tag">
                                <span>{{ $tag->name }}&nbsp;&nbsp;</span>
                                <a href="{{ route('shop.tags.remove.post',['tag_id' => $tag->id, 'product_id' => $product->id]) }}" title="Removing tag">x</a>
                              </span>
                            @endforeach
                          @endif
                          
                        </div>
                      </div>
                    </div>
                          
                      <hr>
                      <div class="form-group {{ $errors->has('price_by_supplier') ? 'has-error' : ''}}">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="price_by_supplier">Цена (от поставщика) <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="price_by_supplier" name="price_by_supplier" required="required" class="form-control col-md-7 col-xs-12" size="10" maxlength="12" placeholder="600.00" value="{{$product->price_by_supplier}}">
                        </div>
                      </div>
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
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <input type="text" id="path_to_img" name="path_to_img" class="form-control col-md-7 col-xs-12" size="100" maxlength="255" placeholder="http://path.to/img.jpg" value="{{ $product->path_to_img }}">
                        </div><br>
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="image">Или загрузите файл 
                        </label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <input type="file" id="image" name="image" class="form-control col-md-7 col-xs-12" size="100" maxlength="255" >
                        </div>
                      </div>
                      <hr>
                      <div class="form-group {{ $errors->has('in_stock') ? 'has-error' : ''}}">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Статус</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <select class="select2_single form-control select2-hidden-accessible" tabindex="-1" aria-hidden="true" name="in_stock" value="{{ $product->in_stock }}">
                          <option value="{{$product->in_stock}}">Выберите статус товара (сейчас статус = {{$product->in_stock}})</option>
                          <option value="1">В наличии (1)</option>
                          <option value="2">На заказ (2)</option>
                          <option value="3">По закупке (3)</option>
                          <option value="4">Снято с продажи (4)</option>
                          </select><span class="select2 select2-container select2-container--default select2-container--above" dir="ltr" style="width: 551px;"><span class="selection"><span class="select2-selection select2-selection--single" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="-1" aria-labelledby="select2-ba1p-container"><span class="select2-selection__rendered" id="select2-ba1p-container"><span class="select2-selection__placeholder">Выберите статус</span></span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span>
                        </div>
                      </div>
                      <div class="form-group {{ $errors->has('priority') ? 'has-error' : ''}}">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Приоритет</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <select class="select2_single form-control select2-hidden-accessible" tabindex="-1" aria-hidden="true" name="priority" value="{{ $product->priority }}">
                          <option value="{{ $product->priority }}">Выберите приоритет при просмотре в интернет-магазине ({{ $product->priority }})</option>
                          <option value="1">1</option>
                          <option value="2">2</option>
                          <option value="3">3</option>
                          <option value="4">4</option>
                          </select><span class="select2 select2-container select2-container--default select2-container--above" dir="ltr" style="width: 551px;"><span class="selection"><span class="select2-selection select2-selection--single" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="-1" aria-labelledby="select2-ba1p-container"><span class="select2-selection__rendered" id="select2-ba1p-container"><span class="select2-selection__placeholder">Выберите приоритет</span></span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span>
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

                <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" action="/shop/product/{{$product->id}}/tags/add" method="POST">
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Выберите теги</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <select class="select2_single form-control select2-hidden-accessible" tabindex="-1" aria-hidden="true" name="tag_id">
                            @if ($available_tags !== NULL)
                                 @foreach ($available_tags as $available_tag)
                                   <option value="{{$available_tag->id}}">{{ $available_tag->name }} </option>
                                 @endforeach
                               @endif
                          </select><span class="select2 select2-container select2-container--default select2-container--below" dir="ltr" style="width: 551px;"><span class="selection"><span class="select2-selection select2-selection--single" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="-1" aria-labelledby="select2-f8xs-container"><span class="select2-selection__rendered" id="select2-f8xs-container"><span class="select2-selection__placeholder">Выберите теги</span></span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span>
                        </div>
                      </div>
                      {{ csrf_field() }}
                      <input type="hidden" value="{{$product->id}}" name="product_id">
                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                          <button type="submit" class="btn btn-success">Добавить тег</button>
                        </div>
                      </div>
                    </form>
@endsection
