@extends('layouts.app')

@section('content')
    @include('layouts.headers.cards', array(
    'entries_sum'=>$entries_sum, 'outings_sum'=>$outings_sum, 'users_sum'=>$users_sum, 'balance'=>$balance,
    'entries_per_month' => $entries_per_month, 'entries_per_day_of_week' => $entries_per_day_of_week, 'outings_per_month' => $outings_per_month, 'outings_per_day_of_week' => $outings_per_day_of_week
    ))

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-12 mb-5 mb-xl-0">
                <div class="card bg-gradient-default shadow">
                     <div class="card-header bg-transparent">
                        <div class="row align-items-center">
                            <div class="col">
                                <h6 class="text-uppercase text-light ls-1 mb-1">Statistiques</h6>
                                <h2 class="text-white mb-0">Evolution des entrées et sorties</h2>
                            </div>
                            <div class="col">
                                <ul class="nav nav-pills justify-content-end">
                                    <li class="nav-item mr-2 mr-md-0">
                                        <a href="#" class="nav-link py-2 px-3 active" data-toggle="tab" id="updateYear">
                                            <span class="d-none d-md-block">Année</span>
                                            <span class="d-md-none">A</span>
                                        </a>
                                    </li>
                                    {{--<li class="nav-item mr-2 mr-md-0">
                                        <a href="#" class="nav-link py-2 px-3" data-toggle="tab" id="updateMonth">
                                            <span class="d-none d-md-block">Mois</span>
                                            <span class="d-md-none">M</span>
                                        </a>
                                    </li>--}}
                                    <li class="nav-item" data-toggle="chart">
                                        <a href="#" class="nav-link py-2 px-3" data-toggle="tab" id="updateWeek">
                                            <span class="d-none d-md-block">Semaine</span>
                                            <span class="d-md-none">S</span>
                                        </a>
                                    </li>
                                    {{--<li class="nav-item" data-toggle="chart" data-target="#chart-sales" data-update='{"data":{"datasets":[{"data":[0, 20, 5, 25, 10, 30, 15, 40, 40]}]}}' data-prefix="$" data-suffix="k">
                                        <a href="#" class="nav-link py-2 px-3" data-toggle="tab">
                                            <span class="d-none d-md-block">Semaine</span>
                                            <span class="d-md-none">S</span>
                                        </a>
                                    </li>--}}
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="chart-container" style="display: flex; gap: 20px;">
                            <div class="chart" style="flex: 1;">
                                <canvas id="myChart" class="chart-canvas"></canvas>
                            </div>
                            <div class="chart" style="flex: 1;">
                                <canvas id="myChart2" class="chart-canvas"></canvas>
                            </div>
                        </div>
                        <div class="col">
                            <h2 class="text-white mb-0">Evolution du solde</h2>
                        </div>
                        <div class="chart-container" style="display: flex; gap: 20px;">
                            <div class="chart" style="flex: 1;">
                                <canvas id="myChart3" class="chart-canvas"></canvas>
                            </div>
                        </div>

                        <!-- Chart -->
                         {{--<div class="chart">
                            <!-- Chart wrapper -->
                            <canvas id="chart-sales" class="chart-canvas"></canvas>
                        </div>--}}
                    </div>
                </div>
            </div>
            {{-- <div class="col-xl-4">
                <div class="card shadow">
                    <div class="card-header bg-transparent">
                        <div class="row align-items-center">
                            <div class="col">
                                <h6 class="text-uppercase text-muted ls-1 mb-1">Performance</h6>
                                <h2 class="mb-0">Total orders</h2>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <!-- Chart -->
                        <div class="chart">
                            <canvas id="chart-orders" class="chart-canvas"></canvas>
                        </div>
                    </div>
                </div>
            </div> --}}
        </div>
        {{-- <div class="row mt-5">
            <div class="col-xl-8 mb-5 mb-xl-0">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col">
                                <h3 class="mb-0">Page visits</h3>
                            </div>
                            <div class="col text-right">
                                <a href="#!" class="btn btn-sm btn-primary">See all</a>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <!-- Projects table -->
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">Page name</th>
                                    <th scope="col">Visitors</th>
                                    <th scope="col">Unique users</th>
                                    <th scope="col">Bounce rate</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row">
                                        /argon/
                                    </th>
                                    <td>
                                        4,569
                                    </td>
                                    <td>
                                        340
                                    </td>
                                    <td>
                                        <i class="fas fa-arrow-up text-success mr-3"></i> 46,53%
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">
                                        /argon/index.html
                                    </th>
                                    <td>
                                        3,985
                                    </td>
                                    <td>
                                        319
                                    </td>
                                    <td>
                                        <i class="fas fa-arrow-down text-warning mr-3"></i> 46,53%
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">
                                        /argon/charts.html
                                    </th>
                                    <td>
                                        3,513
                                    </td>
                                    <td>
                                        294
                                    </td>
                                    <td>
                                        <i class="fas fa-arrow-down text-warning mr-3"></i> 36,49%
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">
                                        /argon/tables.html
                                    </th>
                                    <td>
                                        2,050
                                    </td>
                                    <td>
                                        147
                                    </td>
                                    <td>
                                        <i class="fas fa-arrow-up text-success mr-3"></i> 50,87%
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">
                                        /argon/profile.html
                                    </th>
                                    <td>
                                        1,795
                                    </td>
                                    <td>
                                        190
                                    </td>
                                    <td>
                                        <i class="fas fa-arrow-down text-danger mr-3"></i> 46,53%
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-xl-4">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col">
                                <h3 class="mb-0">Social traffic</h3>
                            </div>
                            <div class="col text-right">
                                <a href="#!" class="btn btn-sm btn-primary">See all</a>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <!-- Projects table -->
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">Referral</th>
                                    <th scope="col">Visitors</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row">
                                        Facebook
                                    </th>
                                    <td>
                                        1,480
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <span class="mr-2">60%</span>
                                            <div>
                                                <div class="progress">
                                                <div class="progress-bar bg-gradient-danger" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%;"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">
                                        Facebook
                                    </th>
                                    <td>
                                        5,480
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <span class="mr-2">70%</span>
                                            <div>
                                                <div class="progress">
                                                <div class="progress-bar bg-gradient-success" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width: 70%;"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">
                                        Google
                                    </th>
                                    <td>
                                        4,807
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <span class="mr-2">80%</span>
                                            <div>
                                                <div class="progress">
                                                <div class="progress-bar bg-gradient-primary" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 80%;"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">
                                        Instagram
                                    </th>
                                    <td>
                                        3,678
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <span class="mr-2">75%</span>
                                            <div>
                                                <div class="progress">
                                                    <div class="progress-bar bg-gradient-info" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 75%;"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">
                                        twitter
                                    </th>
                                    <td>
                                        2,645
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <span class="mr-2">30%</span>
                                            <div>
                                                <div class="progress">
                                                <div class="progress-bar bg-gradient-warning" role="progressbar" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100" style="width: 30%;"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div> --}}

        {{-- @include('layouts.footers.auth') --}}
    </div>
@endsection

@push('js')
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.min.js"></script>
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.extension.js"></script>

    <script>
        // Initialize Argon Dashboard Chart.js
        var ctx = document.getElementById('myChart').getContext('2d');
        var ctx2 = document.getElementById('myChart2').getContext('2d');
        var ctx3 = document.getElementById('myChart3').getContext('2d');

        // Argon Dashboard-specific configuration
        var chartData1 = {
            labels: ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'],
            datasets: [{
                label: 'Entrées',
                data: @json($entries_per_month),
                backgroundColor: 'rgba(94, 114, 228, 0.1)', // Argon primary color
                borderColor: '#28a745',
                borderWidth: 2,
            }]
        };

        var chartData2 = {
            labels: ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'],
            datasets: [{
                label: 'Dépenses',
                data: @json($outings_per_month),
                backgroundColor: 'rgba(94, 114, 228, 0.1)', // Argon primary color
                borderColor: '#dc3545',
                borderWidth: 2,
            }]
        };

        var chartData3 = {
            labels: ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'],
            datasets: [{
                label: 'Solde',
                data: @json($balance_per_month),
                backgroundColor: 'rgba(94, 114, 228, 0.1)', // Argon primary color
                borderColor: '#66abf1',
                borderWidth: 2,
            }]
        };

        var chartOptions = {
            responsive: true,
            maintainAspectRatio: false, // Allows custom canvas dimensions,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: function(value) {
                            return value + 'k';
                        }
                    }
                }
            }
        };

        // Create the chart
        let myChart1 = new Chart(ctx, {
            type: 'line',
            data: chartData1,
            options: chartOptions
        });
        let myChart2 = new Chart(ctx2, {
            type: 'line',
            data: chartData2,
            options: chartOptions
        });
        let myChart3 = new Chart(ctx3, {
            type: 'line',
            data: chartData3,
            options: chartOptions
        });

        document.getElementById('updateYear').addEventListener('click', function() {
            document.getElementById('updateYear').classList.add('active');
            // document.getElementById('updateMonth').classList.remove('active');
            document.getElementById('updateWeek').classList.remove('active');
            // Update the chart data (for example, changing data values)
            chartData1.datasets[0].data = @json($entries_per_month); // New data
            chartData2.datasets[0].data = @json($outings_per_month);; // New data
            chartData3.datasets[0].data = @json($balance_per_month);; // New data

            // Optionally, update labels
            chartData1.labels = ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'];
            chartData2.labels = ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'];
            chartData3.labels = ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'];

            // Use the proper Argon method to update the chart
            myChart1.update();  // This is still valid for updating with Chart.js (and Argon Dashboard)
            myChart2.update();  // This is still valid for updating with Chart.js (and Argon Dashboard)
            myChart3.update();  // This is still valid for updating with Chart.js (and Argon Dashboard)
        });

        /*document.getElementById('updateMonth').addEventListener('click', function() {
            document.getElementById('updateYear').classList.remove('active');
            document.getElementById('updateMonth').classList.add('active');
            document.getElementById('updateWeek').classList.remove('active');
            // Update the chart data (for example, changing data values)
            chartData.datasets[0].data = [45, 60, 75, 90, 50, 45, 30]; // New data

            // Optionally, update labels
            chartData.labels = ['August', 'September', 'October', 'November', 'December', 'January', 'February'];

            // Use the proper Argon method to update the chart
            myChart1.update();  // This is still valid for updating with Chart.js (and Argon Dashboard)
        });*/

        document.getElementById('updateWeek').addEventListener('click', function() {
            document.getElementById('updateYear').classList.remove('active');
            // document.getElementById('updateMonth').classList.remove('active');
            document.getElementById('updateWeek').classList.add('active');
            // Update the chart data (for example, changing data values)
            chartData1.datasets[0].data = @json($entries_per_day_of_week); // New data
            chartData2.datasets[0].data = @json($outings_per_day_of_week); // New data
            chartData3.datasets[0].data = @json($balance_per_day_of_week); // New data

            // Optionally, update labels
            chartData1.labels = ['Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi', 'Dimanche'];
            chartData2.labels = ['Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi', 'Dimanche'];
            chartData3.labels = ['Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi', 'Dimanche'];

            // Use the proper Argon method to update the chart
            myChart1.update();  // This is still valid for updating with Chart.js (and Argon Dashboard)
            myChart2.update();  // This is still valid for updating with Chart.js (and Argon Dashboard)
            myChart3.update();  // This is still valid for updating with Chart.js (and Argon Dashboard)
        });

    </script>
@endpush
