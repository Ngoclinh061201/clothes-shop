@extends('admin.index')

@section('content')
    <div class="sufee-alert alert with-close alert-success alert-dismissible fade show">
        <span class="badge badge-pill badge-success">Success</span>
        Delete cache
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="overview-wrap">
                <h2 class="title-1">Dashboard</h2>
                <button id='cache-clear' class="au-btn au-btn-icon au-btn--blue">
{{--                    <i class="zmdi zmdi-calendar-remove"></i>Clear cache</button>--}}
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="report-dashboard">
                <form action="{{ url('dashboard') }}" method="GET">
                        <select id="filter_year" class="filter-year" name="filter_year" onchange="this.form.submit()">
                        @foreach($filterYear as $key => $value)
                           <option @if($key == $year) selected @endif value="{{$key}}">{{$value}}</option>
                            @endforeach
                    </select>
                </form>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="overview-wrap">
                <canvas id="myChart" style="width:100%;min-width:700px"></canvas>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
    <script type="text/javascript">
        const MONTHS = [
            'January',
            'February',
            'March',
            'April',
            'May',
            'June',
            'July',
            'August',
            'September',
            'October',
            'November',
            'December'
        ];
        const labels = months();
        var dataChart = @json($data);
        const data = {
            labels: labels,
            datasets: [{
                label: 'Revenue data',
                data: Object.values(dataChart),
                backgroundColor: 'rgba(255, 99, 132, 0.2)',
                borderColor: 'rgb(255, 99, 132)',
                borderWidth: 1
            }]
        };
        const config = {

        };
        const myChart = new Chart("myChart", {
            type: 'bar',
            data: data,
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            },
        });

        function months(config) {
            var cfg = config || {};
            var count = cfg.count || 12;
            var section = cfg.section;
            var values = [];
            var i, value;

            for (i = 0; i < count; ++i) {
                value = MONTHS[Math.ceil(i) % 12];
                values.push(value.substring(0, section));
            }

            return values;
        }
        $("#cache-clear").click(function() {
            $.ajax({
                url: 'dashboard/cache-clear',
                method: 'POST',
                data: {},
                success: function(resp) {
                    if(resp.status == true) {
                        $('.sufee-alert').show();
                    }
                }
            });
        });
    </script>
@endsection
