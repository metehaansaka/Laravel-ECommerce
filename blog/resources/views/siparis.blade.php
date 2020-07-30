@extends('layouts.master')
@section('title','Siparişler')
@section('content')
    <div class="container">
        <div class="bg-content">
            <h2>Siparişler</h2>
            <p>Henüz siparişiniz yok</p>
            <table class="table table-bordererd table-hover">
                <tr>
                    <th>Sipariş Kodu</th>
                    <th>Toplam Fiyat</th>
                    <th>Toplam Ürün</th>
                    <th>Durum</th>
                    <th>İşlem</th>
                </tr>
                @foreach($siparisler as $siparis)
                <tr>
                    <td>SP-{{$siparis->id}}</td>
                    <td>{{$siparis->fiyat}}</td>
                    <td>{{$siparis->sepet->sepet_urun_adet()}}</td>
                    <td>{{$siparis->durum}}</td>
                    <td><a href="{{route('siparisDetay',$siparis->id)}}" class="btn btn-sm btn-success">Detay</a></td>
                </tr>
                @endforeach
            </table>
        </div>
    </div>
@endsection
