@extends('layouts.signin')
@section('title')
Вход в систему
@endsection
@section('login')
<div class="login_wrapper">
        <div class="animate form login_form">
          <section class="login_content">
            <form action="/auth/login" method="post">
              <h1>Вход в систему</h1>
              <div>
                <input  name="username" type="text" class="form-control" placeholder="Логин" value="{{ old('username') }}" />
              </div>
              <div>
                <input name="password" type="password" class="form-control" placeholder="Пароль" />
              </div>
              <div>
                <input type="hidden" name="_token" value="{{ Session::token() }}">
              </div>
              <div>
              <button type="submit" class="btn btn-primary">Войти</button>
              </div>

              <div class="clearfix"></div>

              <div class="separator">
                <div class="clearfix"></div>
                <br />

                <div>
                  <h1><img src="{{ URL::to('/src/images/etk-club-logo-static.png') }}" width="32" alt=""> ETK-Club</h1>
                  <p>©2016 All Rights Reserved. ETK-Club. Author: Alexander Ivanov</p>
                </div>
              </div>
            </form>
          </section>
        </div>
      </div>
@endsection