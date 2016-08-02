<?php 
$username = Auth::user()->username;
?>
<li class="">
  <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
    <img src="{{ URL::to('/src/images/employees/' . $username . '.jpg') }}" alt="">{{ Auth::user()->first_name }} {{ Auth::user()->second_name }}
    <span class=" fa fa-angle-down"></span>
  </a>
  <ul class="dropdown-menu dropdown-usermenu pull-right">
    <li><a href="/logout"><i class="fa fa-sign-out pull-right"></i> Выйти </a></li>
  </ul>
</li>