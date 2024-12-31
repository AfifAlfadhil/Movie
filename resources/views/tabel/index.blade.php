<x-layout>

<style>
    .container {
        background: #fff;
        border-radius: 8px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        width: 100%;
        max-width: 1200px;
        padding: 20px;
    }

    .container h2 {
        margin: 0 0 10px;
    }

    .container p {
        color: #6b7280;
        margin: 0 0 20px;
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    thead {
        background-color: #f3f4f6;
    }

    th, td {
        text-align: left;
        padding: 10px;
        border-bottom: 1px solid #e5e7eb;
    }

    th {
        color: #4b5563;
        font-weight: bold;
    }

    td {
        color: #374151;
    }

    .role-admin {
        color: #2563eb;
    }

    .role-owner {
        color: #047857;
    }

    .role-member {
        color: #6b7280;
    }

    /* Styling for the Create button */
    .add-user {
        display: inline-block;
        background-color: #6366f1;
        color: #fff;
        text-decoration: none;
        padding: 10px 20px;
        border-radius: 5px;
        font-weight: bold;
        float: right;
        margin-right: 60px;
        margin-bottom: 20px;
        transition: background-color 0.3s ease;
    }

    .add-user:hover {
        background-color: #4f46e5;
    }

    /* Styling for action buttons (Edit and Delete) */
    .btn {
        padding: 6px 12px;
        font-size: 0.875rem;
        font-weight: 600;
        border-radius: 5px;
        border: none;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .btn-warning {
        background-color: #fbbf24;
        color: #fff;
    }

    .btn-warning:hover {
        background-color: #f59e0b;
    }

    .btn-danger {
        background-color: #ef4444;
        color: #fff;
    }

    .btn-danger:hover {
        background-color: #dc2626;
    }

    /* Pagination */
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
        color: #374151;
        background-color: transparent;
        border: none;
        border-radius: 2px;
    }

    .pagination a:hover {
        background-color: rgb(160, 160, 160);
        color: white;
    }

    .pagination .active span {
        color: #ffffff;
        background-color: #374151;
        border-radius: 5px;
    }
</style>

<div class="container">
    <a href="{{ route('tabel.create') }}" class="add-user">Add Show</a>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Adult</th>
                <th>Run Time</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($shows as $show)
                <tr>
                    <td>{{ $show->show_id }}</td>
                    <td>{{ $show->primary_title }}</td>
                    <td>{{ $show->adult ? 'Yes' : 'No' }}</td>
                    <td>{{ $show->episode_run_time }}</td>
                    <td>
                        <a href="{{ route('tabel.edit', $show->show_id) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('tabel.destroy', $show->show_id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="pagination">
        {{ $shows->links() }}
    </div>
</div>

</x-layout>
