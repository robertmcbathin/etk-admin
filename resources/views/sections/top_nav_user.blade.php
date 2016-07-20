<li class="">
  <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
    <img src="{{ URL::to('/src/images/mercile55.jpg') }}" alt="">{{ Auth::user()->first_name }} {{ Auth::user()->second_name }}
    <span class=" fa fa-angle-down"></span>
  </a>
  <ul class="dropdown-menu dropdown-usermenu pull-right">
    <li><a href="/auth/logout"><i class="fa fa-sign-out pull-right"></i> Выйти </a></li>
  </ul>
</li>