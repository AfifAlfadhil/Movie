<x-layout>

<x-slot:title>Daftar Show</x-slot:title>
<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f9fafb;
        margin: 0;
        padding: 0;
    }

    .show-list {
        max-width: 800px;
        margin: 20px auto;
        padding: 0 20px;
    }

    .show-item {
        border-bottom: 1px solid #e5e7eb;
        padding: 15px 0;
    }

    .show-item h2 {
        font-size: 1.5em;
        margin: 0;
        color: #1f2937;
    }

    .show-item p {
        margin: 5px 0;
        color: #6b7280;
    }

    .show-item span {
        font-size: 0.9em;
        background-color: #ef4444;
        color: white;
        padding: 2px 6px;
        border-radius: 3px;
    }

    .pagination {
        display: flex;
        justify-content: center;
        margin: 20px 0;
    }

    .pagination a, .pagination span {
        margin: 0 5px;
        padding: 4px 6px;
        text-decoration: none;
        font-size: 0.9em;
        color: #374151; /* Warna teks default */
        background-color: transparent; /* Hapus background */
        border: none; /* Hapus border */
        border-radius: 2px; /* Opsional: tetap gunakan jika ingin sudut melengkung */
    }

    .pagination a:hover {
        background-color:rgb(160, 160, 160);
        color: white;
    }

    .pagination .active span {
        border: 1px rgb(255, 255, 255);
        border-radius: 2px;
        background-color:rgb(180, 180, 180);
        color: white;
        pointer-events: none;
    }


    /* Tambahkan gaya untuk filter dropdown */
    .filter-form {
        max-width: 800px;
        margin: 20px auto;
        padding: 10px 20px;
        background-color: #f3f4f6;
        border: 1px solid #e5e7eb;
        border-radius: 8px;
    }

    .filter-form select {
        padding: 8px;
        border: 1px solid #d1d5db;
        border-radius: 4px;
        font-size: 1em;
    }

    .filter-form button {
        padding: 8px 16px;
        background-color: #4f46e5;
        color: white;
        border: none;
        border-radius: 4px;
        font-size: 1em;
        cursor: pointer;
    }

    .filter-form button:hover {
        background-color: #4338ca;
    }
</style>


<!-- Filter Form -->
<div class="filter-form">
    <form action="{{ route('show') }}" method="GET">
        <label for="genre">Filter by Genre:</label>
        <select name="genre" id="genre">
            <option value="">-- All Genres --</option>
            @foreach($genres as $genre)
                <option value="{{ $genre->genre_name }}" {{ $selectedGenre == $genre->genre_name ? 'selected' : '' }}>
                    {{ $genre->genre_name }}
                </option>
            @endforeach
        </select>
        <button type="submit">Apply Filter</button>
    </form>
</div>


<!-- Show List -->
<div class="show-list">
    @foreach($shows as $daftar)
        <div class="show-item" data-type="{{ $daftar->type_name }}">
            <a href="{{ route('shows.detail', ['show_id' => $daftar->show_id]) }}">
                <h2>{{ $daftar->primary_title }}</h2>
            </a>
            <p>ID: {{ $daftar->show_id }}</p>
            <p>Genres: {{ $daftar->genres }}</p>
            <p>Duration: {{ $daftar->episode_run_time }} mins</p>
            <p>Type: {{ $daftar->type_name }}</p>
            @if ($daftar->adult)
                <span>R18</span>
            @endif
        </div>
    @endforeach
</div>

<div class="pagination">
    {{ $shows->links() }}
</div>

</x-layout>
