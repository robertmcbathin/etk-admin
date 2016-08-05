@extends('layouts.master')
@section('title')
Магазин | Товары
@endsection
@section('content')
<div class="page-title">
  <div class="title_left">
    <h3>Товары</h3>
  </div>
  <div class="title_right">
    <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search"></div>
  </div>
</div>
@foreach ($categories as $category)
<div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2><i class="fa fa-align-left"></i> {{ $category->name }} </h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">

                    <!-- start accordion -->
                    <div class="accordion" id="accordion" role="tablist" aria-multiselectable="true">
                      @foreach ($subcategories as $subcategory)
                        @if ($subcategory->category_id == $category->id)
                      <div class="panel">
                        <a class="panel-heading collapsed" role="tab" id="heading{{ $subcategory->id }}" data-toggle="collapse" data-parent="#accordion" href="#collapse{{ $subcategory->id }}" aria-expanded="false" aria-controls="collapseOne">
                          <h4 class="panel-title">{{ $subcategory->name }}</h4>
                        </a>
                        <div id="collapse{{ $subcategory->id }}" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading{{ $subcategory->id }}" aria-expanded="false" style="height: 0px;">
                          <div class="panel-body">
                            <div class="table-responsive">
                <table class="table table-striped jambo_table bulk_action">
                  <thead>
                    <tr class="headings">
                      <th class="column-title">#</th>
                      <th class="column-title">Наименование</th>
                      <th class="column-title">Изображение</th>
                      <th class="column-title">Цена (розница)</th>
                      <th class="column-title">Цена (по карте)</th>
                      <th class="column-title">Наличие</th>
                      <th class="column-title">На складе</th>
                      <th class="column-title">Опубликовано</th>
                      <th class="column-title no-link last">
                        <span class="nobr">Действие</span>
                      </th>
                      <th class="bulk-actions" colspan="7">
                        <a class="antoo" style="color:#fff; font-weight:500;">
                          Bulk Actions (
                          <span class="action-cnt"></span>
                          )
                          <i class="fa fa-chevron-down"></i>
                        </a>
                      </th>
                    </tr>
                  </thead>

                  <tbody>
                    @foreach ($products as $product)
                    @if ($product->subcategory_id == $subcategory->id)
                    <tr>
                      <th scope="row">{{ $product->id }}</th>
                      <td>{{ $product->name }}</td>
                      <td>
                      <img src="{{ $product->path_to_img }}" alt="" height="50">
                      </td>
                      <td>{{ $product->price }}</td>
                      <td>{{ $product->price_by_card }}</td>
                      <td>{{ $product->in_stock }}</td>
                      <td>{{ $product->availability }}</td>
                      <td>
                         @if ($product->published == 1)
                          <i class="fa fa-circle" style="color:#00ff00"></i>
                        @endif
                         @if ($product->published == 0)
                          <i class="fa fa-circle" style="color:#ff0000"></i>
                        @endif
                      </td>
                      <td class=" last">
                        <a href="/shop/products/{{$product->
                          id}}/delete" class="btn btn-danger">
                          <i class="fa fa-trash"></i>
                        </a>
                        <a href="/shop/products/{{ $category->id }}/{{$subcategory->id}}/{{$product->
                          id}}/edit" class="btn btn-primary">
                          <i class="fa fa-pencil"></i>
                        </a>
                        @if ($product->published == 1)
                        <a href="/shop/products/{{$product->
                          id}}/lock" class="btn btn-primary">
                          <i class="fa fa-lock"></i>
                        </a>
                        @endif
                        @if ($product->published == 0)
                        <a href="/shop/products/{{$product->
                          id}}/unlock" class="btn btn-primary">
                          <i class="fa fa-unlock"></i>
                        </a>
                        @endif
                      </td>
                    </tr>
                    @endif
                    @endforeach
                  </tbody>
                </table>

              </div>
                          </div>
                        </div>
                      </div>
                      @endif
                      @endforeach
                      <a class="btn btn-primary" href="http://etk-admin.ru/shop/products/{{$category->id}}/add"><i class="fa fa-plus"></i>Добавить</a>
                    </div>
                    <!-- end of accordion -->


                  </div>
                </div>
              </div>
      @endforeach

<div class="clearfix"></div>

<div class="row"></div>
<div class="clearfix"></div>
@endsection