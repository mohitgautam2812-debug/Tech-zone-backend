<x-app-layout>
    <div class="dashboard-header">
        <h4>Welcome back, {{ auth()->user()->name }}</h4>

        <div class="bg-white px-3 py-2 rounded shadow">
            Hi {{ auth()->user()->name }}
        </div>
    </div>


    <!-- Cards -->
    <div class="row g-3 mb-4">
        <div class="col-md-3">
            <div class="stat-card shadow-soft">
                <p>Visitors</p>
                <h3>10</h3>
            </div>
        </div>

        <div class="col-md-3">
            <div class="stat-card shadow-soft">
                <p>Total Users</p>
                <h3>1</h3>
            </div>
        </div>

        <div class="col-md-3">
            <div class="stat-card shadow-soft">
                <p>Floor Plans</p>
                <h3>6</h3>
            </div>
        </div>

        <div class="col-md-3">
            <div class="stat-card shadow-soft">
                <p>Our Blogs</p>
                <h3>4</h3>
            </div>
        </div>
    </div>


    <div class="row g-3 mb-4">


        <div class="col-md-6">
            <div class="chart-box shadow-soft">
                <div class="chart-title">Sales Overview</div>
                <canvas id="barChart"></canvas>
            </div>
        </div>


        <div class="col-md-6">
            <div class="chart-box shadow-soft">
                <div class="chart-title">New Enquiries</div>
                <canvas id="lineChart"></canvas>
            </div>
        </div>

    </div>

    <!-- Notification -->
    <div class="notification-box shadow-soft">
        <h6>Team Notifications</h6>
        <p class="text-muted">No new notifications</p>
    </div>

    </div>
    </div>

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        new Chart(document.getElementById('barChart'), {
            type: 'bar',
            data: {
                labels: ['Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct'],
                datasets: [
                    {
                        label: 'Sales',
                        data: [20, 30, 50, 40, 35, 60, 45, 70, 50],
                        backgroundColor: '#4CAF50'

                    },
                    {
                        label: 'Revenue',
                        data: [10, 20, 40, 30, 25, 50, 35, 60, 45],
                        backgroundColor: '#2196F3'

                    },
                    {
                        label: 'Profit',
                        data: [5, 15, 25, 20, 18, 35, 25, 40, 30],
                        backgroundColor: '#FFC107'
                    }
                ]
            }
        });

        new Chart(document.getElementById('lineChart'), {
            type: 'line',
            data: {
                labels: ['10', '11', '12', '1', '2', '3'],
                datasets: [
                    {
                        label: 'Enquiries',
                        data: [10, 20, 15, 25, 30, 20],
                        borderColor: '#4CAF50',
                        backgroundColor: 'rgba(76, 175, 80, 0.2)',
                        fill: true

                    },
                    {
                        label: 'Resolved',
                        data: [5, 15, 10, 20, 25, 15],
                        borderColor: '#2196F3',
                        backgroundColor: 'rgba(33, 150, 243, 0.2)',
                        fill: true

                    }
                ]
            }
        });
    </script>

</x-app-layout>