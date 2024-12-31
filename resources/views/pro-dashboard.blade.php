<x-layout>
  <x-slot:title>Dashboard</x-slot:title>

  <!-- Memuat Google Charts -->
  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

  <div class="max-w-7xl mx-auto mt-8 flex space-x-8">

    <!-- Bagian Chart (Kiri) -->
    <div id="piechart" class="bg-white p-6 rounded-lg shadow-md w-2/3">
      <h2 class="text-2xl font-semibold text-center text-gray-800 mb-6">Jumlah Tayangan Berdasarkan Kategori</h2>
    </div>

    <script type="text/javascript">
      google.charts.load('current', { 'packages': ['corechart'] });
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        const rawData = @json($data);

        // Debug data untuk memastikan format benar
        console.log(rawData);

        const chartData = [['Category', 'Count']];

        if (Array.isArray(rawData)) {
          // Urutkan data berdasarkan count/jml secara menurun
          rawData.sort((a, b) => parseInt(b.jml || b.count, 10) - parseInt(a.jml || a.count, 10));

          // Ubah format data
          rawData.forEach(item => {
            chartData.push([item.genre_name || item.category, parseInt(item.jml || item.count, 10)]);
          });
        } else {
          console.error('Data is not in the expected format:', rawData);
          return;
        }

        console.log(chartData);

        const data = google.visualization.arrayToDataTable(chartData);

        const options = {
          title: 'Jumlah Tayangan Berdasarkan Kategori',
          width: 800,
          height: 600,
          is3D: true,
          backgroundColor: 'transparent', // Mengatur background menjadi transparan
          titleTextStyle: {
            fontSize: 24,
            bold: true,
            color: '#333',
            alignment: 'center'  // Menyelaraskan judul ke tengah
          }
        };
        console.log(data);
        const chart = new google.visualization.PieChart(document.getElementById('piechart'));
        chart.draw(data, options);
      }
    </script>

    <!-- Bagian Informasi Statistik (Kanan) -->
    <div class="bg-white p-6 rounded-lg shadow-md w-1/3">
      <h2 class="text-2xl font-semibold text-center text-gray-800 mb-6">Informasi Statistik</h2>

      <div class="mb-6 text-gray-700">      
      <!-- Informasi Statistik sebagai 3 kotak vertikal -->
      <div class="grid grid-cols-1 gap-6">
        <!-- Total Tayangan -->
        <div class="bg-white border rounded-lg shadow-md p-6">
          <h3 class="text-xl font-semibold text-gray-800">Total Tayangan</h3>
          <p class="text-2xl font-bold text-gray-900">{{ $count }}</p>
          <p class="text-gray-600 mt-2">Jumlah tayangan keseluruhan dari seluruh kategori genre.</p>
        </div>

        <!-- Kategori Terpopuler -->
        <div class="bg-white border rounded-lg shadow-md p-6">
          <h3 class="text-xl font-semibold text-gray-800">Kategori Terpopuler</h3>
          <p class="text-2xl font-bold text-gray-900">{{ $kategoriTerpopuler }}</p>
          <p class="text-gray-600 mt-2">Kategori genre dengan jumlah tayangan terbanyak.</p>
        </div>

        <!-- Rata-rata Tayangan per Kategori -->
        <div class="bg-white border rounded-lg shadow-md p-6">
          <h3 class="text-xl font-semibold text-gray-800">Rata-rata Tayangan per Kategori</h3>
          <p class="text-2xl font-bold text-gray-900">{{ number_format($rataRataTayangan, 0) }}</p>
          <p class="text-gray-600 mt-2">Rata-rata jumlah tayangan yang didapatkan per kategori genre.</p>
        </div>
      </div>
    </div>

  </div>

</x-layout>
