<a href="{{ route($crud . '.show', $row) }}" class="btn btn-sm btn-primary" data-toggle="tooltip" title="Show"><i data-feather="eye"></i></a>
<a href="{{ route($crud . '.edit', $row) }}" class="btn btn-sm btn-success" data-toggle="tooltip" title="Edit"><i data-feather="edit"></i></a>
@if($crud != 'quality')
    <form action="{{ route($crud . '.destroy', $row) }}" method="POST" class="deleteForm" onsubmit="return confirm(' ! WARNING ! If you Press OK it can not be recovered?');" style="display: inline-block;">
        <input type="hidden" name="_method" value="DELETE">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <button type="button" class="btn btn-sm btn-danger" onclick="sweetAlertCall(this)" data-toggle="tooltip" title="Delete" style="color:white;">
            <i data-feather="trash"></i>
        </button>
    </form>
@endif
@section('more-script')
    <script>
        function sweetAlertCall(trElem) {
            var tr = $(trElem).closest('tr');
            swal({
                title: "Are you sure?",
                text: "Once deleted, you will not be able to recover this data!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
                .then((willDelete) => {
                    if (willDelete) {
                        swal("Poof! Your data has been deleted!", {
                            icon: "success",
                        });
                        tr.find('.deleteForm').submit();
                    } else {
                        swal("Your data is safe!");
                    }
                });
        }
    </script>
@endsection
