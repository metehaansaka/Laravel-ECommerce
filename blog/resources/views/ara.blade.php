@extends('layouts\master')
@section('title','Arama')
@section('content')
    <div class="container">
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="\">Anasayfa</a></li>
            <li class="active">Arama Sonucu</li>
        </ol>
    </div>
    <div class="products bg-content">
        <div class="row">
            @if(count($deger)==0)
                <h3>Aranan ürün Bulunamadı</h3>
            @endif
            @foreach($deger as $urun)
                <div class="col-md-3 product">
                    <a href="{{route('urun',$urun->slug)}}">
                        <img src="http://via.placeholder.com/640x400?text=UrunResmi" alt="{{$urun->slug}}">
                    </a>
                    <p><a href="{{route('urun',$urun->slug)}}">{{$urun->urun_adi}}</a></p>
                    <p class="price">{{$urun->urun_fiyat}} ₺</p>
                </div>
                @endforeach
        </div>
    </div>
    </div>
@endsection
