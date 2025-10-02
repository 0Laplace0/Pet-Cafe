@extends('home')

@section('css_before')
@endsection

@section('header')
@endsection

@section('sidebarMenu')
@endsection

@section('content')

<div class="container mt-4">
    <h1>User data 
        <a  href="/user/adding" class="btn btn-brown btn-sm mb-2"> Add User </a>
    </h1>

    <table class="table table-bordered table-striped table-hover">
        <thead class="thead-brown">
            <tr>
                <th width="5%" class="text-center">No.</th>
                <th width="20%">Username</th>
                <th width="20%">Email</th>
                <th width="10%">Phone</th>
                <th width="5%">edit</th>
                <th width="5%">PWD</th>
                <th width="5%">delete</th>
            </tr>
        </thead>

        <tbody>
            
            @foreach($userList as $row)
            <tr>
                <td align="center"> {{ $loop->iteration }}. </td>
                <td> <b>Name: {{ $row->user_name }} <br> 
                    ( {{ $row->user_role }} )</b> 
                </td>
                <td>{{ $row->user_email }} </td>
                <td>{{ $row->user_tel }} </td>
                <td>
                        <a href="/user/{{ $row->id }}" class="btn btn-warning btn-sm">edit</a>
                </td>
                
                <td>
                    <a href="/user/reset/{{ $row->id }}" class="btn btn-info btn-sm">reset</a>
                </td>
                <td>
                    {{-- <form action="/user/remove/{{ $row->id }}" method="post">
                        @csrf
                        @method('delete')
                        <button type="submit" class="btn btn-danger btn-sm">delete</button>
                    </form> --}}

                    <button type="button" class="btn btn-danger btn-sm" onclick="deleteConfirm({{ $row->id }})">delete</button>
                    <form id="delete-form-{{ $row->id }}" action="/user/remove/{{$row->id}}" method="POST" style="display: none;">
                        @csrf
                        @method('delete')
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="row align-items-center mt-3">

        <div class="col-12 col-md-3 text-muted small text-md-start text-center mb-2 mb-md-0">
            Showing {{ $userList->firstItem() }} to {{ $userList->lastItem() }} of {{ $userList->total() }} results
        </div>

        <div class="col-12 col-md-6">
            <div class="d-flex justify-content-center">
            {{ $userList->links() }}
            </div>
        </div>

        <div class="col-md-3 d-none d-md-block"></div>
    </div>
    
</div>

@endsection

@section('footer')
@endsection

@section('js_before')
@endsection

@section('js_before')
@endsection


<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
function deleteConfirm(id) {
    Swal.fire({
        title: 'Are you sure?',
        text: "Once deleted, it cannot be recovered!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Yes, delete it!',
        cancelButtonText: 'cancel'
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById('delete-form-' + id).submit();
        }
    });
}
</script>