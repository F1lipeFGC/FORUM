@extends('layouts.header_footer')

@section('content')

<div class="container">
        <div class="titleCreatePost">
            <h1>Crie Seus Posts</h1>
        </div>
        <div class="form-container">
                <form action="/submit-question" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="title">Título:</label>
                        <input type="text" id="title" name="title" required>
                    </div>
                    <div class="form-group">
                        <label for="question">Digite sua questão:</label>
                        <textarea id="question" name="question" rows="6" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="image">Adicionar imagem:</label>
                        <input type="file" id="image" name="image">
                    </div>
                    <div class="form-group">
                        <button type="submit">Criar</button>
                    </div>
                </form>
            </div>
</div>
@endsection
