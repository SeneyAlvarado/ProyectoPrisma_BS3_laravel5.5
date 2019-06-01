@extends('layout')

@section('header')
    <div class="page-header">
        <h1><i class="glyphicon glyphicon-edit"></i> Order / Edit #{{$order->id}}</h1>
    </div>
@endsection

@section('content')
    @include('error')

    <div class="row">
        <div class="col-md-12">

            <form action="{{ route('orders.update', $order->id) }}" method="POST">
                <input type="hidden" name="_method" value="PUT">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <div class="form-group">
	<label for="entry_date-field">Entry_date</label>
	--entry_date--
</div> <div class="form-group">
	<label for="approximate_date-field">Approximate_date</label>
	--approximate_date--
</div> <div class="form-group">
	<label for="quotation_number-field">Quotation_number</label>
	--quotation_number--
</div> <div class="form-group">
	<label for="client_owner-field">Client_owner</label>
	--client_owner--
</div> <div class="form-group">
	<label for="client_owner-field">Client_owner</label>
	--client_owner--
</div> <div class="form-group">
	<label for="client_contact-field">Client_contact</label>
	--client_contact--
</div> <div class="form-group">
	<label for="client_contact-field">Client_contact</label>
	--client_contact--
</div> <div class="form-group">
	<label for="
state_id-field">
State_id</label>
	--
state_id--
</div> <div class="form-group">
	<label for="
state_id-field">
State_id</label>
	--
state_id--
</div> <div class="form-group">
	<label for="branch_id-field">Branch_id</label>
	--branch_id--
</div> <div class="form-group">
	<label for="branch_id-field">Branch_id</label>
	--branch_id--
</div> <div class="form-group">
	<label for="active_flag-field">Active_flag</label>
	--active_flag--
</div>

                <div class="well well-sm">
                    <button type="submit" class="btn btn-primary">Save</button>
                    <a class="btn btn-link pull-right" href="{{ route('orders.index') }}"><i class="glyphicon glyphicon-backward"></i>  Back</a>
                </div>
            </form>

        </div>
    </div>
@endsection