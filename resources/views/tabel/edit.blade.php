<x-layout>

<x-slot:title>CRUD</x-slot:title>

<style>
    .container {
        background: #fff;
        border-radius: 8px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        width: 100%;
        max-width: 600px; /* Mengurangi ukuran container */
        padding: 20px;
        margin: 20px auto; /* Menempatkan container di tengah */
    }

    .container h2 {
        margin: 0 0 20px;
        font-size: 24px;
        color: #4b5563;
    }

    .form-group {
        margin-bottom: 15px;
    }

    .form-group label {
        display: block;
        font-weight: bold;
        margin-bottom: 5px;
        color: #4b5563;
    }

    .form-control {
        width: 100%;
        padding: 10px;
        border: 1px solid #e5e7eb;
        border-radius: 5px;
        font-size: 14px;
        color: #374151;
    }

    .form-control:focus {
        border-color: #6366f1;
        box-shadow: 0 0 5px rgba(99, 102, 241, 0.3);
    }

    button[type="submit"] {
        background-color: #6366f1;
        color: #fff;
        border: none;
        padding: 10px 20px;
        border-radius: 5px;
        font-weight: bold;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    button[type="submit"]:hover {
        background-color: #4f46e5;
    }
</style>

<div class="container">
    <h2>Edit Show</h2>
    <form action="{{ route('tabel.update', $show->show_id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="primary_title">Title</label>
            <input type="text" name="primary_title" class="form-control" value="{{ $show->primary_title }}" required>
        </div>
        <div class="form-group">
            <label for="adult">Adult</label>
            <select name="adult" class="form-control">
                <option value="0" {{ !$show->adult ? 'selected' : '' }}>No</option>
                <option value="1" {{ $show->adult ? 'selected' : '' }}>Yes</option>
            </select>
        </div>
        <div class="form-group">
            <label for="episode_run_time">Run Time</label>
            <input type="number" name="episode_run_time" class="form-control" value="{{ $show->episode_run_time }}" required>
        </div>
        <button type="submit">Update</button>
    </form>
</div>

</x-layout>
