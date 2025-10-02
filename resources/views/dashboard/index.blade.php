@extends('home')

@section('css_before')
@endsection

@section('header')
@endsection

@section('sidebarMenu')
@endsection

@section('content')

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<div class="container mt-4">
  <!-- 1 คอลฯ บนมือถือ, 2 คอลฯ บนจอกลาง, 3 คอลฯ บนจอใหญ่ -->
  <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">

    <div class="col">
      <div class="card h-100 rounded-3 p-3">
        <div class="d-flex justify-content-between align-items-center">
          <div>
            <h4 class="mb-1">Staffs</h4>
            <h5 class="mb-0">{{ number_format($countAdmin) }} lists</h5>
          </div>
          <div class="stat-icon bg-dark text-white rounded-3 d-flex align-items-center justify-content-center">
            <img src="{{ asset('asset/icon/staffIcon.png') }}" alt="Staff Icon" width="50">
          </div>
        </div>
      </div>
    </div>

    <div class="col">
      <div class="card h-100 rounded-3 p-3">
        <div class="d-flex justify-content-between align-items-center">
          <div>
            <h4 class="mb-1">Members</h4>
            <h5 class="mb-0">{{ number_format($countMember) }} lists</h5>
          </div>
          <div class="stat-icon bg-dark text-white rounded-3 d-flex align-items-center justify-content-center">
            <img src="{{ asset('asset/icon/staffIcon.png') }}" alt="Member Icon" width="50">
          </div>
        </div>
      </div>
    </div>

    <div class="col">
      <div class="card h-100 rounded-3 p-3">
        <div class="d-flex justify-content-between align-items-center">
          <div>
            <h4 class="mb-1">Products</h4>
            <h5 class="mb-0">{{ number_format($countProduct) }} Sku</h5>
          </div>
          <div class="stat-icon bg-dark text-white rounded-3 d-flex align-items-center justify-content-center">
            <img src="{{ asset('asset/icon/foodIcon.png') }}" alt="Product Icon" width="50">
          </div>
        </div>
      </div>
    </div>

    <div class="col">
      <div class="card h-100 rounded-3 p-3">
        <div class="d-flex justify-content-between align-items-center">
          <div>
            <h4 class="mb-1">Pets</h4>
            <h5 class="mb-0">{{ number_format($countPet) }}</h5>
          </div>
          <div class="stat-icon bg-dark text-white rounded-3 d-flex align-items-center justify-content-center">
            <img src="{{ asset('asset/icon/petIcon.png') }}" alt="Pet Icon" width="50">
          </div>
        </div>
      </div>
    </div>

    <div class="col">
      <div class="card h-100 rounded-3 p-3">
        <div class="d-flex justify-content-between align-items-center">
          <div>
            <h4 class="mb-1">Total Views</h4>
            <h5 class="mb-0">{{ number_format($countView) }} views</h5>
          </div>
          <div class="stat-icon bg-dark text-white rounded-3 d-flex align-items-center justify-content-center">
            <img src="{{ asset('asset/icon/viewIcon.png') }}" alt="View Icon" width="50">
          </div>
        </div>
      </div>
    </div>

  </div>
</div>


<!-- Start Chart -->
<div class="container mt-4">
    <div class="row">
        <div class="col-md-6">
            <h2>Website Views</h2>
            <canvas id="barChart" width="300" height="300"></canvas>
            <script>
                const barChartctx = document.getElementById('barChart').getContext('2d');

                const barChart = new Chart(barChartctx, {
                    type: 'bar',
                    data: {
                        labels: {!! json_encode($weeklyLabels) !!}, // ["Sunday", "Monday", ...]
                        datasets: [{
                            label: 'จำนวนเข้าชมเว็บไซต์รายวัน',
                            data: {!! json_encode($weeklyData) !!},
                            borderColor: '#6d4c41',
                            backgroundColor: ['#FFADAD','#FDFFB6','#FFD6E0','#CAFFBF','#FFD6A5','#A0C4FF','#BDB2FF'],
                            tension: 0.3,
                            fill: true
                        }]
                    },
                    options: {
                        responsive: true,
                        plugins: {
                            legend: {
                                display: true,
                                position: 'top'
                            },
                            tooltip: {
                                mode: 'index',
                                intersect: false
                            }
                        },
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });
            </script>
        </div>
        <!-- End Bar Chart -->

        <div class="col-md-6">
            <h2> Member </h2>
            <!-- แสดงกราฟ  -->
            <canvas id="pieChart" width="300" height="300"></canvas>
            <script>
                const pieChartctx = document.getElementById('pieChart').getContext('2d');

                const pieChart = new Chart(pieChartctx, {
                    type: 'pie',
                    data: {
                        labels: {!! json_encode($statusLabels) !!},
                        datasets: [{
                            label: 'จำนวนสมาชิก',
                            data: {!! json_encode($statusData) !!}, // labels = ['Member', 'Vip', 'No Status']
                            borderColor: '#6d4c41',
                            backgroundColor: ['#D7B49E','#b4b4b4ff','#ffe600ff'],
                            tension: 0.3,
                            fill: true,
                            pointRadius: 5,
                            pointHoverRadius: 7
                        }]
                    },
                    options: {
                        responsive: true,
                        plugins: {
                            legend: {
                                display: true,
                                position: 'top'
                            },
                            tooltip: {
                                mode: 'index',
                                intersect: false
                            }
                        },
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });
            </script>
        </div>
    </div>
</div>
<!-- End Chart -->

<!-- Start Line Chart -->
<div class="container mt-4">
    <div class="row">
        <div class="col-md-12">
            <h2> จำนวนการเข้าชมเว็บไซต์แต่ละเดือน </h2>
            <!-- แสดงกราฟ  -->
            <canvas id="lineChart" width="600" height="300"></canvas>
            <script>
                const ctx = document.getElementById('lineChart').getContext('2d');

                const lineChart = new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: {!! json_encode($monthlyLabels) !!}, // ['มกราคม-2025', 'กุมภาพันธ์-2025', ...]
                        datasets: [{
                            label: 'จำนวนเข้าชมเว็บไซต์ล่าสุด 12 เดือน',
                            data: {!! json_encode($monthlyData) !!}, // [123, 456, ...]
                            borderColor: '#6d4c41',
                            backgroundColor: '#D7B49E',
                            tension: 0.3,
                            fill: true,
                            pointRadius: 5,
                            pointHoverRadius: 7
                        }]
                    },
                    options: {
                        responsive: true,
                        plugins: {
                            legend: {
                                display: true,
                                position: 'top'
                            },
                            tooltip: {
                                mode: 'index',
                                intersect: false
                            }
                        },
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });
            </script>
        </div>
    </div>
</div>
<!-- End Line Chart -->

@endsection

@section('footer')
@endsection

@section('js_before')
@endsection

@section('js_before')
@endsection