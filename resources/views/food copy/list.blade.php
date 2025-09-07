@extends('home')

@section('css_before')
@endsection

@section('header')
@endsection

@section('sidebarMenu')
@endsection

@section('content')
    <h3> ::Food Managements ::
        <a href="/food/adding" class="btn btn-primary btn-sm"> Add Food </a>
    </h3>

    <table class="table table-bordered table-striped table-hover">
        <thead>
            <tr class="table-info">
                <th width="5%" class="text-center">No.</th>
                <th width="5%">Pic</th>
                <th width="35%">Food Name & Type </th>
                <th width="45%" class="text-center">Detail</th>
                <th width="5%" class="text-center">edit</th>
                <th width="5%" class="text-center">delete</th>
            </tr>
        </thead>

        <tbody>
            @foreach($FoodList as $row)
            <tr>
                <td align="center">{{ $row->id }}</td>
                <td>
                    
                    <img src="{{ asset('storage/' . $row->food_img) }}" width="100"></td>
                <td>
                    <b>Name: {{ $row->food_name }}</b> ( Type:  {{ $row->food_type }} )
                </td>
                <td align="right">{{ Str::limit($row->food_detail, 120, '...') }}</td>
                <td align="center">
                    <a href="/food/{{ $row->id }}" class="btn btn-warning btn-sm">edit</a>
                </td>
                <td align="center">

                    {{-- <form action="/food/remove/{{$row->id}}" method="post">
                        @csrf
                        @method('delete')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Sure to Delete !!');">delete</button>
                    </form> --}}

                    
                    <button type="button" class="btn btn-danger btn-sm" onclick="deleteConfirm({{ $row->id }})">delete</button>

                        <form id="delete-form-{{ $row->id }}" action="/food/remove/{{$row->id}}" method="POST" style="display: none;">
                            @csrf
                            @method('delete')
                        </form>


                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div>
        {{ $FoodList->links() }}
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

