@extends('layouts.master')
@section('title')
Карты
@endsection
@section('content')
  <div class="page-title">
              <div class="title_left">
                <h3>Карты</h3>
              </div>

              <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                  <div class="input-group">
                    <input type="text" class="form-control" placeholder="Поиск...">
                    <span class="input-group-btn">
                      <button class="btn btn-default" type="button">Искать</button>
                    </span>
                  </div>
                </div>
              </div>
            </div>

            <div class="clearfix"></div>

            <div class="row">

				<div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Активированы <small>{{ $active_cards_count }}</small></h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
					<table class="table">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>серия</th>
                          <th>номер</th>
                          <th>Имя</th>
                          <th>Фамилия</th>
                          <th>Email</th>
                          <th>Телефон</th>
                          <th>Время и дата</th>
                        </tr>
                      </thead>
                      <tbody>
                      @foreach ($active_cards as $active_card)
						<tr>
                          <th scope="row">{{ $active_card->id }}</th>
                          <td>{{ $active_card->serie }}</td>
                          <td>{{ $active_card->num }}</td>
                          <td>{{ $active_card->first_name }}</td>
                          <td>{{ $active_card->second_name }}</td>
                          <td>{{ $active_card->email }}</td>
                          <td>{{ $active_card->phone }}</td>
                          <td>{{ $active_card->updated_at }}</td>
                        </tr>
					   @endforeach
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
              <div class="clearfix"></div>
            </div>
@endsection
