@extends('layouts.master')
@section('title')
Магазин | Теги
@endsection
@section('content')
  <div class="page-title">
              <div class="title_left">
                <h3>Теги</h3>
              </div>
              <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                </div>
              </div>
            </div>

<div class="x_panel">
                  <div class="x_title">
                    <h2>Теги <small>в привязке к подкатегориям</small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="btn btn-primary" href="{{ route('shop.tags.add.get') }}"><i class="fa fa-plus"></i>Добавить</a>
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
                            <th class="column-title">Подкатегория </th>
                            <th class="column-title no-link last"><span class="nobr">Действие</span>
                            </th>
                            <th class="bulk-actions" colspan="7">
                              <a class="antoo" style="color:#fff; font-weight:500;">Bulk Actions ( <span class="action-cnt"> </span> ) <i class="fa fa-chevron-down"></i></a>
                            </th>
                          </tr>
                        </thead>

                        <tbody>
                        @foreach ($tags as $tag)
                         <tr>
                          <th scope="row">{{ $tag->id }}</th>
                          <td>{{ $tag->name }}</td>
                          <td>{{ $tag->subcategory_name }}</td>
                          <td class=" last"><a href="/shop/tags/{{$tag->id}}/delete" class="btn btn-danger"><i class="fa fa-trash"></i></a>
                          <a href="/shop/tags/{{ $tag->id }}/edit" class="btn btn-primary">
                            <i class="fa fa-pencil"></i></a>
                            </td>
                        </tr>
                        @endforeach
                         
                        </tbody>
                      </table>
                    </div>
                  </div>

                </div>

            <div class="clearfix"></div>

@endsection
