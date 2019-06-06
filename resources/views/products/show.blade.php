@extends('layout')
@section('header')
    <div class="page-header">
        <h1>Product / Show #{{$product->id}}</h1>
    </div>
@endsection

@section('content')
    <div class="well well-sm">
        <div class="row">
            <div class="col-md-6">
                <a class="btn btn-link" href="{{ route('products.index') }}"><i class="glyphicon glyphicon-backward"></i> Back</a>
            </div>
            
            <div class="col-md-6">
                 <a class="btn btn-sm btn-warning pull-right" href="{{ route('products.edit', $product->id) }}">
                    <i class="glyphicon glyphicon-edit"></i> Edit
                </a>
            </div>
        </div>
    </div>

    <div class="row">

        <div class="col-md-12">

            <label>Name</label>
<p>
	{{ $product->name }}
</p> <label>Description</label>
<p>
	{{ $product->description }}
</p> <label>Active_flag</label>
<p>
	{{ $product->active_flag }}
</p> <label>Branch_id</label>
<p>
	{{ $product->branch_id }}
</p> <label>Branch_id</label>
<p>
	{{ $product->branch_id }}
</p>

        </div>

    </div>
@endsection
