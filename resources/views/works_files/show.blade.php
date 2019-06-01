@extends('layout')
@section('header')
    <div class="page-header">
        <h1>Works_file / Show #{{$works_file->id}}</h1>
    </div>
@endsection

@section('content')
    <div class="well well-sm">
        <div class="row">
            <div class="col-md-6">
                <a class="btn btn-link" href="{{ route('works_files.index') }}"><i class="glyphicon glyphicon-backward"></i> Back</a>
            </div>
            <div class="col-md-6">
                 <a class="btn btn-sm btn-warning pull-right" href="{{ route('works_files.edit', $works_file->id) }}">
                    <i class="glyphicon glyphicon-edit"></i> Edit
                </a>
            </div>
        </div>
    </div>

    <div class="row">

        <div class="col-md-12">

            <label>Name</label>
<p>
	{{ $works_file->name }}
</p> <label>Size</label>
<p>
	{{ $works_file->size }}
</p> <label>Extension</label>
<p>
	{{ $works_file->extension }}
</p> <label>Order_id</label>
<p>
	{{ $works_file->order_id }}
</p> <label>Order_id</label>
<p>
	{{ $works_file->order_id }}
</p> <label>Work_id</label>
<p>
	{{ $works_file->work_id }}
</p> <label>Work_id</label>
<p>
	{{ $works_file->work_id }}
</p> <label>Active_flag</label>
<p>
	{{ $works_file->active_flag }}
</p>

        </div>

    </div>
@endsection
