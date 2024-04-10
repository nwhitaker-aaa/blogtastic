{!! Form::open(['route' => @$method ? ['admin.blogs.update', $blog->id] : 'admin.blogs.store', 'method' => $method ?? 'post', 'class' => 'form-bordered',  'autocomplete' => 'off']) !!}
<div class="row">
    <div class="container" style="margin: 10px;">
        <h4 class="form-row-header">Main Information</h4>
        <div class="col-xs-12 col-sm-4">
            {!! Form::aaaText('title', old('title', @$blog->title), ['placeholder' => 'Title', 'required'], @$errors) !!}
        </div>
        <div class="col-xs-12 col-sm-4">
            {!! Form::aaaText('author', old('author', @$blog->author), ['placeholder' => 'Author'], @$errors) !!}
        </div>
        <div class="col-xs-12 col-sm-4">
            {!! Form::aaaText('description', old('description', @$blog->description), ['placeholder' => 'Excerpt'], @$errors) !!}
        </div>
        <div class="col-xs-12 col-sm-4">
            {!! Form::aaaTextarea('details', old('details', @$blog->details), ['placeholder' => 'Details'], @$errors) !!}
        </div>
    </div>
</div>
<hr/>
<div class="text-center  m-t-20">
    <button type="submit" class="btn btn-embossed btn-primary">Submit</button>
</div>
{!! Form::close() !!}
