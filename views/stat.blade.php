@extends('layouts.app')

@section('content')
    <div class="row justify-content-md-center">
        <div class="col">
            <div class="card mt-4 mb-4">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm">
                            <div class="table-responsive">
                                <canvas id="chart1" style="min-height:150px" class="table"></canvas>
                            </div>
                            <div class="table-responsive">
                                <canvas id="chart2" style="min-height:150px" class="table"></canvas>
                            </div>
                        </div>
                        <div class="col-sm">
                            <div class="table-responsive">
                                <canvas id="chart3" style="min-height:150px" class="table"></canvas>
                            </div>
                            <div class="table-responsive">
                                <canvas id="chart4" style="min-height:150px" class="table"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('title')
    Статистика ответов
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.3/dist/Chart.min.js"></script>
    <script>
        let data = $.ajax({
            url: "/ajax/getStat.php",
            method: "POST",
            success: function (data) {
                let graphics = JSON.parse(data);
                new Chart(document.getElementById('chart1').getContext('2d'), {
                    type: 'line',
                    data: graphics[0]
                });
                new Chart(document.getElementById('chart2').getContext('2d'), {
                    type: 'line',
                    data: graphics[1]
                });
                new Chart(document.getElementById('chart3').getContext('2d'), {
                    type: 'line',
                    data: graphics[2]
                });
                new Chart(document.getElementById('chart4').getContext('2d'), {
                    type: 'line',
                    data: graphics[3]
                });
            }
        });
    </script>
@endsection