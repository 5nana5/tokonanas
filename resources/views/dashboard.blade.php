@extends('layouts.admin')

@section('page_title', 'Dashboard')

@push('css')
<style>
    .dashboard-header {
        background: #111827;
        color: #fef3c7;
        border-radius: 0.75rem;
        padding: 1.5rem;
        overflow: hidden;
    }

    .dashboard-header .dashboard-keyword {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        font-size: 1rem;
        color: #fbbf24;
    }

    .dashboard-card {
        border: 1px solid #e5e7eb;
        border-radius: 1rem;
        min-height: 160px;
    }

    .dashboard-card .card-body {
        padding: 1.5rem;
    }

    .dashboard-card .metric-label {
        color: #6b7280;
        font-size: 0.95rem;
        margin-bottom: 0.75rem;
        letter-spacing: 0.02em;
    }

    .dashboard-card .metric-value {
        font-size: 2.5rem;
        font-weight: 700;
        color: #111827;
    }

    .dashboard-card .metric-value--gold {
        color: #b45309;
    }

    .dashboard-box {
        border-radius: 1rem;
        background: #ffffff;
        border: 1px solid #e5e7eb;
        padding: 1.5rem;
        min-height: 320px;
    }

    .dashboard-box h5 {
        font-weight: 700;
        color: #111827;
        margin-bottom: 1rem;
    }

    .dashboard-box canvas {
        width: 100% !important;
        height: 280px !important;
    }

    .empty-state {
        min-height: 280px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #6b7280;
        font-size: 1rem;
        font-weight: 600;
    }
</style>
@endpush

@section('content')
<div class="row mb-4">
    <div class="col-12">
        <div class="dashboard-header">
            <div class="d-flex justify-content-between align-items-start flex-wrap gap-3">
                <div>
                        <div class="dashboard-keyword"><i class="fas fa-chart-line"></i> Sales Dashboard</div>
                        <h1 class="mb-2" style="font-size: 2rem; font-weight: 700; letter-spacing: -0.03em;">Operational Summary</h1>
                        <p class="text-muted" style="max-width: 38rem;">View sales performance, revenue, and marketing activity at a glance.</p>
                </div>
                <div class="text-right">
                    <div class="text-muted">Current Time</div>
                    <div id="local-clock" class="h3 font-weight-bold" style="color: #fbbf24;"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-2 col-md-4 col-sm-6 mb-4">
        <div class="dashboard-card bg-white shadow-sm">
            <div class="card-body">
                <div class="metric-label">Marketing Users</div>
                <div class="metric-value metric-value--gold">{{ number_format($userMarketingsCount) }}</div>
            </div>
        </div>
    </div>
    <div class="col-lg-2 col-md-4 col-sm-6 mb-4">
        <div class="dashboard-card bg-white shadow-sm">
            <div class="card-body">
                <div class="metric-label">Customer</div>
                <div class="metric-value">{{ number_format($customersCount) }}</div>
            </div>
        </div>
    </div>
    <div class="col-lg-2 col-md-4 col-sm-6 mb-4">
        <div class="dashboard-card bg-white shadow-sm">
            <div class="card-body">
                <div class="metric-label">Products</div>
                <div class="metric-value">{{ number_format($productsCount) }}</div>
            </div>
        </div>
    </div>
    <div class="col-lg-2 col-md-4 col-sm-6 mb-4">
        <div class="dashboard-card bg-white shadow-sm">
            <div class="card-body">
                <div class="metric-label">Transactions</div>
                <div class="metric-value">{{ number_format($transaksisCount) }}</div>
            </div>
        </div>
    </div>
    <div class="col-lg-4 col-md-8 col-sm-12 mb-4">
        <div class="dashboard-card bg-white shadow-sm">
            <div class="card-body">
                <div class="metric-label">Total Revenue</div>
                <div class="metric-value metric-value--gold">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-6 mb-4">
        <div class="dashboard-box shadow-sm">
            <h5>Payment Status</h5>
            @if(array_sum($paymentStatusCounts) > 0)
                <canvas id="paymentStatusChart"></canvas>
            @else
                <div class="empty-state">No data yet</div>
            @endif
        </div>
    </div>

    <div class="col-lg-6 mb-4">
        <div class="dashboard-box shadow-sm">
            <h5>7-Day Revenue Trend</h5>
            @if(array_sum($revenueTrendData) > 0)
                <canvas id="revenueChartCanvas"></canvas>
            @else
                <div class="empty-state">No data yet</div>
            @endif
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-6 mb-4">
        <div class="dashboard-box shadow-sm">
            <h5>Top Products</h5>
            @if($topProducts->count() > 0)
                <canvas id="topProductsChart"></canvas>
            @else
                <div class="empty-state">No data yet</div>
            @endif
        </div>
    </div>

    <div class="col-lg-6 mb-4">
        <div class="dashboard-box shadow-sm">
            <h5>Marketing User Performance</h5>
            @if($userMarketingPerformance->count() > 0)
                <canvas id="userMarketingChart"></canvas>
            @else
                <div class="empty-state">No data yet</div>
            @endif
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        function updateClock () {
            var el = document.getElementById('local-clock');
            if (!el) return;
            el.innerText = new Date().toLocaleString('en-US', {
                weekday: 'long',
                day: '2-digit',
                month: 'long',
                year: 'numeric',
                hour: '2-digit',
                minute: '2-digit',
                second: '2-digit'
            });
        }
        updateClock();
        setInterval(updateClock, 1000);

        if (typeof Chart !== 'undefined') {
            var paymentStatusChart = document.getElementById('paymentStatusChart');
            if (paymentStatusChart) {
                new Chart(paymentStatusChart, {
                    type: 'doughnut',
                    data: {
                        labels: ['Paid', 'Pending', 'Cancelled'],
                        datasets: [{
                            data: [
                                {{ $paymentStatusCounts['paid'] ?? 0 }},
                                {{ $paymentStatusCounts['pending'] ?? 0 }},
                                {{ $paymentStatusCounts['cancelled'] ?? 0 }}
                            ],
                            backgroundColor: ['#fbbf24', '#d97706', '#6b7280'],
                            borderColor: '#ffffff',
                            borderWidth: 2
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                position: 'bottom',
                                labels: { color: '#374151' }
                            }
                        }
                    }
                });
            }

            var revenueChart = document.getElementById('revenueChartCanvas');
            if (revenueChart) {
                new Chart(revenueChart, {
                    type: 'line',
                    data: {
                        labels: {!! json_encode($revenueTrendLabels) !!},
                        datasets: [{
                            label: 'Revenue',
                            data: {!! json_encode($revenueTrendData) !!},
                            borderColor: '#b45309',
                            backgroundColor: 'rgba(251, 191, 36, 0.16)',
                            fill: true,
                            tension: 0.35,
                            borderWidth: 3,
                            pointRadius: 4,
                            pointBackgroundColor: '#f59e0b'
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                display: false
                            }
                        },
                        scales: {
                            x: {
                                ticks: { color: '#6b7280' },
                                grid: { color: 'rgba(229,231,235,0.5)' }
                            },
                            y: {
                                beginAtZero: true,
                                ticks: { color: '#6b7280' },
                                grid: { color: 'rgba(229,231,235,0.5)' }
                            }
                        }
                    }
                });
            }

            var topProductsChart = document.getElementById('topProductsChart');
            if (topProductsChart) {
                new Chart(topProductsChart, {
                    type: 'bar',
                    data: {
                        labels: {!! json_encode($topProducts->pluck('name')) !!},
                        datasets: [{
                            label: 'Sales',
                            data: {!! json_encode($topProducts->pluck('sales')) !!},
                            backgroundColor: '#f59e0b',
                            borderColor: '#b45309',
                            borderWidth: 1
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: { display: false }
                        },
                        scales: {
                            x: {
                                ticks: { color: '#4b5563' },
                                grid: { display: false }
                            },
                            y: {
                                beginAtZero: true,
                                ticks: { color: '#4b5563' },
                                grid: { color: 'rgba(229,231,235,0.5)' }
                            }
                        }
                    }
                });
            }

            var userMarketingChart = document.getElementById('userMarketingChart');
            if (userMarketingChart) {
                new Chart(userMarketingChart, {
                    type: 'bar',
                    data: {
                        labels: {!! json_encode($userMarketingPerformance->pluck('name')) !!},
                        datasets: [{
                            label: 'Transactions',
                            data: {!! json_encode($userMarketingPerformance->pluck('transactions')) !!},
                            backgroundColor: '#4b5563',
                            borderColor: '#111827',
                            borderWidth: 1
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: { display: false }
                        },
                        scales: {
                            x: {
                                ticks: { color: '#4b5563' },
                                grid: { display: false }
                            },
                            y: {
                                beginAtZero: true,
                                ticks: { color: '#4b5563' },
                                grid: { color: 'rgba(229,231,235,0.5)' }
                            }
                        }
                    }
                });
            }
        }
    });
</script>
@endpush

