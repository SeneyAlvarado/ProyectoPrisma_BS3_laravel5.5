@extends('layout')
@section('header')
    <div class="page-header">
        <h1>Product_work / Show #{{$product_work->id}}</h1>
    </div>
@endsection

@section('content')
    <div class="well well-sm">
        <div class="row">
            <div class="col-md-6">
                <a class="btn btn-link" href="{{ route('product_works.index') }}"><i class="glyphicon glyphicon-backward"></i> Back</a>
            </div>
            <div class="col-md-6">
                 <a class="btn btn-sm btn-warning pull-right" href="{{ route('product_works.edit', $product_work->id) }}">
                    <i class="glyphicon glyphicon-edit"></i> Edit
                </a>
            </div>
        </div>
    </div>

    <div class="row">

        <div class="col-md-12">

            <label>Product_id</label>
<p>
	{{ $product_work->product_id }}
</p> <label>Product_id</label>
<p>
	{{ $product_work->product_id }}
</p> <label>Work_id</label>
<p>
	{{ $product_work->work_id }}
</p> <label>Work_id</label>
<p>
	{{ $product_work->work_id }}
</p> <label>Active_flag</label>
<p>
	{{ $product_work->active_flag }}
</p>

        </div>

    </div>
@endsection
