@extends('layouts.header_footer')

@section('content')
<div class="containerAllUser">
    <div class="users-list">
        <h2>Lista de Usuários</h2>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Email</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr class="{{ $user->suspended ? 'suspended' : '' }}">
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            @if(!$user->suspended)
                                <a class="btn btn-edit" href="{{ route('suspendUser', $user->id) }}"><i class="fa-solid fa-head-side-cough-slash"></i> Suspender</a>
                            @else
                                <span class="suspended-text">Suspenso</span>
                            @endif
                            
                            <a class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#banModal" onclick="setUserIdToBan({{ $user->id }})"><i class="fa-solid fa-user-slash"></i> Banir</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    
    <!-- Modal de Banir -->
    <div class="modal fade" id="banModal" tabindex="-1" aria-labelledby="banModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="banModalLabel">Banir Usuario</h5>
                    <i class="fas fa-times" data-bs-dismiss="modal" aria-label="Close" id="close-btn"></i>
                </div>
                <div class="modal-body">
                    Você tem certeza que deseja banir este usuario?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-cancel" data-bs-dismiss="modal"><i class="fa-solid fa-rotate-left"></i> Voltar</button>
                    <form id="banUserForm" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger"><i class="fa-solid fa-user-slash"></i> Confirmar Banimento</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function setUserIdToBan(userId) {
        // Preenche o formulário de banimento com o ID do usuário
        const form = document.getElementById('banUserForm');
        form.action = '/users/' + userId + '/delete'; // Altere para a rota de deletar usuário
    }
</script>
@endsection
