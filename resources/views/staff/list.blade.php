@extends('home')

@section('css_before')
@endsection

@section('header')
@endsection

@section('sidebarMenu')
@endsection

@section('content')

<div class="container mt-4">
    <div class="row">
    <div class="col-md-12">
<h1>Staff data 
<a  href="/staff/adding" class="btn btn-primary btn-sm mb-2"> + Staff </a>
</h1>

<table class="table table-bordered table-striped table-hover">
    <thead>
        <tr class="table-info">
            <th width="5%" class="text-center">No.</th>
            <th width="20%">Staff Name</th>
            <th width="20%">Email</th>
            <th width="10%">Phone</th>
            <th width="5%">edit</th>
            <th width="5%">PWD</th>
             <th width="5%">delete</th>
        </tr>
    </thead>

    <tbody>
         
        @foreach($StaffList as $row)
        <tr>
            <td align="center"> {{ $loop->iteration }}. </td>
            <td> <b>Name: {{ $row->staff_fname }} {{ $row->staff_lname }} <br> 
                ( {{ $row->staff_position }} )</b> 
            </td>
            <td>{{ $row->staff_email }} </td>
            <td>{{ $row->staff_tel }} </td>
            <td>
                    <a href="/staff/{{ $row->id }}" class="btn btn-warning btn-sm">edit</a>
            </td>
            
            <td>
                <a href="/staff/reset/{{ $row->id }}" class="btn btn-info btn-sm">reset</a>
        </td>
        <td>
                {{-- <form action="/staff/remove/{{ $row->id }}" method="post">
                    @csrf
                    @method('delete')
                    <button type="submit" class="btn btn-danger btn-sm">delete</button>
                </form> --}}

                        <button type="button" class="btn btn-danger btn-sm" onclick="deleteConfirm({{ $row->id }})">delete</button>
                        <form id="delete-form-{{ $row->id }}" action="/staff/remove/{{$row->id}}" method="POST" style="display: none;">
                            @csrf
                            @method('delete')
                        </form>


            </td>
        </tr>
        @endforeach
    </tbody>

</table>

 <div>
        {{ $StaffList->links() }}
    </div>
    
</div>
</div>
</div>
{{-- devbanban.com  --}}

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