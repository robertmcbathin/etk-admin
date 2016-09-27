@extends('layouts.master')
@section('title')
ETK-Admin
@endsection
@section('content')
<div class="row tile_count">
<h1>Клуб</h1>
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-credit-card"></i> Всего карт</span>
              <div class="count">{{ $card_count }}</div>
            </div>
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-clock-o"></i> Ожидание активации</span>
              <div class="count">{{ $awaiting_cards_count }}</div>
            </div>
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-credit-card"></i> Активировано</span>
              <div class="count green">{{ $active_cards_count }}</div>
            </div>
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-credit-card"></i> Деактивировано</span>
              <div class="count green">{{ $deactive_cards_count }}</div>
            </div>
</div>
<div class="row tile_count">
<h1>21market</h1>
  <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
     <div class="tile-stats">
       <div class="icon"><i class="fa fa-shopping-bag"></i>
       </div>
       <div class="count">{{ $new_order_count }}</div>
       <h3>Новые заказы</h3>
       <p>Необходимо обработать {{ $new_order_count }} новых заказов</p>
     </div>
  </div>
  <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
     <div class="tile-stats">
       <div class="icon"><i class="fa fa-phone"></i>
       </div>
       <div class="count">{{ $new_callbacks_count }}</div>
       <h3>Новые обратные звонки</h3>
       <p>Необходимо отработать {{ $new_callbacks_count }} новых обратных звонков</p>
     </div>
  </div>
</div>
<?php var_dump($user) ?>
@endsection
