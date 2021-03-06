<?php 
$username = Auth::user()->username;
?>
<div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="/dashboard" class="site_title"><img src="{{ URL::to('/src/images/etk-club-logo-static.png') }}" width="32" alt=""><span>ETK-Admin</span></a>
            </div>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <div class="profile">
              <div class="profile_pic">
                <img src="{{ URL::to('/src/images/employees/' . $username . '.jpg') }}" alt="..." class="img-circle profile_img">
              </div>
              <div class="profile_info">
                <span>Привет,</span>
                <h2>{{ Auth::user()->first_name }} {{ Auth::user()->second_name }}</h2>
              </div>
            </div>
            <!-- /menu profile quick info -->

            <br />
<!-- -->
            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <h3>МЕНЮ</h3>
                <ul class="nav side-menu">
                  <li><a><i class="fa fa-users"></i> Клуб <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a>Карты <span class="fa fa-chevron-down"></span></a>
                      <ul class="nav child_menu">
                        <li class="sub_menu"><a href="{{ route('club.cards.queue') }}">Ожидание активации</a>
                        </li>
                        <li><a href="{{ route('club.cards.activated') }}">Активированные</a>
                        </li>
                        <li class="sub_menu"><a href="{{ route('club.cards.add.get') }}">Добавить</a>
                        </li>
                      </ul>
                      </li>
                      <li><a>Держатели <span class="fa fa-chevron-down"></span></a>
                      <ul class="nav child_menu">
                        <li class="sub_menu"><a href="{{ route('club.cardholders.list') }}">Список</a>
                        </li>
                        <li class="sub_menu"><a href="{{ route('club.cardholders.add.get') }}">Добавить</a>
                        </li>
                      </ul>
                      </li>
                      <li><a href="index3.html">Еще какой-то пункт</a></li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-shopping-basket"></i> 21market.ru <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                    <li><a href="{{ route('shop.sections') }}">Разделы</a></li>
                      <li><a href="{{ route('shop.categories') }}">Категории</a></li>
                      <li><a href="{{ route('shop.tags') }}">Теги</a></li>
                      <li><a href="{{ route('shop.attributes') }}">Характеристики</a></li>
                      <li><a href="{{ route('shop.products') }}">Товары</a></li>
                      <li><a href="form_advanced.html">Закупки</a></li>
                      <li><a href="form_validation.html">Заказы</a></li>
                      <li><a href="form_wizards.html">Поставщики</a></li>
                      <li><a href="{{ route('shop.manufacturers') }}">Производители</a></li>
                      <li><a href="{{ route('shop.banners') }}">Баннеры</a></li>
                      <li><a href="{{ route('shop.callbacks.show') }}">Обратные звонки <span class="badge">{{$unanswered_callbacks_count}}</span></a>
                      </li>
                      <li><a>Заказы <span class="badge">{{$new_orders_count}}</span><span class="fa fa-chevron-down"></span></a>
                      <ul class="nav child_menu">
                        <li class="sub_menu"><a href="{{ route('shop.new_orders') }}">Новые <span class="badge">{{$new_orders_count}}</span></a>
                        </li>
                        <li class="sub_menu"><a href="{{ route('shop.fast_orders') }}">Быстрые <span class="badge">{{$new_orders_count}}</span></a>
                        </li>
                        <li><a href="{{ route('shop.orders') }}">Список</a>
                        </li>
                        <li class="sub_menu"><a href="{{ route('club.cards.add.get') }}">Добавить</a>
                        </li>
                      </ul>
                      </li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-credit-card-alt"></i> etk21.ru <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="{{ route('etk.cards') }}">Карты</a></li>
                      <li><a href="{{ route('etk.articles') }}">Новости</a></li>
                      <li><a href="{{ route('etk.questions') }}">Вопросы</a></li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-wrench"></i> Настройки <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="{{ route('settings.users') }}">Пользователи</a></li>
                      <li><a href="tables_dynamic.html">Настройка 2</a></li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-bar-chart-o"></i> Статистика <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="chartjs.html">Chart JS</a></li>
                      <li><a href="chartjs2.html">Chart JS2</a></li>
                      <li><a href="morisjs.html">Moris JS</a></li>
                      <li><a href="echarts.html">ECharts</a></li>
                      <li><a href="other_charts.html">Other Charts</a></li>
                    </ul>
                  </li>
                </ul>
              </div>
            </div>
            <!-- /sidebar menu -->

            <!-- /menu footer buttons -->
            <div class="sidebar-footer hidden-small">
              <a data-toggle="tooltip" data-placement="top" title="Settings">
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Lock">
                <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Logout">
                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
              </a>
            </div>
            <!-- /menu footer buttons -->
          </div>
        </div>