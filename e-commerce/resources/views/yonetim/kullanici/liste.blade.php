@extends('yonetim.layouts.master')
@section('title','Kullanıcı Paneli')
@section('content')
    <h1 class="sub-header">
        Kullanıcı Yönetim Paneli
    </h1>
    <div class="well">
        <div class="btn-group pull-right" role="group" aria-label="Basic example">
            <a href="{{route('yonetim.kullanici.yeni')}}" class="btn btn-primary">Ekle</a>
        </div>
        <form action="{{route('yonetim.kullanici.liste')}}" method="post" class="form-inline">
            {{csrf_field()}}
            <div class="form-group">
                <label for="aranan">Ara</label>
                <input type="text" name="aranan" id="aranan" class="form-control form-control-sm" placeholder="İsim, Email..." value="{{old('aranan')}}">
            </div>
            <button type="submit" class="btn btn-success btn-sm">Ara</button>
            <a href="{{route('yonetim.kullanici.liste')}}" class="btn btn-outline-primary btn-sm">Temizle</a>
        </form>
    </div>
    <div class="table-responsive">
        <table class="table table-hover table-bordered">
            <thead class="thead-dark">
            <tr>
                <th>#</th>
                <th>Ad Soyad</th>
                <th>Mail</th>
                <th>Kayıt Tarihi</th>
                <th>Durum</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @foreach($kullanicilar as $kullanici)
            <tr>
                <td>{{$kullanici->id}}</td>
                <td>{{$kullanici->ad_soyad}}</td>
                <td>{{$kullanici->mail}}</td>
                <td>{{$kullanici->oluşturulma_tarihi}}</td>
                <td>{{ $kullanici->yonetici==1 ? "Yönetici" : "Müşteri" }}</td>
                <td style="width: 100px">
                    <a href="{{route('yonetim.kullanici.duzenle',$kullanici->id)}}" class="btn btn-xs btn-success" data-toggle="tooltip" data-placement="top" title="Düzenle">
                        <span class="fa fa-pencil"></span>
                    </a>
                    <a href="{{route('yonetim.kullanici.sil',$kullanici->id)}}" class="btn btn-xs btn-danger" data-toggle="tooltip" data-placement="top" title="Sil" onclick="return confirm('Emin misin?')">
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
