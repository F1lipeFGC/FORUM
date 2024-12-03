@extends('layouts.header_footer')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
@endpush

@section('content')
<div class="container mt-5">
    @if ($topics->isEmpty())
        <div class="custom-alert-div">
            <div class="alert custom-alert">
                <i class="fa-solid fa-exclamation-circle"></i>
                Não há tópicos disponíveis.
            </div>
        </div>
    @else
        <div class="row g-4">
            @foreach ($topics as $topic)
                <div class="col-lg-4">
                    <div class="card h-100" style="max-width: 400px; margin: 0 auto;">
                        <div class="card-header">
                            <h5 class="text-truncate">{{ $topic->title }}</h5>
                        </div>

                        <div class="card-body" style="max-height: 300px; overflow: hidden;">
                            <p class="text-truncate">{{ $topic->description }}</p>
                            <p>Status: {{ $topic->status ? 'Ativo' : 'Inativo' }}</p>
                            <p>Categoria: {{ $topic->category->title ?? 'Sem categoria' }}</p>

                            <!-- Exibe as tags associadas -->
                            <p>Tags:
                                @forelse ($topic->tags as $tag)
                                    <span class="badge bg-secondary">{{ $tag->title }}</span>
                                @empty
                                    <span class="text-muted">Nenhuma tag</span>
                                @endforelse
                            </p>

                            <h6>Comentários:</h6>
                            @forelse ($topic->comments->take(2) as $comment)
                                <div class="comment mb-2">
                                    <p>
                                        <strong>{{ $comment->user->name ?? 'Usuário desconhecido' }}</strong>:
                                        {{ \Illuminate\Support\Str::limit($comment->content, 50, '...') }}
                                    </p>
                                    <p style="font-size: 0.8em; color: #6c757d;">({{ $comment->created_at->diffForHumans() }})</p>
                                </div>
                            @empty
                                <p class="text-muted">Nenhum comentário disponível.</p>
                            @endforelse
                            @if($topic->comments->count() > 2)
                                <p class="text-muted">+{{ $topic->comments->count() - 2 }} comentário(s) restante(s)...</p>
                            @endif
                        </div>


                        <div class="card-footer">
                            <div class="d-flex justify-content-between">
                                <a href="{{ route('listTopicById', $topic->id) }}" class="btn btn-primary">Ver Tópico</a>
                                <div class="d-flex">
                                    <a href="{{ route('topics.edit', $topic->id) }}" class="btn btn-warning me-2">Editar</a>
                                    <form action="{{ route('topics.delete', $topic->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Excluir</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection