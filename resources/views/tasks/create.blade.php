<!DOCTYPE html>
<html>
<head>
    <title>Create Task</title>
</head>
<body>
<h1>Create New Task</h1>

@if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{route('tasks.store')}}" method="POST">
    @csrf

    <div>
        <label for="name">Name:</label>
        <input type="text" name="name" id="name" value="{{ old('name') }}" required>
    </div>

    <div>
        <label for="description">Description:</label>
        <textarea name="description" id="description">{{ old('description') }}</textarea>
    </div>

    <div>
        <label>
            <input type="checkbox" name="completed" value="1" {{ old('completed') ? 'checked' : '' }}>
            Completed
        </label>
    </div>

    <button type="submit">Create Task</button>
    <a href="{{ route('tasks.index') }}">Cancel</a>
</form>
</body>
</html>
