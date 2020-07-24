@extends('layouts.master')
@section('title','Anasayfa')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <div class="panel panel-default">
                    <div class="panel-heading">Kategoriler</div>
                    <div class="list-group categories">
                        @foreach($kategoriler as $kategori)
                        <a href="{{route('kategori',$kategori->slug)}}" class="list-group-item">
                            <i class="fa fa-television"></i>
                            {{$kategori->kategori_adi}}
                        </a>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        @for($i=0;$i<5;$i++)
                        <li data-target="#carousel-example-generic" data-slide-to="{{$i}}" class="{{$i==0?'active':''}}"></li>
                        @endfor
                    </ol>
                        <div class="carousel-inner" role="listbox">

                            @foreach($slider as $index=>$detay)
                            <div class="item {{$index==0 ? 'active' : ''}}">
                                <img src="http://lorempixel.com/640/400/food/1" alt="...">
                                <div class="carousel-caption">
                                    {{$detay->urun->urun_adi}}
                                </div>
                            </div>

                            @endforeach
                        </div>
                    <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
                        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
                        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>
            <div class="col-md-3">
                <div class="panel panel-default" id="sidebar-product">
                    <div class="panel-heading">Günün Fırsatı</div>
                    <div class="panel-body">
                        <a href="{{route('urun',$firsat->slug)}}">
                            <img src="http://lorempixel.com/400/485/food/1" class="img-responsive">
                            {{$firsat->urun_adi}}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="products">
            <div class="panel panel-theme">
                <div class="panel-heading">Öne Çıkan Ürünler</div>
                <div class="panel-body">
                    <div class="row">
                        @foreach($firsat2 as $oneCikan)
                        <div class="col-md-3 product">
                            <a href="{{route('urun',$oneCikan->urun->slug)}}"><img src="http://lorempixel.com/400/400/food/1"></a>
                            <p><a href="#">{{$oneCikan->urun->urun_adi}}</a></p>
                            <p class="price">{{$oneCikan->urun->urun_fiyat}} ₺</p>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <hr>
        <div class="products">
            <div class="panel panel-theme">
                <div class="panel-heading">Çok Satan Ürünler</div>
                <div class="panel-body">
                    <div class="row">
                        @foreach($cok_satan as $coksatan)
                        <div class="col-md-3 product">
                            <a href="{{'urun',$coksatan->urun->slug}}"><img src="http://lorempixel.com/400/400/food/1"></a>
                            <p><a href="#">{{$coksatan->urun->urun_adi}}</a></p>
                            <p class="price">{{$coksatan->urun->urun_fiyat}} ₺</p>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <div class="products">
            <div class="panel panel-theme">
                <div class="panel-heading">İndirimli Ürünler</div>
                <div class="panel-body">
                    <div class="row">
                        @foreach($indirimli as $indirim)
                        <div class="col-md-3 product">
                            <a href="{{route('urun',$indirim->urun->slug)}}"><img src="http://lorempixel.com/400/400/food/1"></a>
                            <p><a href="{{route('urun',$indirim->urun->slug)}}">{{$indirim->urun->urun_adi}}</a></p>
                            <p class="price">{{$indirim->urun->urun_fiyat}} ₺</p>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
