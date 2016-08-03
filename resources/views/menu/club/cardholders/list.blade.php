@extends('layouts.master')
@section('title')
Держатели карт
@endsection
@section('content')
  <div class="page-title">
              <div class="title_left">
                <h3>Пользователи</h3>
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
                    <h2>Пользователей: <small>{{ $cardholders_count }}</small></h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
					<table class="table table-striped jambo_table">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Логин</th>
                          <th>Имя</th>
                          <th>Фамилия</th>
                          <th>Отчество</th>
                          <th>Email</th>
                          <th>Телефон</th>
                          <th>Пол</th>
                          <th>Дата рождения</th>
                          <th>Создан</th>
                          <th>Обновлен</th>
                          <th>ID карты</th>
                          <th>Активность</th>
                          <th>Промо-код</th>
                          <th>Действия</th>
                        </tr>
                      </thead>
                      <tbody>
                      @foreach ($cardholders as $cardholder)
						<tr>
                          <th scope="row">{{ $cardholder->id }}</th>
                          <td>{{ $cardholder->username }}</td>
                          <td>{{ $cardholder->first_name }}</td>
                          <td>{{ $cardholder->second_name }}</td>
                          <td>{{ $cardholder->patronymic }}</td>
                          <td>{{ $cardholder->email }}</td>
                          <td>{{ $cardholder->phone }}</td>
                          <td>{{ $cardholder->sex }}</td>
                          <td>{{ $cardholder->dob }}</td>
                          <td>{{ $cardholder->created_at }}</td>
                          <td>{{ $cardholder->updated_at }}</td>
                          <td>{{ $cardholder->card_id }}</td>
                          <td>
                          @if ($cardholder->is_active == 1)
                           <i class="fa fa-circle" style="color:#00ff00"></i>
                          @endif
                          @if ($cardholder->is_active == 0)
                           <i class="fa fa-circle" style="color:#ff0000"></i>
                          @endif</td>
                          <td>{{ $cardholder->promocode }}</td>
                          <td class=" last">
                        <a href="/club/cardholders/{{$cardholder->
                          id}}/delete" class="btn btn-danger">
                          <i class="fa fa-trash"></i>
                        </a>
                        <a href="/club/cardholders/{{ $cardholder->id }}/edit" class="btn btn-primary">
                          <i class="fa fa-pencil"></i>
                        </a>
                        @if ($cardholder->is_active == 1)
                        <a href="/club/cardholders/{{$cardholder->
                          id}}/lock" class="btn btn-primary">
                          <i class="fa fa-lock"></i>
                        </a>
                        @endif
                        @if ($cardholder->is_active == 0)
                        <a href="/club/cardholders/{{$cardholder->
                          id}}/unlock" class="btn btn-primary">
                          <i class="fa fa-unlock"></i>
                        </a>
                        @endif
                      </td>
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
