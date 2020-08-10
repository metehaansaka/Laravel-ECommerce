@extends('yonetim.layouts.master')
@section('title','Sipariş Paneli')
@section('content')
    <h1 class="sub-header">
        Sipariş Yönetim Paneli
    </h1>
    <div class="well">
        <div class="btn-group pull-right" role="group" aria-label="Basic example">
            <a href="{{route('yonetim.siparis.yeni')}}" class="btn btn-primary">Ekle</a>
        </div>
        <form action="{{route('yonetim.siparis.liste')}}" method="post" class="form-inline">
            {{csrf_field()}}
            <div class="form-group">
                <label for="aranan">Ara</label>
                <input type="text" name="aranan" id="aranan" class="form-control form-control-sm" placeholder="Sipariş..." value="{{old('aranan')}}">
            </div>
            <button type="submit" class="btn btn-success btn-sm">Ara</button>
            <a href="{{route('yonetim.siparis.liste')}}" class="btn btn-outline-primary btn-sm">Temizle</a>
        </form>
    </div>
    <div class="table-responsive">
        <table class="table table-hover table-bordered">
            <thead class="thead-dark">
            <tr>
                <th>Sipariş Kodu</th>
                <th>Ad Soyad</th>
                <th>Durum</th>
                <th>Fiyat</th>
                <th>Banka</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @foreach($kullanicilar as $kullanici)
            <tr>
                <td>SP.{{$kullanici->id}}</td>
                <td>{{$kullanici->sepet->kullanici->ad_soyad}}</td>
                <td>{{$kullanici->durum}}</td>
                <td>{{$kullanici->fiyat}}</td>
                <td>{{$kullanici->banka}}</td>
                <td style="width: 100px">
                    <a href="{{route('yonetim.siparis.duzenle',$kullanici->id)}}" class="btn btn-xs btn-success" data-toggle="tooltip" data-placement="top" title="Düzenle">
                        <span class="fa fa-pencil"></span>
                    </a>
                    <a href="{{route('yonetim.siparis.sil',$kullanici->id)}}" class="btn btn-xs btn-danger" data-toggle="tooltip" data-placement="top" title="Sil" onclick="return confirm('Emin misin?')">
                        <span class="fa fa-trash"></span>
                    </a>
                </td>
            </tr>
            @endforeach
            </tbody>
        </table>
        <div class="pull-right">
            {{$kullanicilar->links()}}
        </div>
    </div>
@endsection
