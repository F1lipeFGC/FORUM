@extends('layouts.header_footer')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/profile.css') }}">
    <div class="profile-container">
        @if ($user != null)
            <form action="{{ route('updateUser', [$user->id]) }}" method="POST" class="profile-form" enctype="multipart/form-data">
                @csrf
                @method('put')
                <h2 class="text-center">Perfil</h2>
                
                <!-- Exibição da Imagem de Perfil -->
                <div class="profile-img-container">
                    @if ($user->photo)
                        <img src="{{ asset('storage/' . $user->photo) }}" alt="Imagem de Perfil">
                    @else
                        <img src="https://via.placeholder.com/150" alt="Imagem de Perfil">
                    @endif
                </div>
                
                <!-- Campo de Nome -->
                <div class="mb-3">
                    <label for="name" class="form-label">Nome:</label>
                    <input type="text" id="name" name="name" class="form-control" value="{{ $user->name }}" required>
                    @error('name')
                        <span>{{ $message }}</span>
                    @enderror
                </div>

                <!-- Campo de E-mail -->
                <div class="mb-3">
                    <label for="email" class="form-label">Email:</label>
                    <input type="email" id="email" name="email" class="form-control" value="{{ $user->email }}" required>
                    @error('email')
                        <span>{{ $message }}</span>
                    @enderror
                </div>

                <!-- Campo de Senha -->
                <div class="mb-3">
                    <label for="password" class="form-label">Senha:</label>
                    <input type="password" id="password" name="password" class="form-control">
                    @error('password')
                        <span>{{ $message }}</span>
                    @enderror
                </div>

                <!-- Campo para Atualização de Imagem -->
                <div class="mb-3">
                    <label for="profile_image" class="form-label">Alterar Imagem de Perfil:</label>
                    <input type="file" id="profile_image" name="profile_image" class="form-control">
                </div>

                <div class="row">
                    <input type="submit" class="btn btn-edit" value="Editar">
                    <a class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#banModal"><i class="fa-solid fa-ban"></i> Excluir perfil</a>
                </div>
            </form>

            <!-- Modal de Exclusão -->
            <div class="modal fade" id="banModal" tabindex="-1" aria-labelledby="banModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="banModalLabel">Excluir Perfil</h5>
                            <i class="fas fa-times" data-bs-dismiss="modal" aria-label="Close" id="close-btn"></i>
                        </div>
                        <div class="modal-body">
                            Você tem certeza que deseja excluir seu perfil?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-cancel" data-bs-dismiss="modal"><i class="fa-solid fa-rotate-left"></i> Voltar</button>
                            <form action="{{ route('deleteUser', [$user->id]) }}" method="POST" class="w-50">
                                @csrf
                                @method('delete')
                                <input type="submit" class="btn btn-danger" value="Confirmar">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection
