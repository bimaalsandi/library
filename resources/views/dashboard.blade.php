@extends('layouts.main')
@section('content')
    <div class="container mt-4">
        <form method="GET" action="{{ url('/dashboard') }}" class="d-flex justify-content-end align-items-center mb-3"
            id="filterForm">
            <label for="daterange" class="form-label me-2 fw-semibold mb-0">Daterange</label>
            <input type="text" id="daterange" name="daterange" class="form-control me-2" value="{{ $date_range ?? '' }}"
                placeholder="YYYY-MM-DD - YYYY-MM-DD" autocomplete="off" />
        </form>
        <div class="row g-3 mb-4">

            <div class="col-md-3">
                <div class="card shadow-sm border-0 rounded-3">
                    <div class="card-body d-flex align-items-center">
                        <div class="me-3 bg-primary text-white rounded-circle d-flex align-items-center justify-content-center"
                            style="width: 50px; height: 50px;">
                            <i class="bi bi-people fs-4"></i>
                        </div>
                        <div>
                            <h6 class="text-muted mb-1">Jumlah User</h6>
                            <h3 class="fw-bold mb-0">{{ $user }}</h3>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card shadow-sm border-0 rounded-3">
                    <div class="card-body d-flex align-items-center">
                        <div class="me-3 bg-danger text-white rounded-circle d-flex align-items-center justify-content-center"
                            style="width: 50px; height: 50px;">
                            <i class="bi bi-book fs-4"></i>
                        </div>
                        <div>
                            <h6 class="text-muted mb-1">Jumlah Buku</h6>
                            <h3 class="fw-bold mb-0">{{ $buku }}</h3>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card shadow-sm border-0 rounded-3">
                    <div class="card-body d-flex align-items-center">
                        <div class="me-3 bg-warning text-white rounded-circle d-flex align-items-center justify-content-center"
                            style="width: 50px; height: 50px;">
                            <i class="bi bi-person-check fs-4"></i>
                        </div>
                        <div>
                            <h6 class="text-muted mb-1">Jumlah Pengunjung</h6>
                            <h3 class="fw-bold mb-0">{{ $pengunjung }}</h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card shadow-sm border-0 rounded-3">
                    <div class="card-body d-flex align-items-center">
                        <div class="me-3 bg-success text-white rounded-circle d-flex align-items-center justify-content-center"
                            style="width: 50px; height: 50px;">
                            <i class="bi bi-coin fs-4"></i>
                        </div>
                        <div>
                            <h6 class="text-muted mb-1">Denda</h6>
                            <h3 class="fw-bold mb-0">{{ number_format($totalDenda, 0, '.', '.') }}</h3>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <div class="p-5 bg-white shadow-sm rounded mb-3">
            <h3>Selamat Datang di Sistem Perpustakaan</h3>
            <p class="text-muted">Gunakan menu di atas untuk mengelola data User, Buku, dan Pengunjung.</p>
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <div class="card p-2">
                    @php
                        $bulan = [];
                        $total = [];
                        foreach ($totalBuku as $tb) {
                            $bulan[] = $tb->bulan . ' ' . $tb->tahun;
                            $total[] = $tb->total;
                        }
                    @endphp
                    <div class="card-header pb-0 p-3">
                        <h6 class="mb-0">Buku Masuk Per Bulan</h6>
                        <div class="card-body pb-0 p-3">
                            <div id="bukuChart" style="height: 400px;"></div>
                        </div>
                    </div>
                </div>

            </div>

            <div class="col-md-6">
                <div class="card p-2">
                    @php
                        $bulanPengunjung = [];
                        $totalPengunjung = [];
                        foreach ($totalPengunjungPerBulan as $tp) {
                            $bulanPengunjung[] = $tp->bulan . ' ' . $tp->tahun;
                            $totalPengunjung[] = $tp->total;
                        }
                    @endphp
                    <div class="card-header pb-0 p-3">
                        <h6 class="mb-0">Total Pengunjung Per Bulan</h6>
                        <div class="card-body pb-0 p-3">
                            <div id="pengunjungChart" style="height: 400px;"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            Highcharts.chart('bukuChart', {
                chart: {
                    type: 'column'
                },
                title: {
                    text: 'Buku Masuk per Bulan'
                },
                xAxis: {
                    categories: @json($bulan),
                    crosshair: true
                },
                yAxis: {
                    min: 0,
                    title: {
                        text: 'Total Buku'
                    }
                },
                series: [{
                    name: 'Total',
                    data: @json($total),
                    color: '#0d6efd',
                    dataLabels: {
                        enabled: true,
                        format: '{point.y}'
                    }
                }]
            });
        });

        document.addEventListener("DOMContentLoaded", function() {
            Highcharts.chart('pengunjungChart', {
                chart: {
                    type: 'column'
                },
                title: {
                    text: 'Total Pengunjung per Bulan'
                },
                xAxis: {
                    categories: @json($bulanPengunjung),
                    crosshair: true
                },
                yAxis: {
                    min: 0,
                    title: {
                        text: 'Total Pengunjung'
                    }
                },
                series: [{
                    name: 'Total',
                    data: @json($totalPengunjung),
                    color: '#dc3545',
                    dataLabels: {
                        enabled: true,
                        format: '{point.y}'
                    }
                }]
            });
        });

        $(document).ready(function() {
            $('#daterange').daterangepicker({
                autoUpdateInput: false,
                locale: {
                    format: 'YYYY-MM-DD',
                    separator: ' - ',
                    applyLabel: 'Apply',
                    cancelLabel: 'Cancel',
                    fromLabel: 'From',
                    toLabel: 'To',
                    customRangeLabel: 'Custom',
                    weekLabel: 'W',
                    daysOfWeek: ['Su', 'Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa'],
                    monthNames: [
                        'January', 'February', 'March', 'April', 'May', 'June', 'July',
                        'August', 'September', 'October', 'November', 'December'
                    ],
                    firstDay: 1
                },
                ranges: {
                    'Today': [moment(), moment()],
                    'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                    'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                    'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                    'This Month': [moment().startOf('month'), moment().endOf('month')],
                    'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1,
                        'month').endOf('month')],
                    'Reset': []
                },
            });

            $('#daterange').on('apply.daterangepicker', function(ev, picker) {
                const label = picker.chosenLabel;

                if (label === 'Reset') {
                    $(this).val('');
                    $(this).closest('form').submit();
                } else {
                    $(this).val(
                        picker.startDate.format('YYYY-MM-DD') + ' - ' + picker.endDate.format(
                            'YYYY-MM-DD')
                    );
                    $(this).closest('form').submit();
                }
            });

            $('#daterange').on('cancel.daterangepicker', function(ev, picker) {
                $(this).val('');
            });
        });
    </script>
@endsection
