@extends('layouts.master')
@section('title')
Магазин | Заказы
@endsection
@section('content')

<div class="x_panel">
            <div class="x_title">
                    <h2>Заказы </h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="btn btn-primary" href="{{ route('shop.orders.add.get') }}"><i class="fa fa-plus"></i>Добавить</a>
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
                            <th class="column-title">USER_ID </th>
                            <th class="column-title">Телефон </th>
                            <th class="column-title">Имя </th>
                            <th class="column-title">Статус </th>
                            <th class="column-title">Когда создан </th>
                            <th class="column-title">Обновлен </th>
                            <th class="column-title">Кем принят </th>
                            <th class="column-title">Способ доставки </th>
                            <th class="column-title">Адрес доставки </th>
                            <th class="column-title">Способ оплаты </th>
                            <th class="column-title">Завершен </th>
                            <th class="column-title no-link last"><span class="nobr">Действие</span>
                            </th>
                            <th class="bulk-actions" colspan="7">
                              <a class="antoo" style="color:#fff; font-weight:500;">Bulk Actions ( <span class="action-cnt"> </span> ) <i class="fa fa-chevron-down"></i></a>
                            </th>
                          </tr>
                        </thead>

                        <tbody>
                        @foreach ($orders as $order)
                         <tr>
                          <th scope="row">{{ $order->id }}</th>
                          <td>{{ $order->user_id }}</td>
                          <td>{{ $order->phone }}</td>
                          <td>{{ $order->name }}</td>
                          <td>{{ $order->status }}</td>
                          <td>{{ $order->created_at }}</td>
                          <td>{{ $order->updated_at }}</td>
                          <td>{{ $order->processing_by }}</td>
                          <td>{{ $order->delivery_type }}</td>
                          <td>{{ $order->delivery_point }}</td>
                          <td>{{ $order->payment_type }}</td>
                          <td>{{ $order->closed_by }}</td>
                          <td class=" last"><a href="/shop/orders/{{$order->id}}/delete" class="btn btn-danger"><i class="fa fa-trash"></i></a>
                          <a href="/shop/orders/{{ $order->id }}/edit" class="btn btn-primary">
                            <i class="fa fa-pencil"></i></a>
                            </td>
                        </tr>
                        @endforeach
                         
                        </tbody>
                      </table>
                    </div>
                  </div>
          </div>
@endsection
