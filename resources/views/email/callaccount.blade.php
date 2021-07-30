@extends('beautymail::templates.widgets')

@section('content')

	<h4 class="secondary"><strong>Account request from {{$first_name}} {{$last_name}},</strong></h4>

	@include('beautymail::templates.widgets.newfeatureStart')
		<h4>Information provided</h4>
		<ul>
			<li><strong>First name:</strong> {{ $first_name }}</li>
			<li><strong>Last name:</strong> {{ $last_name }}</li>
			<li><strong>Email:</strong> {{ $email }}</li>
			<li><strong>Phone number:</strong> {{ $phone_number }}</li>
			<li><strong>Company name:</strong> {{ $company_name }}</li>
		</ul>
		<h5>Calling instructions:</h5>
		<p>{{ $time }}</p>
	@include('beautymail::templates.widgets.newfeatureEnd')

@stop
