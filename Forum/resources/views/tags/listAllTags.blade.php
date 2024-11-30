@extends ('layouts.header_footer')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

@section('content')
<div class="topic-container">
    <h1 class="text-center" style="font-family: Garamond; margin-top: 10px">All Tags</h1>
    <div class="text-center mb-3">
        <button class="btn btn-75" data-bs-toggle="modal"  data-bs-target="#createTagModal">Create New Tag</button>
    </div>

    @if(session('success'))
        <div class="alert alert-success text-center">{{ session('success') }}</div>
    @endif

    <div class="table-responsive mx-auto" style="width: 90%;">
        <table class="table table-striped text-center">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
            @foreach($tags as $tag)
    <tr>
        <td>{{ $tag->id }}</td>
        <td>{{ $tag->title }}</td>
        <td>
            <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editTagModal-{{ $tag->id }}">Edit</button>
            <button class="btn btn-danger" onclick="deleteTag({{ $tag->id }})">Delete</button>

            <form id="delete-form-{{ $tag->id }}" action="{{ route('deleteTag', $tag->id) }}" method="GET" style="display: none;">
                @csrf
            </form>
        </td>
    </tr>

                <!-- Modal para edição -->
                <div class="modal fade" id="editTagModal-{{ $tag->id }}" tabindex="-1" aria-labelledby="editTagModalLabel-{{ $tag->id }}" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editTagModalLabel-{{ $tag->id }}">Edit Tag</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('updateTag', $tag->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="mb-3">
                                        <label for="title-{{ $tag->id }}" class="form-label">Title</label>
                                        <input type="text" class="form-control" id="title-{{ $tag->id }}" name="title" value="{{ $tag->title }}" required>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Update Tag</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
            </tbody>
        </table>
    </div>
</div>

<div class="modal fade" id="createTagModal" tabindex="-1" aria-labelledby="createTagModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createTagModalLabel">Create New Tag</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="createTagForm" action="{{ route('createTag') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" class="form-control" id="title" name="title" required>
                    </div>
                    <button type="submit" class="btn btn-75">Create Tag</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-JFNSi4fY/Mpt/i2//0gqK1tU8W0NzxMD0L4FYV+U8H7vZp0n6eP+k20w0H4xhIgL" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-DyZvW+1C0C6/Qu4/TPfgST4L5XgGB6V5pcS7I1cf2HcnUMRZz3RkgbpA/m9ow4B7" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    function deleteTag(id) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('delete-form-' + id).submit();
            }
        })
    }
</script>

@endsection