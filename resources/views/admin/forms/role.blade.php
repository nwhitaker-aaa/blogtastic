{!! Form::open(['route' => @$method ? ['roles.update', $role->id] : 'roles.store', 'method' => $method ?? 'post', 'class' => 'form-bordered',  'autocomplete' => 'off']) !!}
@csrf
<div class="row">
    <div class="col-xs-12 mb-3">
        <div class="form-group">
            <strong>Name:</strong>
            <input type="text" value="{{ $role->name ?? '' }}" name="name" class="form-control"
                   placeholder="Name">
        </div>
    </div>
    <div class="col-xs-12 mb-3">
        <div class="form-group">
            <strong>Permission:</strong>
            <br />
            @foreach ($permission as $value)
                <label>
                    <input type="checkbox" @if (in_array($value->id, $rolePermissions)) checked @endif name="permission[]"
                           value="{{ $value->id }}" class="name">
                    {{ $value->name }}</label>
                <br />
            @endforeach
        </div>
    </div>
    <div class="col-xs-12 mb-3 text-center">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</div>
{!! Form::close() !!}
