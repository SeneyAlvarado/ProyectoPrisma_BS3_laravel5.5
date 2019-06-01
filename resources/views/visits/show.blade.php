@extends('layout')
@section('header')
    <div class="page-header">
        <h1>Visit / Show #{{$visit->id}}</h1>
    </div>
@endsection

@section('content')
    <div class="well well-sm">
        <div class="row">
            <div class="col-md-6">
                <a class="btn btn-link" href="{{ route('visits.index') }}"><i class="glyphicon glyphicon-backward"></i> Back</a>
            </div>
            <div class="col-md-6">
                 <a class="btn btn-sm btn-warning pull-right" href="{{ route('visits.edit', $visit->id) }}">
                    <i class="glyphicon glyphicon-edit"></i> Edit
                </a>
            </div>
        </div>
    </div>

    <div class="row">

        <div class="col-md-12">

            <label>Client_name</label>
<p>
	{{ $visit->client_name }}
</p> <label>Date</label>
<p>
	{{ $visit->date }}
</p> <label>Phone</label>
<p>
	{{ $visit->phone }}
</p> <label>Email</label>
<p>
	{{ $visit->email }}
</p> <label>Details</label>
<p>
	{{ $visit->details }}
</p> <label>Visitor_id</label>
<p>
	{{ $visit->visitor_id }}
</p> <label>Visitor_id</label>
<p>
	{{ $visit->visitor_id }}
</p> <label>Recepcionist_id</label>
<p>
	{{ $visit->recepcionist_id }}
</p> <label>Recepcionist_id</label>
<p>
	{{ $visit->recepcionist_id }}
</p> <label>Active_flag</label>
<p>
	{{ $visit->active_flag }}
</p>

        </div>

    </div>
@endsection
