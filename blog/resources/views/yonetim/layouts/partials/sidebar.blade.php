<div class="list-group">
    <a href="#" class="list-group-item">
        <span class="fa fa-fw fa-dashboard"></span> Dashboard</a>
    <a href="#" class="list-group-item">
        <span class="fas fa-fw fa-cubes"></span> Ürünler
        <span class="badge badge-dark badge-pill pull-right">14</span>
    </a>
    <a href="{{route('yonetim.kategori.liste')}}" class="list-group-item collapsed" data-target="#submenu1" data-toggle="collapse" data-parent="#sidebar"><span class="fa fa-fw fa-folder"></span> Categories<span class="caret arrow"></span></a>
    <div class="list-group collapse" id="submenu1">
        <a href="#" class="list-group-item">Category</a>
        <a href="#" class="list-group-item">Category</a>
    </div>
    <a href="{{route('yonetim.kullanici.liste')}}" class="list-group-item">
        <span class="fa fa-fw fa-users"></span> Kullanıcılar
        <span class="badge badge-dark badge-pill pull-right"></span>
    </a>
    <a href="#" class="list-group-item">
        <span class="fa fa-fw fa-dashboard"></span> Orders
        <span class="badge badge-dark badge-pill pull-right">14</span>
    </a>
</div>
