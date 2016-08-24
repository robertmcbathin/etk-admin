@extends('layouts.master')
@section('title')
Магазин | Обратные звонки
@endsection
@section('content')
<div class="x_panel">
  <div class="x_title">
    <h2>Обратные звонки</h2>
    <div class="clearfix"></div>
  </div>

  <div class="x_content">

    <div class="table-responsive">
      <table class="table table-striped jambo_table bulk_action">
        <thead>
          <tr class="headings">
            <th class="column-title">#</th>
            <th class="column-title">Сообщение</th>
            <th class="column-title">Пользователь</th>
            <th class="column-title">Телефон</th>
            <th class="column-title">Когда создан</th>
            <th class="column-title">Кем принят к обработке</th>
            <th class="column-title">Кем обработан</th>
            <th class="column-title">Комментарий</th>
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
          @foreach ($callbacks as $callback)
          <tr>
            <th scope="row">{{ $callback->id }}</th>
            <td>{{ $callback->message }}</td>
            <td>{{ $callback->user_id }}</td>
            <td>{{ $callback->phone }}</td>
            <td>{{ $callback->created_at }}</td>
            <td>{{ $callback->processing_by }}</td>
            <td>{{ $callback->closed_by }}</td>
            <td>{{ $callback->comment }}</td>
            <td class=" last">
              <a href="/shop/callbacks/{{$callback->
                id}}/{{Auth::user()->id}}/process" class="btn btn-primary"> <i class="fa fa-hourglass"></i>
              </a>
              <a href="#" class="btn btn-info" data-toggle="modal" data-target="#leave-comment">
                <i class="fa fa-comment"></i>
              </a>
              @if (Auth::user())
              <div class="modal fade" tabindex="-1" role="dialog" id="leave-comment">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                      <h4 class="modal-title">Оставить комментарий</h4>
                    </div>
                    <form action="{{route('modals.leave-callback-comment.post', ['callback_id' => $callback->id, 'user_id' => Auth::user()->id])}}" method="POST">
                      <div class="modal-body">
                        <div class="form-group {{ $errors->
                          has('message') ? 'has-error' : ''}}">
                          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="message">Сообщение</label>
                          <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" id="message" name="message" required="required" class="form-control col-md-9 col-xs-12" size="255" maxlength="255" placeholder="Введите Ваше сообщение"></div>
                        </div>
                        <input type="hidden" name="user_id" value="{{Auth::user()->
                        id}}">
                        {{csrf_field()}}
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Отмена</button>
                        <button type="submit" class="btn btn-primary">Отправить</button>
                      </div>
                    </form>
                  </div>
                  <!-- /.modal-content --> </div>
                <!-- /.modal-dialog --> </div>
              @endif
              <a href="/shop/callbacks/{{ $callback->
                id }}/{{Auth::user()->id}}/done" class="btn btn-success">
                <i class="fa fa-check"></i>
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