@extends('layout')
@section('header')
    <div class="page-header">
        <h1>Coin / Show #{{$coin->id}}</h1>
    </div>
@endsection

@section('content')
    <div class="well well-sm">
        <div class="row">
            <div class="col-md-6">
                <a class="btn btn-link" href="{{ route('coins.index') }}"><i class="glyphicon glyphicon-backward"></i> Back</a>
            </div>
            <div class="col-md-6">
                 <a class="btn btn-sm btn-warning pull-right" href="{{ route('coins.edit', $coin->id) }}">
                    <i class="glyphicon glyphicon-edit"></i> Edit
                </a>
            </div>
        </div>
    </div>

    <div class="row">

        <div class="col-md-12">

            <label>Name</label>
<p>
	{{ $coin->name }}
</p> <label>Active_flag</label>
<p>
	{{ $coin->active_flag }}
</p>

        </div>

    </div>
@endsection
