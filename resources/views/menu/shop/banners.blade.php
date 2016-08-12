@extends('layouts.master')
@section('title')
Магазин | Баннеры
@endsection
@section('content')

<div class="x_panel">
            <div class="x_title">
                    <h2>Баннеры </h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="btn btn-primary" href="{{ route('shop.banners.add.get') }}"><i class="fa fa-plus"></i>Добавить</a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>

                  <div class="x_content">

                    <div class="table-responsive">
                      <table class="table table-striped jambo_table bulk_action">
                        <thead>
                          <tr class="headings">
                            <th class="column-title"># </th>
                            <th class="column-title">Название </th>
                            <th class="column-title">Обновлен </th>
                            <th class="column-title">Создана </th>
                            <th class="column-title no-link last"><span class="nobr">Действие</span>
                            </th>
                            <th class="bulk-actions" colspan="7">
                              <a class="antoo" style="color:#fff; font-weight:500;">Bulk Actions ( <span class="action-cnt"> </span> ) <i class="fa fa-chevron-down"></i></a>
                            </th>
                          </tr>
                        </thead>

                        <tbody>
                        @foreach ($banners as $banner)
                         <tr>
                          <th scope="row">{{ $banner->id }}</th>
                          <td>{{ $banner->title }}</td>
                          <td>{{ $banner->updated_at }}</td>
                          <td>{{ $banner->created_at }}</td>
                          <td class=" last"><a href="/shop/categories/{{$banner->id}}/delete" class="btn btn-danger"><i class="fa fa-trash"></i></a>
                          <a href="/shop/categories/{{ $banner->id }}/edit" class="btn btn-primary">
                          <i class="fa fa-pencil"></i>
                            </td>
                        </tr>
                        @endforeach
                         
                        </tbody>
                      </table>
                    </div>
                  </div>
          </div>

                </div>

            <div class="clearfix"></div>

            <div class="row"></div>
                <div class="clearfix"></div>
            </div>
@endsection
