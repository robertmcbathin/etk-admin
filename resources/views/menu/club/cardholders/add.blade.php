@extends('layouts.master')
@section('title')
Добавление пользователя
@endsection
@section('content')
  <div class="page-title">
              <div class="title_left">
                <h3>Новый пользователь</h3>
              </div>
            </div>

            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Добавление пользователя</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <br />
                    <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" action="{{ route('club.cardholders.add.post') }}" method="POST">
                    <h4>Информация о карте</h4>
                      <div class="form-group card-group" >
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="serie">Серия<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="serie" name="card_serie" required="required" class="form-control col-md-7 col-xs-12" size="3" maxlength="3" value="{{ old('card_serie') }}">
                        </div>
                      </div>
                      <div class="form-group card-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="num">Номер<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="num" name="card_number" required="required" class="form-control col-md-7 col-xs-12" size="9" maxlength="15" value="{{ old('card_number') }}">
                        </div>
                      </div>
                      <hr>
                      <h4>Личная информация</h4>
                      <hr>
                      <div class="form-group" >
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="second_name">Фамилия<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="second_name" name="second_name" required="required" class="form-control col-md-7 col-xs-12" size="20" maxlength="50" value="{{ old('second_name') }}">
                        </div>
                      </div>
                      <div class="form-group" >
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first_name">Имя
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="first_name" name="first_name" required="required" class="form-control col-md-7 col-xs-12" size="20" maxlength="50" value="{{ old('first_name') }}">
                        </div>
                      </div>
                      <div class="form-group" >
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="third_name">Отчество
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="third_name" name="third_name" required="required" class="form-control col-md-7 col-xs-12" size="20" maxlength="50" value="{{ old('third_name') }}">
                        </div>
                      </div>
                      <div class="form-group {{ $errors->has('in_stock') ? 'has-error' : ''}}">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Дата рождения</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <input type="date" name="age" id="age" class="form-control col-md-7 col-xs-12" value="{{ old('age') }}">
                        </div>
                      </div>
                      <div class="form-group {{ $errors->has('in_stock') ? 'has-error' : ''}}">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Пол</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <select class="select2_single form-control select2-hidden-accessible" tabindex="-1" aria-hidden="true" name="sex">
                          <option value="{{ old('sex') }}">Выберите пол:</option>
                          <option value="U" >Не определен</option>
                          <option value="M">Мужской</option>
                          <option value="F">Женский</option>
                          </select><span class="select2 select2-container select2-container--default select2-container--above" dir="ltr" style="width: 551px;"><span class="selection"><span class="select2-selection select2-selection--single" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="-1" aria-labelledby="select2-ba1p-container"><span class="select2-selection__rendered" id="select2-ba1p-container"><span class="select2-selection__placeholder">Выберите пол</span></span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span>
                        </div>
                      </div>
                      <hr>
                      <h4>Контактная информация</h4>
                      <div class="form-group" >
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="phone">Телефон
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="phone" name="phone" class="form-control col-md-7 col-xs-12" size="15" maxlength="15" value="{{ old('phone') }}">
                        </div>
                      </div>
                      <div class="form-group" >
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Электронная почта
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="email" id="email" name="email" class="form-control col-md-7 col-xs-12" size="30" maxlength="150" value="{{ old('email') }}">
                        </div>
                      </div>
                      {{ csrf_field() }}
                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                          <button type="submit" class="btn btn-primary">Отмена</button>
                          <button type="submit" class="btn btn-success">Создать</button>
                        </div>
                      </div>

                    </form>
                  </div>
                </div>
              </div>
              <div class="clearfix"></div>
            </div>
            <div class="row"></div>
              @if($alert_title !== '')
                 <div class="alert {{ $alert_type }} alert-dismissible fade in" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                    </button>
                    <strong>{{ $alert_title }}</strong> {{ $alert_text }}
                  </div>
              @endif
                <div class="clearfix"></div>

@endsection
<script>
  var token = '{{ Session::token() }}';
  var url = '{{ route('ajax.check_card_credentials') }}';
</script>