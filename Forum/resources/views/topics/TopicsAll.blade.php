@extends('layouts.header_footer')

@section('content')
<div class="container mt-5">
    <h1 class="text-center mb-4">Forum Topics</h1>

    <!-- Botão para criar um novo tópico -->
    <div class="text-center mb-4">
        <a href="{{ route('createTopic') }}" class="btn btn-primary">Create New Topic</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success text-center">{{ session('success') }}</div>
    @endif

    <!-- Lista de tópicos -->
    <div class="d-flex flex-column align-items-center">
        @foreach($topics as $topic)
            <div class="card mb-3 w-75 shadow-sm">
                <!-- Header do tópico -->
                <a href="{{ route('listTopicById', $topic->id) }}" class="h5 text-decoration-none text-dark">
                    <div class="card-header d-flex justify-content-between align-items-center">
                            {{ $topic->title }}
                    </div>
                </a>

                <div class="card-body">
                    <p class="card-text">{{ Str::limit($topic->description, 100) }}</p>
                    <p class="text-muted">Category: {{ $topic->category->title }}</p>
                    <p class="text-muted">Status: {{ $topic->status == 1 ? 'Active' : 'Inactive' }}</p>

                    @if($topic->post && $topic->post->image)
                        <img src="{{ asset('img/' . $topic->post->image) }}" alt="Topic Image" class="img-fluid mt-3" style="max-height: 150px; object-fit: cover;">
                    @else
                        <p class="text-muted mt-3">No Image</p>
                    @endif

                    <!-- Exibição das tags -->
                    <div class="mt-3">
                        <strong>Tags:</strong>
                        @foreach($topic->tags as $tag)
                            <span class="badge bg-secondary">{{ $tag->title }}</span>
                        @endforeach
                    </div>
                    <br>
                </div>
                 <div class="card-footer">
                    <h6>Comentários:</h6>
                    @foreach ($topic->comments as $comment)
                        <div class="comment">
                            <p><strong>{{  $comment->post->user->name ?? 'Usuário desconhecido' }}</strong> disse:</p>
                        <p>{{ $comment->content }}</p>
                        <p class="text-sm text-gray-500">{{ $comment->created_at->diffForHumans() }}</p>
                        </div>
                    @endforeach

                    <form action="{{ route('CreateComment', ['topicId' => $topic->id]) }}" method="POST" class="mt-3">
                        @csrf
                        <div class="form-group">
                            <textarea name="content" class="form-control" rows="2" placeholder="Adicionar um comentário" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-success mt-2">Comentar</button>
                    </form>
                </div>
            </div> 
        @endforeach
    </div>

    @if($topics->isEmpty())
        <p class="text-center">No topics available. <a href="{{ route('createTopic') }}">Create one now</a>.</p>
    @endif
</div>
@endsection