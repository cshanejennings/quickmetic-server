@extends('beautymail::templates.widgets')

@section('content')

	<h4 class="secondary"><strong>Hi {{ $first_name }},</strong></h4>
	<p>
		Thanks for contacting us to get your account set up, someone should
		be contacting you shortly to create your phone number and get you
		enrolled in our Beta test program!
	</p>
	@include('beautymail::templates.widgets.newfeatureStart')
		<h4>We have the following information submitted from you.</h4>
		<ul>
			<li><strong>Company name:</strong> {{ $company_name }}</li>
			<li><strong>Phone number:</strong> {{ $phone_number }}</li>
		</ul>
		<h5>You gave your calling instructions as: </h5>
		<p>{{ $time }}</p>

	@include('beautymail::templates.widgets.newfeatureEnd')

	@include('beautymail::templates.widgets.articleStart')

		<h4 class="secondary">Please be aware that this is a beta test</h4>
		<p>
			We thank you for your patience and cooperation with us as we develop this
			software and we hope you enjoy it's use and communicate your experience to
			us.
		</p>
		<p>
			There is no charge for this service, but it is provided AS IS, without
			warrenty or implied liability for the software and it's reliability.
			Use at your own risk under your sole discretion.
		</p>
	@include('beautymail::templates.widgets.articleEnd')

	<p>You should hear from us shortly and again, thank you.</p>


@stop
