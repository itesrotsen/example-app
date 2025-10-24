<!DOCTYPE html>
<html>
<head>
    <title>Tasks</title>
</head>
<body>
<h1>Task List</h1>

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<a href="{{route('tasks.createForm')}}">Create New Task</a>

<table>
    <thead>
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Status</th>
        <th>Actions</th>
    </tr>
    </thead>
    <tbody>

    @forelse($tasks as $task)
        <tr>
            <td>{{ $task->id }}</td>
            <td>{{ $task->name }}</td>
            <td>{{ $task->completed ? 'Completed' : 'Pending' }}</td>
            <td>
                <a href="#">View</a>
                <a href="{{route('tasks.edit', $task->id)}}">Edit</a>
                <form action="{{route('tasks.destroy', $task->id)}}" method="POST" style="display:inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Delete</button>
                </form>
            </td>
        </tr>
    @empty
        <tr>
            <td colspan="4">No tasks found</td>
        </tr>
    @endforelse
    </tbody>
</table>
</body>
</html>

