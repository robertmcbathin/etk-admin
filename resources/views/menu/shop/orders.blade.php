@extends('layouts.master')
@section('title')
Магазин | Заказы
@endsection
@section('content')
<div class="x_panel">
  <div class="x_title">
    <h2>Заказы</h2>
    <ul class="nav navbar-right panel_toolbox">
      <li>
        <a class="btn btn-primary" href="{{ route('shop.orders.add.get') }}"> <i class="fa fa-plus"></i>
          Добавить
        </a>
      </li>
    </ul>
    <div class="clearfix"></div>
  </div>

  <div class="x_content">

    <div class="table-responsive">
      <table class="table table-striped jambo_table bulk_action">
        <thead>
          <tr class="headings">
            <th class="column-title">#</th>
            <th class="column-title">USER_ID</th>
            <th class="column-title">Имя</th>
            <th class="column-title">Фамилия</th>
            <th class="column-title">Телефон</th>
            <th class="column-title">Статус</th>
            <th class="column-title">Подробности заказа</th>
            <th class="column-title">Кем принят</th>
            <th class="column-title">Способ доставки</th>
            <th class="column-title">Адрес доставки</th>
            <th class="column-title">Способ оплаты</th>
            <th class="column-title">Завершен</th>
            <th class="column-title">Когда создан</th>
            <th class="column-title">Обновлен</th>
            <th class="column-title no-link last">
              <span class="nobr">Действие</span>
            </th>
            <th class="bulk-actions" colspan="7">
              <a class="antoo" style="color:#fff; font-weight:500;">
                Bulk Actions (
                <span class="action-cnt"></span>
                ) <i class="fa fa-chevron-down"></i>
              </a>
            </th>
          </tr>
        </thead>

        <tbody>
          @foreach ($orders as $order)
          <tr>
            <th scope="row">{{ $order->id }}</th>
            <td>{{ $order->user_id }}</td>
            <td>{{ $order->name }}</td>
            <td>{{ $order->second_name }}</td>
            <td>{{ $order->phone }}</td>
            <td>
              <div class="btn-group">
                <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  {{ $order->status }}
                  <span class="caret"></span>
                </button>
                <ul class="dropdown-menu">
                  <li>
                    <a href="{{route('shop.orders.change-status.get', ['order_id' => $order->id, 'status_id' => 2])}}">Подтвердить</a>
                  </li>
                  <li>
                    <a href="{{route('shop.orders.change-status.get', ['order_id' => $order->id, 'status_id' => 3])}}">Принят в обработку</a>
                  </li>
                  <li>
                    <a href="{{route('shop.orders.change-status.get', ['order_id' => $order->id, 'status_id' => 4])}}">Укомплектован</a>
                  </li>
                  <li>
                    <a href="{{route('shop.orders.change-status.get', ['order_id' => $order->id, 'status_id' => 5])}}">Передан в доставку</a>
                  </li>
                  <li>
                    <a href="{{route('shop.orders.change-status.get', ['order_id' => $order->id, 'status_id' => 6])}}">В пункте выдачи</a>
                  </li>
                  <li role="separator" class="divider"></li>
                  <li>
                    <a href="{{route('shop.orders.change-status.get', ['order_id' => $order->id, 'status_id' => 7])}}">Завершить</a>
                  </li>
                </ul>
              </div>
            </td>
            <td>
               <a href="#" class="btn btn-info" data-toggle="modal" data-target="#show-cart-{{$order->id}}">
                <i class="fa fa-list"></i>
              </a>
            </td>
              <div class="modal fade" tabindex="-1" role="dialog" id="show-cart-{{$order->id}}">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                      <h4 class="modal-title">Корзина</h4>
                    </div>
                      @foreach ($order->cart->items as $item)
                        <li class="list-group-item">
                          <span class="badge">{{$item['price']}} <i class="fa fa-rub"></i></span>
                          {{$item['item']['name']}} | {{ $item['qty'] }} шт.
                        </li>
                      @endforeach 
                      <div class="modal-footer">
                      <p> Всего позиций: <strong>{{$order->cart->totalQty}}</strong> Итого: <strong>{{$order->cart->totalPrice}} <i class="fa fa-rub"></i></strong></p>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
                      </div>
                  </div>
                  <!-- /.modal-content --> </div>
                <!-- /.modal-dialog --> </div>
            <td>{{ $order->processing_by }}</td>
            <td>{{ $order->delivery_type }}</td>
            <td>{{ $order->delivery_point }}</td>
            <td>{{ $order->payment_type }}</td>
            <td>
              @if ($order->is_closed == 1)
              <i class="fa fa-circle" style="color:#00ff00"></i>
              @endif
                         @if ($order->is_closed == 0)
              <i class="fa fa-circle" style="color:#ff0000"></i>
              @endif
            </td>
            <td>{{ $order->created_at }}</td>
            <td>{{ $order->updated_at }}</td>
            <td class=" last">
              <a href="/shop/orders/{{$order->
                id}}/delete" class="btn btn-danger">
                <i class="fa fa-trash"></i>
              </a>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>
@endsection