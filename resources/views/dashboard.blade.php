@extends('layouts.master')
@section('title')
ETK-Admin
@endsection
@section('content')
<div class="row tile_count">
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
<?php var_dump($user) ?>
@endsection
