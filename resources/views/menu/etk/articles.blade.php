@extends('layouts.master')
@section('title')
etk21.ru | Новости
@endsection
@section('content')
  <div class="page-title">
              <div class="title_left">
                <h3>Новости</h3>
              </div>
              <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                </div>
              </div>
            </div>

<div class="x_panel">
                  <div class="x_title">
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="btn btn-primary" href="{{ route('etk.articles.add.get') }}"><i class="fa fa-plus"></i>Добавить</a>
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
                            <th class="column-title">Заголовок </th>
                            <th class="column-title">Описание краткое</th>
                            <th class="column-title">Описание </th>
                            <th class="column-title">Путь к изображению </th>
                            <th class="column-title">Thumbnail </th>
                            <th class="column-title">Создано пользователем </th>
                            <th class="column-title">Обновлено </th>
                            <th class="column-title">Создано </th>
                            <th class="column-title no-link last"><span class="nobr">Действие</span>
                            </th>
                            <th class="bulk-actions" colspan="7">
                              <a class="antoo" style="color:#fff; font-weight:500;">Bulk Actions ( <span class="action-cnt"> </span> ) <i class="fa fa-chevron-down"></i></a>
                            </th>
                          </tr>
                        </thead>

                        <tbody>
                        @foreach ($articles as $article)
                         <tr>
                          <th scope="row">{{ $article->id }}</th>
                          <td>{{ $article->title }}</td>
                          <td>{{ $article->content_short }}</td>
                          <td>{{ $article->content }}</td>
                          <td>{{ $article->image }}</td>
                          <td>{{ $article->thumbnail_image }}</td>
                          <td>{{ $article->user }}</td>
                          <td>{{ $article->updated_at }}</td>
                          <td>{{ $article->created_at }}</td>
                          <td class=" last"><a href="/shop/articles/{{$article->id}}/delete" class="btn btn-danger"><i class="fa fa-trash"></i></a>
                          <a href="/shop/articles/{{ $article->id }}/edit" class="btn btn-primary">
                            <i class="fa fa-pencil"></i></a></td>
                        </tr>
                        @endforeach
                         
                        </tbody>
                      </table>
                    </div>
                  </div>

                </div>

            <div class="clearfix"></div>

            <div class="row"></div>
                <div class="clearfix"></div>
@endsection
