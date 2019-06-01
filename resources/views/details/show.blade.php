@extends('layout')
@section('header')
    <div class="page-header">
        <h1>Detail / Show #{{$detail->id}}</h1>
    </div>
@endsection

@section('content')
    <div class="well well-sm">
        <div class="row">
            <div class="col-md-6">
                <a class="btn btn-link" href="{{ route('details.index') }}"><i class="glyphicon glyphicon-backward"></i> Back</a>
            </div>
            <div class="col-md-6">
                 <a class="btn btn-sm btn-warning pull-right" href="{{ route('details.edit', $detail->id) }}">
                    <i class="glyphicon glyphicon-edit"></i> Edit
                </a>
            </div>
        </div>
    </div>

    <div class="row">

        <div class="col-md-12">

            <label>Modification_date</label>
<p>
	{{ $detail->modification_date }}
</p> <label>Detail</label>
<p>
	{{ $detail->detail }}
</p> <label>Work_id</label>
<p>
	{{ $detail->work_id }}
</p> <label>Work_id</label>
<p>
	{{ $detail->work_id }}
</p> <label>User_id</label>
<p>
	{{ $detail->user_id }}
</p> <label>User_id</label>
<p>
	{{ $detail->user_id }}
</p> <label>Active_flag</label>
<p>
	{{ $detail->active_flag }}
</p>

        </div>

    </div>
@endsection
