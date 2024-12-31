<x-layout>
    <x-slot:title>New Page</x-slot:title>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>

    <div class="max-w-7xl mx-auto mt-8 flex space-x-8">

        <!-- Bagian Chart (Kiri) -->
        <div class="bg-white p-6 rounded-lg shadow-md w-2/3">
            <h2 class="text-2xl font-semibold text-center text-gray-800 mb-6">Birth and Death Data Over Years</h2>

            <canvas id="myChart" class="w-full h-80"></canvas>
        </div>

        <!-- Bagian Informasi (Kanan) -->
        <div class="bg-white p-6 rounded-lg shadow-md w-1/3">
            <h2 class="text-2xl font-semibold text-center text-gray-800 mb-6">Birth and Death Statistics</h2>

            <div class="mb-6 text-gray-700">
                <p><strong>Total Kelahiran (setelah 2000):</strong> {{ $totalBirth }}</p>
                <p><strong>Total Kematian (setelah 2000):</strong> {{ $totalDeath }}</p>
                <p><strong>Rata-Rata Kelahiran per Tahun:</strong> {{ number_format($avgBirth, 2) }}</p>
                <p><strong>Rata-Rata Kematian per Tahun:</strong> {{ number_format($avgDeath, 2) }}</p>
                <p><strong>Tahun dengan Kelahiran Terbanyak:</strong> {{ $maxBirthYear }}</p>
                <p><strong>Tahun dengan Kematian terbanyak:</strong> {{ $maxDeathYear }}</p>
            </div>
        </div>

    </div>

    <script>
        // Data dari server (diisi langsung sebagai JSON)
        const chartData = {
            xValues: @json(array_column($birth, 'birthYear')),
            birth: @json(array_column($birth, 'birth')),
            death: @json(array_column($death, 'death'))
        };

        // Membuat chart
        new Chart("myChart", {
            type: "line",
            data: {
                labels: chartData.xValues,
                datasets: [
                    {
                        label: "Birth Count",
                        data: chartData.birth,
                        borderColor: "green",
                        backgroundColor: "rgba(0, 255, 0, 0.1)",
                        borderWidth: 2,
                        fill: true
                    },
                    {
                        label: "Death Count",
                        data: chartData.death,
                        borderColor: "red",
                        backgroundColor: "rgba(255, 0, 0, 0.1)",
                        borderWidth: 2,
                        fill: true
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                legend: {
                    display: true,
                    position: "top",
                    labels: {
                        fontSize: 14,
                        fontColor: "#333"
                    }
                },
                title: {
                    display: true,
                    text: "Birth and Death Data Over Years",
                    fontSize: 18,
                    fontColor: "#333",
                    padding: 20
                },
                scales: {
                    xAxes: [{
                        ticks: {
                            fontSize: 12,
                            fontColor: "#333"
                        }
                    }],
                    yAxes: [{
                        ticks: {
                            beginAtZero: true,
                            fontSize: 12,
                            fontColor: "#333"
                        }
                    }]
                }
            }
        });
    </script>

</x-layout>
