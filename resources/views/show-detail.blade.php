<x-layout>
    <x-slot:title>Detail</x-slot:title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $shows->show_id }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f0f4fc;
        }

        .container {
            max-width: 1200px;
            margin: 40px auto;
            padding: 20px;
            background: white;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .container h2 {
            font-size: 1.5em;
            margin: 0;
            color: #1f2937;
        }

        .container p {
            margin: 5px 0;
            color: #6b7280;
        }

        .container span {
            font-size: 0.9em;
            background-color: #ef4444;
            color: white;
            padding: 2px 6px;
            border-radius: 3px;
        }

        h1 {
            color: #333;
        }

        p {
            line-height: 1.6;
        }

        .badge {
            display: inline-block;
            background: #e63946;
            color: white;
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 0.8em;
            margin-top: 10px;
        }
    </style>

    <div class="container">
        <h1>Title : {{ $shows->primary_title }}</h1>
        <p>ID: {{ $shows->show_id }}</p>
        <p>Genres: {{ $shows->genres }}</p>
        <p>Duration: {{ $shows->episode_run_time }} mins</p>
        <p>Type: {{ $shows->type_name }}</p>
        @if ($shows->adult)
            <span>R18</span>
        @endif
    </div>


</x-layout>
