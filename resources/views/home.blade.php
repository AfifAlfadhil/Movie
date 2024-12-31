<x-layout>

<x-slot:title>Home Page</x-slot:title>

<style>
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        background-color: #f0f4fc;
    }

    .header {
        text-align: left;
        font-size: 2.5em;
        font-weight: bold;
        margin: 20px;
        color: #333;
    }

    .recommendations {
        overflow-x: auto;
        white-space: nowrap;
        padding: 10px;
    }

    .grid-container {
        display: flex;
        gap: 20px;
    }

    .card {
        flex: 0 0 300px;
        height: auto;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        color: white;
        background: linear-gradient(135deg, #88c0f0, #4a90e2);
        text-align: left;
        text-decoration: none;
        transition: transform 0.2s;
        overflow: hidden;
        position: relative;
    }

    .card:hover {
        transform: scale(1.05);
    }

    .card h2 {
        font-size: 1.5em;
        margin: 0 0 10px;
        font-weight: bold;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .card h2.animated {
        animation: marquee 8s linear infinite;
    }

    @keyframes marquee {
        0% {
            transform: translateX(100%);
        }
        100% {
            transform: translateX(-100%);
        }
    }

    .card .flag {
        font-size: 0.9em;
        font-weight: bold;
        color: white;
        background: rgba(0, 0, 0, 0.3);
        padding: 5px 10px;
        border-radius: 12px;
        display: inline-block;
        margin-bottom: 10px;
    }

    .card p {
        font-size: 1em;
        margin: 0 0 10px;
    }

    .card .rating {
        font-size: 1.1em;
        font-weight: bold;
        color: #ffd700; /* Gold for star icon */
    }

    .card span {
        font-size: 0.8em;
        background: rgba(0, 0, 0, 0.3);
        padding: 4px 8px;
        border-radius: 4px;
    }

    .all-shows-button {
        display: block;
        margin: 20px auto;
        padding: 10px 0;
        width: 300px;
        font-size: 1em;
        color: white;
        background-color: #4a90e2;
        border: none;
        border-radius: 8px;
        text-align: center;
        text-decoration: none;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        transition: background-color 0.2s, transform 0.2s;
    }

    .all-shows-button:hover {
        background-color: #3a78c2;
        transform: scale(1.05);
    }
</style>

<div class="header">Rekomendasi</div>

<div class="recommendations">
    <div class="grid-container">
        @foreach($daftar as $daftar)
            <a href="{{ route('shows.detail', ['show_id' => $daftar->show_id]) }}" class="card">
                <div class="flag">{{ $daftar->type_name }}</div>
                <h2 class="{{ strlen($daftar->primary_title) > 20 ? 'animated' : '' }}">{{ $daftar->primary_title }}</h2>
                <p><strong>Genre:</strong> {{ $daftar->genres }}</p>
                <p class="rating">⭐ {{ number_format($daftar->vote_average, 1) }}/10</p>
                @if ($daftar->adult)
                    <span>R18</span>
                @endif
            </a>
        @endforeach
    </div>
</div>

<a href="/show" class="all-shows-button">All Shows</a>

</x-layout>
