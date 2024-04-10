@extends('admin.layouts.login')

@section('content')
<div class="index-page container" >
    <div class="row">
        <div class="col-lg-12 portlets">
            <div class="panel">
                <div class="panel-header">
                    <h3><i class="bi bi-table"></i> <strong>User</strong> Management
                        <a href="{{ route('users.create') }}"
                           class="creation btn btn-default f-right text-capitalize">Create User
                        </a>
                    </h3>
                </div>
                <div class="panel-content">
                    <div class="filter-left">
                        <table class="table table-striped table-hover" id="user-mgmt-tbl"
                               data-table-name="All User Details">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>email</th>
                                <th class="select-filter">Is Admin</th>
                                <th>Is Active?</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tfoot>
                            <tr>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                            </tr>
                            </tfoot>
                            <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <td>{{$user->name}}</td>
                                    <td>{{$user->email}}</td>
                                    <td>{!! $user->hasRole('Administrator') ? '<i class="bi bi-check-square-fill" aria-hidden="true" style="color:green;"></i>' : '' !!}</td>
                                    <td style="vertical-align: middle">{!! !$user->trashed() ? '<i class="bi bi-check-square-fill" aria-hidden="true" style="color:green;"></i>' : '<i class="bi bi-dash-square-fill" aria-hidden="true" style="color:red;"></i>'!!}</td>
                                    <td class="text-right">
                                        <a class="edit btn btn-sm btn-primary" style="margin: 3px;"
                                           href="{{ route('admin.users.edit', [$user->id]) }}">
                                            <i class="bi bi-plus-circle"></i>
                                        </a>
                                        <button type="button" class="delete btn btn-sm btn-danger" style="margin: 3px;" data-bs-toggle="modal" data-bs-target="#user-delete-modal-{!! $user->id !!}" title="{{$user->trashed() ? 'Permanently Delete' : 'Disable'}}?">
                                            <i class="bi bi-dash-circle"></i>
                                        </button>
                                        <div class="modal fade" role="dialog"
                                             id="user-delete-modal-{!! $user->id !!}" tabindex="-1"
                                             aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-body">
                                                        @if($user->trashed())
                                                            <p>Are you sure you want to permanently delete
                                                                this blog?</p>
                                                        @else
                                                            <p>Are you sure you want to set the
                                                                selected blog as inactive?</p>
                                                        @endif
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-default"
                                                                data-bs-dismiss="modal">No
                                                        </button>
                                                        <a class="btn btn-primary"
                                                           href="{{ route('admin.users.destroy', [$user->id, $user->trashed()]) }}">Yes</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @if($user->trashed())
                                            <a class="restore btn btn-sm btn-info" style="margin: 3px;" title="Restore Blog"
                                               href="{{ route('admin.users.restore', [$user->id]) }}">
                                                <i class="bi bi-arrow-repeat"></i>
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script type="text/javascript" src="{{ url('/js/admin/components/blog-management.js') }}"></script>
@endpush
@stop
