@if (isset($startButton))
	{!! $startButton !!}
@endif
@can($viewGate)
    <a class="ps-1 pe-1 d-inline-block" href="{{ route($crudRoutePart . '.show', $row->$primaryKey) }}">
        <i class="text-primary fa fa-eye"></i>
    </a>
@endcan
@can($editGate)
    <a class="ps-1 pe-1 d-inline-block" href="{{ route($crudRoutePart . '.edit', $row->$primaryKey) }}">
        <i class="text-warning fa fa-edit"></i>
    </a>
@endcan
@can($deleteGate)
    <form action="{{ route($crudRoutePart . '.destroy', $row->$primaryKey) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this?');" style="display: inline-block;">
        <input type="hidden" name="_method" value="DELETE">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <a class="ps-1 pe-1" href="javascript:void(0);" onclick="$(this).closest('form').submit();">
			<i class="text-danger fa fa-trash"></i>
		</a>
    </form>
@endcan
