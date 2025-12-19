@extends('layouts.main')
@section('content')
    <div class="container my-4">
        <h4>Report Mingguan</h4>

        <div class="row mb-3">
            <div class="col-md-12">
                <div class="card p-2 shadow">
                    <form method="GET" action="{{ url('/report-mingguan') }}"
                        class="d-flex justify-content-end align-items-center mb-3" id="filterForm">
                        <label for="daterange" class="form-label me-2 fw-semibold mb-0">Daterange</label>
                        <input type="text" id="daterange" name="daterange" class="form-control me-2"
                            value="{{ $date_range ?? '' }}" placeholder="YYYY-MM-DD - YYYY-MM-DD" autocomplete="off" />
                    </form>
                </div>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-12">
                <div class="card p-2">
                    <div class="card-header">
                        <h5 class="card-title">Report Denda Per Minggu</h5>
                    </div>

                    <div class="card-body">
                        @php
                            $tahun_minggu = [];
                            $total_denda_minggu = [];
                            foreach ($reportMinggu as $rb) {
                                $tahun_minggu[] = $rb->tahun_minggu;
                                $total_denda_minggu[] = $rb->total_denda_minggu;
                            }
                        @endphp
                        <div id="mingguChart" style="height: 400px;"></div>
                    </div>
                </div>
            </div>

        </div>



    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            Highcharts.chart('mingguChart', {
                chart: {
                    type: 'column'
                },
                title: {
                    text: 'Denda per Minggu'
                },
                xAxis: {
                    categories: @json($tahun_minggu),
                    crosshair: true
                },
                yAxis: {
                    min: 0,
                    title: {
                        text: 'Total Denda'
                    }
                },
                series: [{
                    name: 'Total',
                    data: @json($total_denda_minggu),
                    color: '#a1303c',
                    dataLabels: {
                        enabled: true,
                        format: '{point.y}'
                    }
                }]
            });

        });


        // daterange
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
