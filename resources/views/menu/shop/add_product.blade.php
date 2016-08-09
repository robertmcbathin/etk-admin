@extends('layouts.master')
@section('title')
Добавление товара
@endsection
@section('content')
  <div class="page-title">
              <div class="title_left">
                @if ($category !== NULL) 
                <h3>Новый товар в категории <strong>{{ $category->name }}</strong>.</h3>
                @endif
              </div>
            </div>

            <div class="clearfix"></div>

            <div class="row">
            	<div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Добавление товара</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <br />
                    <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" action="{{ route('shop.products.add.post') }}" method="POST" enctype="multipart/form-data">
                      <div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Наименование<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="name" name="name" required="required" class="form-control col-md-7 col-xs-12" size="100" maxlength="255" placeholder="Baldessarini Ambre 50ml">
                        </div>
                      </div>
                      <div class="form-group {{ $errors->has('short_description') ? 'has-error' : ''}}">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="short_description">Описание краткое<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="short_description" name="short_description" required="required" class="form-control col-md-7 col-xs-12" size="200" maxlength="255" placeholder="Коротко и ясно">
                        </div>
                      </div>
                      <div class="form-group {{ $errors->has('long_description') ? 'has-error' : ''}}">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="serie">Описание полное
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <textarea class="form-control" rows="5" placeholder="Здесь должно быть долгое, нудное описание, дочитав которое до конца, покупатель получит критический словесный удар промеж глаз прямо в мозжечок" name="long_description"></textarea>
                        </div>
                      </div>
                       <div class="form-group {{ $errors->has('subcategory_id') ? 'has-error' : ''}}">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="subcategory_id">Подкатегория</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <select class="select2_single form-control select2-hidden-accessible" tabindex="-1" aria-hidden="true" name="subcategory_id">
                          @if ($subcategories !== NULL)
                            @foreach ($subcategories as $subcategory)
                              <option value="{{$subcategory->id}}">{{ $subcategory->name }}</option>
                            @endforeach
                          @endif
                          </select><span class="select2 select2-container select2-container--default select2-container--above" dir="ltr" style="width: 551px;"><span class="selection"><span class="select2-selection select2-selection--single" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="-1" aria-labelledby="select2-ba1p-container"><span class="select2-selection__rendered" id="select2-ba1p-container"><span class="select2-selection__placeholder">Выберите категорию</span></span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span>
                        </div>
                      </div>
                      <hr>
                      <div class="form-group {{ $errors->has('price_by_supplier') ? 'has-error' : ''}}">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="price_by_supplier">Цена (от поставщика) <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="price_by_supplier" name="price_by_supplier" required="required" class="form-control col-md-7 col-xs-12" size="10" maxlength="12" placeholder="600.00">
                        </div>
                      </div>
                      <div class="form-group {{ $errors->has('price') ? 'has-error' : ''}}">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="price">Цена (розничная без карты) <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="price" name="price" required="required" class="form-control col-md-7 col-xs-12" size="10" maxlength="12" placeholder="1000.00">
                        </div>
                      </div>
                      <div class="form-group {{ $errors->has('price_by_card') ? 'has-error' : ''}}">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="price_by_card">Цена (розничная по карте) <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="price_by_card" name="price_by_card" required="required" class="form-control col-md-7 col-xs-12" size="10" maxlength="12" placeholder="900.00">
                        </div>
                      </div>
                      <div class="form-group {{ $errors->has('price_by_action') ? 'has-error' : ''}}">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="price_by_action">Цена (розничная по акции). P.S. Если акция проводится
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="price_by_action" name="price_by_action" class="form-control col-md-7 col-xs-12" size="10" maxlength="12" placeholder="899.00">
                        </div>
                      </div>
                      <div class="form-group {{ $errors->has('price_by_purchase') ? 'has-error' : ''}}">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="price_by_purchase">Цена (по закупке без карты)
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="price_by_purchase" name="price_by_purchase" class="form-control col-md-7 col-xs-12" size="10" maxlength="12" placeholder="800.00">
                        </div>
                      </div>
                      <div class="form-group {{ $errors->has('price_by_purchase_card') ? 'has-error' : ''}}">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="price_by_purchase_card">Цена (по закупке по карте) 
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="price_by_purchase_card" name="price_by_purchase_card" class="form-control col-md-7 col-xs-12" size="10" maxlength="12" placeholder="750.00">
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
                      <div class="form-group {{ $errors->has('in_stock') ? 'has-error' : ''}}">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Статус</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <select class="select2_single form-control select2-hidden-accessible" tabindex="-1" aria-hidden="true" name="in_stock">
                          <option value="1">В наличии</option>
                          <option value="2">На заказ</option>
                          <option value="3">По закупке</option>
                          <option value="4">Снято с продажи</option>
                          </select><span class="select2 select2-container select2-container--default select2-container--above" dir="ltr" style="width: 551px;"><span class="selection"><span class="select2-selection select2-selection--single" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="-1" aria-labelledby="select2-ba1p-container"><span class="select2-selection__rendered" id="select2-ba1p-container"><span class="select2-selection__placeholder">Выберите статус</span></span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span>
                        </div>
                      </div>

                      <div class="form-group {{ $errors->has('priority') ? 'has-error' : ''}}">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Приоритет</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <select class="select2_single form-control select2-hidden-accessible" tabindex="-1" aria-hidden="true" name="priority">
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
                          <input type="text" id="availability" name="availability" class="form-control col-md-7 col-xs-12" size="10" maxlength="12" placeholder="0">
                        </div>
                      </div>
                      <div class="form-group">
                      <div class="checkbox">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">
                              <input type="checkbox" value="" name="published" checked="checked"> Опубликовать
                            </label>
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
