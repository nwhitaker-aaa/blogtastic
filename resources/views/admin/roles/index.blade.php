@extends('admin.layouts.login')

@section('content')
<div class="index-page container">
    <div class="row">
        <div class="col-lg-12 portlets">
            <div class="panel">
                <div class="panel-header">
                    <h3><i class="bi bi-table"></i> <strong>Role</strong> Management
                        <a href="{{ route('roles.create') }}"
                           class="creation btn btn-default f-right text-capitalize">Create Role
                        </a>
                    </h3>
                </div>
            </div>
        </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <div class="panel-content">
        <div class="filter-left">
            <table class="table table-striped table-hover" id="role-mgmt-tbl"
                   data-table-name="All Blog Details">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th width="150px"></th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th></th>
                        <th></th>
                    </tr>
                </tfoot>
                <tbody>
                @foreach ($roles as $key => $role)
                    <tr>
                        <td>{{ $role->name }}</td>
                        <td class="text-right">
                            <form action="{{ route('roles.destroy', $role->id) }}" method="POST">
                                @can('role-edit')
                                    <a class="edit btn btn-sm btn-primary" href="{{ route('roles.edit', $role->id) }}">
                                        <i class="bi bi-plus-circle"></i></a>
                                @endcan


                                @csrf
                                @method('DELETE')
                                @if ($role->name != 'Administrator')
                                    <button type="submit" class="delete btn btn-sm btn-danger"><i class="bi bi-dash-circle"></i></button>
                                @endif
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
    </table>

    {!! $roles->render() !!}
    </div>
</div>
@endsection
