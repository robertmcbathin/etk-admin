@extends('layouts.master')
@section('title')
Магазин | Обратные звонки
@endsection
@section('content')

<div class="x_panel">
            <div class="x_title">
                    <h2>Обратные звонки </h2>
                    <div class="clearfix"></div>
                  </div>

                  <div class="x_content">

                    <div class="table-responsive">
                      <table class="table table-striped jambo_table bulk_action">
                        <thead>
                          <tr class="headings">
                            <th class="column-title"># </th>
                            <th class="column-title">Сообщение </th>
                            <th class="column-title">Пользователь </th>
                            <th class="column-title">Телефон </th>
                            <th class="column-title">Когда создан </th>
                            <th class="column-title">Кем принят к обработке </th>
                            <th class="column-title">Кем обработан </th>
                            <th class="column-title no-link last"><span class="nobr">Действие</span>
                            </th>
                            <th class="bulk-actions" colspan="7">
                              <a class="antoo" style="color:#fff; font-weight:500;">Bulk Actions ( <span class="action-cnt"> </span> ) <i class="fa fa-chevron-down"></i></a>
                            </th>
                          </tr>
                        </thead>

                        <tbody>
                        @foreach ($callbacks as $callback)
                         <tr>
                          <th scope="row">{{ $callback->id }}</th>
                          <td>{{ $callback->message }}</td>
                          <td>{{ $callback->user_id }}</td>
                          <td>{{ $callback->phone }}</td>
                          <td>{{ $callback->created_at }}</td>
                          <td>{{ $callback->processing_by }}</td>
                          <td>{{ $callback->closed_by }}</td>
                          <td class=" last"><a href="/shop/callbacks/{{$callback->id}}/{{Auth::user()->id}}/process" class="btn btn-primary"><i class="fa fa-hourglass"></i></a>
                          <a href="/shop/callbacks/{{ $callback->id }}/{{Auth::user()->id}}/done" class="btn btn-success">
                            <i class="fa fa-check"></i></a>
                            </td>
                        </tr>
                        @endforeach
                         
                        </tbody>
                      </table>
                    </div>
                  </div>
          </div>

@endsection
