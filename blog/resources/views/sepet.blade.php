@extends('layouts.master')
@section('title','Sepet')
@section('content')
    <div class="container">
        <div class="bg-content">
            <h2>Sepet</h2>
            <table class="table table-bordererd table-hover">
                <tr>
                    <th colspan="2">Ürün</th>
                    <th>Tutar</th>
                    <th>Adet</th>
                    <th>Ara Toplam</th>
                </tr>
                @foreach(Cart::getContent() as $cartCollection)
                <tr>
                    <td> <img src="http://lorempixel.com/120/100/food/2"></td>
                    <td>
                        <a href="{{route('urun',$cartCollection->attributes->slug)}}">{{$cartCollection->name}}</a>
                        <form action="{{route('sepet.kaldir',$cartCollection->id)}}" method="post">
                            {{csrf_field()}}
                            {{method_field('delete')}}

                            <input type="submit" class="btn btn-danger btn-sm" value="Sepetten Kaldır">
                        </form>
                    </td>
                    <td>{{$cartCollection->price}}</td>
                    <td>
                        <a href="#" class="btn btn-xs btn-default urun_azalt" data-id="{{$cartCollection->id}}" data-adet="{{$cartCollection->quantity-1}}">
                            -</a>
                        <span style="padding: 10px 20px">{{$cartCollection->quantity}}</span>
                        <a href="#" class="btn btn-xs btn-default urun_arttir" data-id="{{$cartCollection->id}}" data-adet="{{$cartCollection->quantity+1}}">
                            +</a>
                    </td>
                    <td>{{$cartCollection->getPriceSum()}}</td>
                </tr>
                @endforeach
                <tr>
                    <th></th>
                    <th></th>
                    <th>Toplam Tutar (KDV Dahil)</th>
                    <th>{{Cart::getSubTotal()}}</th>
                    <th></th>
                </tr>
            </table>
            <div>
                <form action="{{route('sepet.bosalt')}}" method="post">
                    {{csrf_field()}}
                    {{method_field('delete')}}
                    <input type="submit" class="btn btn-info pull-left" value="Sepeti Boşalt">
                </form>
                <a href="#" class="btn btn-success pull-right btn-lg">Ödeme Yap</a>
            </div>
        </div>
    </div>
@endsection

@section('footer')
    <script>

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(function(){
           $('.urun_arttir').on('click',function () {
               var id = $(this).attr('data-id');
               var adet = 1;
               $.ajax({
                   type : 'PATCH',
                   url : 'sepet/guncelle/' + id,
                   data : {adet : adet},
                   success: function () {
                        window.location.href = "/sepet" ;
                   }
               });
           });
        });

        $(function () {
            $('.urun_azalt').on('click',function () {
                var id = $(this).attr('data-id');
                var adet = 1-2;
                $.ajax({
                    type : 'PATCH',
                    url : 'sepet/guncelle/' + id,
                    data : {adet : adet},
                    success: function () {
                        window.location.href = "/sepet" ;
                    }
                });
            });
        });
    </script>
@endsection
