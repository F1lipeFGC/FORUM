@extends('layouts.header_footer')

@section('content')
<link rel="stylesheet" href="{{ asset('css/login.css') }}">
<div class="container d-flex justify-content-center align-items-center flex-column" style="min-height: 100vh;">
    
    <span>{{ session('message') }}</span>
    @if($topic != null)
    <form action="{{ route('UpdateTopic', [$topic->id]) }}" method="POST" class="itemX">
        <h2 class="item2">Editar Topico</h2>
        @csrf
        @method('put')
        <div class="item2">
            
            <label for="title" class="form-label">Título:</label>
            <input type="text" id="title" name="title" class="form-control" value="{{ $topic->title }}" required>

            <label for="description" class="form-label">Descrição:</label>
            <input type="text" id="description" name="description" class="form-control" value="{{ $topic->description }}" required>

            <label for="status" class="form-label">Status:</label>
            <input type="text" id="status" name="status" class="form-control" value="{{ $topic->status }}" required>

            <select  type="" id="category_id" name="category_id" value="{{ old('category') }}" required>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" {{ $topic->category_id == $category->id ? 'selected' : '' }}>
                        {{ $category->title }}
                    </option>
                @endforeach
            </select>

            <select name="tags[]" id="tags" multiple>
                @foreach($tags as $tag)
                    <option value="{{ $tag->id }}" {{ in_array($tag->id, $topic->tags->pluck('id')->toArray()) ? 'selected' : '' }}>
                        {{ $tag->title }}
                    </option>
                @endforeach
            </select>
            
            @error('name') <span>{{ $message }}</span> @enderror
        </div>
    
    
        <input type="submit" class="item4 button" value="Enviar">
    </form>

    <form action="{{ route('DeleteTopic', [$topic->id]) }}" method="POST">
        @csrf
        @method('DELETE')
        <button type="submit" class="item4 button">Deletar</button>
    </form>
    @endif
</div>
@endsection