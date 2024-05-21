@extends('dashboard.layouts.main')
@section('title','Roles')

@section('breadcrumb')
@parent
<li class="breadcrumb-item active">@yield('title')/User Roles</li>
@endsection


@section('content')

<div class="mb-5 ml-3">
    <a href="{{ route('dashboard.roles.create') }}" class="btn btn-sm btn-outline-primary mr-2">create</a>
    {{-- <a href="{{ route('dashboard.roles.trash') }}" class="btn btn-sm btn-outline-dark mr-2">trash</a> --}}
    <button class="btn btn-outline-danger btn-sm " data-toggle="modal" data-target="#deleteModal" id="btn_delete_selected" disabled>Delete Selected</button>
</div>


<x-alert.alert type="success"/>
<x-alert.alert type="info"/>


<table class="table" id="datatable">
    <thead>
        <tr>
            <th><input name="select_all" id="example-select-all" type="checkbox" onclick="checkAll('box1',this)"> </th>
            <th>ID</th>
            <th>Name</th>
            <th>Created at</th>
            <th class='text-center'>process</th>
        </tr>
    </thead>
    <tbody>
        @php $i=0; @endphp
     @forelse ($roles as $brand )
        <tr>
            @php $i++ @endphp
            <td><input type="checkbox" value="{{ $brand->id }}" class="box1"> </td>
            <td>{{ $i }}</td>
            <td>{{ $brand->name }}</td>
            <td>{{ $brand->created_at }}</td>
            <td class='d-flex justify-content-around'>
                <a href="{{ route('dashboard.roles.edit',$brand->id) }}" class="btn btn-sm btn-outline-success"> <i class="fas fa-edit"></i> </a>
                <a href="{{ route('dashboard.roles.show',$brand->id) }}" class="btn btn-sm btn-outline-warning"> <i class="fas fa-eye"></i> </a>

            {{-- </td>
            <td> --}}
                <form action="{{ route('dashboard.roles.destroy',$brand->id) }}" method="post">
                    @csrf
                    @method('delete')
                    <button type="submit" class="btn btn-outline-danger btn-sm"> <i class="fas fa-trash-alt"></i>
                    </button>
                </form>
            </td>
        </tr>
     @empty
     <tr>
        <td colspan="8" style="background-color:#007bff; color:white" class="text-center">No roles Difined</td>
     </tr>
     @endforelse
    </tbody>
</table>

<!-- Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Confirm Deletion</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete all selected roles?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <form action="{{ route('dashboard.deleteAllSelectedRoles') }}" method="post">
                    @csrf
                    @method('delete')
                    <input type="text" name="delete_all_id" id="delete_all_id" value=''>

                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>

{{ $roles->links()}}

@endsection
