@extends('layouts.header_footer')

@section('content')

<div class="topic-container">
    <h1>Topicos</h1>
    <a href="{{ route('createTopic')}}" class="topic-btn">Crie um Topico Novo</a>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Description</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($Topics as $topic)
                <tr>
                    <td>{{ $topic->id }}</td>
                    <td>{{ $topic->title }}</td>
                    <td>{{ $topic->description }}</td>
                    <td>
                        <a href="{{ route('listTopicById', $topic->id) }}" class="btn btn-info">View</a>
                        <a href="{{ route('editTopic', $topic->id) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('deleteTopic', $topic->id) }}" method="GET" style="display:inline-block;">
                            @csrf
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection