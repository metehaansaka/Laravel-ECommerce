<div class="list-group">
    <a href="{{route('yonetim.anasayfa')}}" class="list-group-item">
        <span class="fa fa-fw fa-dashboard"></span>Kontrol Panelim</a>
    <a href="{{route('yonetim.urun.liste')}}" class="list-group-item">
        <span class="fa fa-fw fa-cubes"></span> Ürünler
        <span class="badge badge-dark badge-pill pull-right">{{$istatistikler['urun']}}</span>
    </a>
    <a href="{{route('yonetim.kategori.liste')}}" class="list-group-item"><span class="fa fa-fw fa-folder"></span> Kategoriler</a>
    <div class="list-group collapse" id="submenu1">
        <a href="#" class="list-group-item">Category</a>
        <a href="#" class="list-group-item">Category</a>
    </div>
    <a href="{{route('yonetim.kullanici.liste')}}" class="list-group-item">
        <span class="fa fa-fw fa-users"></span> Kullanıcılar
        <span class="badge badge-dark badge-pill pull-right">{{$istatistikler['kullanici']}}</span>
    </a>
    <a href="{{route('yonetim.siparis.liste')}}" class="list-group-item">
        <span class="fa fa-fw fa-shopping-cart"></span> Siparişler
        <span class="badge badge-dark badge-pill pull-right">{{$istatistikler['bekleyen']}}</span>
    </a>
</div>
