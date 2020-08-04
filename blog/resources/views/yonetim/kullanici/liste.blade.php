@extends('yonetim.layouts.master')
@section('title','Kullanıcı Paneli')
@section('content')
    <h1 class="sub-header">
        <div class="btn-group pull-right" role="group" aria-label="Basic example">
            <button type="button" class="btn btn-primary">Düzenle</button>
            <button type="button" class="btn btn-primary">Ekle</button>
        </div>
        Kullanıcı Yönetim Paneli
    </h1>
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
                    <a href="#" class="btn btn-xs btn-danger" data-toggle="tooltip" data-placement="top" title="Sil" onclick="return confirm('Are you sure?')">
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
