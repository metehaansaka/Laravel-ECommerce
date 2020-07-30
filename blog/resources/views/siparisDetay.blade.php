@extends('layouts.master')
@section('title','Sipariş Detay')
@section('content')
    <div class="container">
        <div class="bg-content">
            <h2>Sipariş (SP-{{$urunler->id}})</h2>
            <table class="table table-bordererd table-hover">
                <tr>
                    <th>Ürün</th>
                    <th>Fiyat</th>
                    <th>Adet</th>
                    <th>Tutar</th>
                    <th>Durum</th>
                </tr>
                @foreach($urunler->sepet->sepet_urunler as $urun)
                <tr>
                    <td> <img src="http://lorempixel.com/120/100/food/2"> {{$urun->urun->urun_adi}}</td>
                    <td>{{$urun->fiyat }}</td>
                    <td>{{$urun->adet}}</td>
                    <td>{{$urun->fiyat * $urun->adet}}</td>
                    <td>{{$urun->durum}}</td>
                </tr>
                @endforeach
                <tr>
                    <th></th>
                    <th></th>
                    <th>Toplam Tutar (KDV Dahil)</th>
                    <td>{{$urunler->fiyat}}</td>
                    <th></th>
                </tr>
                <tr>
                    <th></th>
                    <th></th>
                    <th>Kargo</th>
                    <td>Ücretsiz</td>
                    <th></th>
                </tr>
                <tr>
                    <th></th>
                    <th></th>
                    <th>Sipariş Toplamı</th>
                    <td>{{$urunler->fiyat}}</td>
                    <th></th>
                </tr>

            </table>
        </div>
    </div>
@endsection
