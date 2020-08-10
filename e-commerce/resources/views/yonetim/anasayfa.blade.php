@extends('yonetim.layouts.master')
@section('title','Anasayfa')
@section('content')
    <h1 class="page-header">Kontrol Paneli</h1>

    <section class="row text-center placeholders">
        <div class="col-6 col-sm-3">
            <div class="panel panel-primary">
                <div class="panel-heading">Bekleyen Sipariş</div>
                <div class="panel-body">
                    <h4>{{$istatistikler['bekleyen']}}</h4>
                    <p>Adet</p>
                </div>
            </div>
        </div>
        <div class="col-6 col-sm-3">
            <div class="panel panel-primary">
                <div class="panel-heading">Tamamlanan Sipariş</div>
                <div class="panel-body">
                    <h4>{{$istatistikler['tamamlanan']}}</h4>
                    <p>Adet</p>
                </div>
            </div>
        </div>
        <div class="col-6 col-sm-3">
            <div class="panel panel-primary">
                <div class="panel-heading">Ürün</div>
                <div class="panel-body">
                    <h4>{{$istatistikler['urun']}}</h4>
                    <p>Adet</p>
                </div>
            </div>
        </div>
        <div class="col-6 col-sm-3">
            <div class="panel panel-primary">
                <div class="panel-heading">Kullanıcı</div>
                <div class="panel-body">
                    <h4>{{$istatistikler['kullanici']}}</h4>
                    <p>Adet</p>
                </div>
            </div>
        </div>
    </section>
    <section class="row">
        <div class="col-md-6">
            <div class="panel panel-primary">
                <div class="panel-heading">Çok Satanlar</div>
                <div class="panel-body">
                    <canvas id="myChart"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="panel panel-primary">
                <div class="panel-heading">Aylara Göre Satışlar</div>
                <div class="panel-body">
                    <canvas id="myChart2"></canvas>
                </div>
            </div>
        </div>
    </section>

@endsection
@section('footer')
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.3/dist/Chart.min.js"></script>
    <script>
         <?php
            $labels = "";
            $data = "";
            foreach ($cok_satan_urunler as $rapor){
                $labels .= "\"$rapor->urun_adi\",";
                $data .= "\"$rapor->toplam\",";
            }
            ?>
        var ctx = document.getElementById('myChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'horizontalBar',
            data: {
                labels: [{!! $labels !!}],
                datasets: [{
                    label: '# of Votes',
                    data: [{!! $data !!}],
                    borderColor: 'rgb(255,99,132)',
                    borderWidth: 1
                }]
            },
            options: {
                legend : {
                    display:false
                },
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });
    </script>
    <script>
            <?php
            $labels = "";
            $data = "";
            foreach ($aylara_gore_satislar as $rapor){
                $labels .= "\"$rapor->ay\",";
                $data .= "\"$rapor->toplam\",";
            }
            ?>
        var ctx2 = document.getElementById('myChart2').getContext('2d');
        var myChart2 = new Chart(ctx2, {
            type: 'bar',
            data: {
                labels: [{!! $labels !!}],
                datasets: [{
                    label: '# of Votes',
                    data: [{!! $data !!}],
                    borderColor: 'rgba(255,99,132)',
                    borderWidth: 1
                }]
            },
            options: {
                legend : {
                    display:false
                },
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });
    </script>

@endsection
