@extends('home')

@section('css_before')
@endsection

@section('header')
@endsection

@section('sidebarMenu')
@endsection

@section('content')

<div class="container mt-4">
    <h1>Pet Managements
        <a href="/pet/adding" class="btn btn-brown btn-sm"> Add Pet </a>
    </h1>

    <table class="table table-bordered table-striped table-hover">
        <thead class="thead-brown">
            <tr>
                <th width="5%" class="text-center">No.</th>
                <th width="5%">Pic</th>
                <th width="35%">Product Name & Type </th>
                <th width="45%" class="text-center">Detail</th>
                <th width="5%" class="text-center">edit</th>
                <th width="5%" class="text-center">delete</th>
            </tr>
        </thead>

        <tbody>
            @foreach($PetList as $row)
            <tr>
                <td align="center">{{ $row->id }}</td>
                <td>
                    
                    <img src="{{ asset('storage/' . $row->pet_img) }}" width="100"></td>
                <td>
                    <b>Name: {{ $row->pet_name }}</b> ( Type:  {{ $row->pet_type }} )
                </td>
                <td align="right">{{ Str::limit($row->pet_detail, 120, '...') }}</td>
                <td align="center">
                    <a href="/pet/{{ $row->id }}" class="btn btn-warning btn-sm">edit</a>
                </td>
                <td align="center">

                    {{-- <form action="/pet/remove/{{$row->id}}" method="post">
                        @csrf
                        @method('delete')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Sure to Delete !!');">delete</button>
                    </form> --}}

                    
                    <button type="button" class="btn btn-danger btn-sm" onclick="deleteConfirm({{ $row->id }})">delete</button>

                        <form id="delete-form-{{ $row->id }}" action="/pet/remove/{{$row->id}}" method="POST" style="display: none;">
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
            Showing {{ $PetList->firstItem() }} to {{ $PetList->lastItem() }} of {{ $PetList->total() }} results
        </div>

        <div class="col-12 col-md-6">
            <div class="d-flex justify-content-center">
            {{ $PetList->links() }}
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
        text: "Do you really want to delete this data?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!',
        cancelButtonText: 'cancel'
    }).then((result) => {
        if (result.isConfirmed) {
            // ถ้ากด "ลบเลย" ให้ submit form ที่ซ่อนไว้
            document.getElementById('delete-form-' + id).submit();
        }
    })
}
</script>

