<div class="col-xs website-logo">
    test
</div>
<div class="col-xs searchbar">
    <div class="input-group input-group-sm left-addon">
        <input type="text" class="form-control">
        <span class="input-group-addon"><i class="fa fa-search"></i></span>
    </div>
</div>

<ul>
    <li class="menu-title">Dashboard</li>
    <li><a href="{{ route('users.index') }}"><i class="fa fa-users"></i> Users</a></li>
    <li><a href="{{ route('posts.index') }}"><i class="fa fa-book"></i> Blog</a></li>
    <li data-toggle="collapse" data-target="#service" class="collapsed">
        <a href="#"><i class="fa fa-cc-stripe"></i> Payments <span class="arrow"><i class="fa fa-angle-double-left"></i></span></a>
    </li>
    <ul class="sub-menu collapse" id="service">
        <li><a href="{{ route('plans.index') }}">Plans</a></li>
        <li><a href="{{ route('coupons.index') }}">Coupons</a></li>
        <li><a href="{{ route('invoices.index') }}">Invoices</a></li>
    </ul>
</ul>

<ul>
    <li class="menu-title">Settings</li>
    <li><a href="{{ route('settings.index') }}"><i class="fa fa-gears"></i> Settings</a></li>
    <li><a href="{{ route('logs.index') }}"><i class="fa fa-archive"></i> Logs</a></li>
    <li data-toggle="collapse" data-target="#wer" class="collapsed">
        <a href="#"><i class="fa fa-globe"></i> Collapsable title <span class="arrow"><i class="fa fa-angle-double-left"></i></span></a>
    </li>
    <ul class="sub-menu collapse" id="wer">
        <li><a href="#">New Service 1</a></li>
        <li><a href="#">New Service 2</a></li>
        <li><a href="#">New Service 3</a></li>
    </ul>
    <li><a href="#">Title 5</a></li>
</ul>