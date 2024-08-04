@extends('front.layout.main')
@section('breadcrumb')
<div class="breadcrumb">
    <div class="container">
        <div class="breadcrumb-inner">
            <ul class="list-inline list-unstyled">
                <li><a href="{{ route('front.home') }}">Home</a></li>
                <li class='active'>About Driving Licence</li>
            </ul>
        </div><!-- /.breadcrumb-inner -->
    </div><!-- /.container -->
</div><!-- /.breadcrumb -->
@endsection
@section('content')
<div class="container">
	<div class="row ">
		<div class="col-md-9 sign-in-page">
		<h4><b>About Driving Licence</b></h4>
		<img src="{{asset('assets/images/driving-licence.jpg')}}" alt="driving lience" title="about driving licence" class="thumbnail" style="margin-left:10px;" align="right">

		<p align="justify">A Driving License is an official document certifying that the holder is suitably qualified to drive a motor vehicle or vehicles. Under the provisions of the Motor Vehicles Act, 1988(External website that opens in a new window) in India, no person can drive a motor vehicle in any public place unless he holds a valid Driving License issued to him, authorizing him to drive a vehicle of that particular category.</p>

		<p align="justify">In India, two kinds of Driving Licenses are issued: Learner's License and Permanent License. Learner's License is valid only for six months. Permanent License can be availed only after the expiry of one month from the date of issuance of the Learner's License.</p>

		<h4>Procedure for Applying New Driving License</h4>
		<p align="justify">Applicants who wish to apply for a new driving licence online can do so by visiting the Sarathi website of the Ministry of Road Transport and Highways. Select the 'New Driving Licence' option from the 'Sarathi Services' column on the homepage.</p>
		<p align="justify">A new page will open containing instructions on the online application process. On reading through the instructions, download the form to a computer and proceed to fill in the details requested.</p>

		<h4>Online Application Process</h4>
		<p align="justify">The process for filling out an online application for a Learner's Licence or Driving License is as follows:</p>
		<ul style="list-style: disc; padding-left: 30px;line-height: 25px;">
			 <li>Visit the sarathi website and download the online application form.</li>
			 <li>Fill in the form as per the instructions on screen and click on 'Submit'.</li>
			 <li>In the case of minor applicants, the form is to be printed out and Part D is to be filled out and signed by the parent/guardian at the nearest RTO.</li>
			 <li>Upload the documents to be submitted along with the application form (proof of age, proof of address, learner's licence number).</li>
			 <li>A Web Application Number will be generated after submission, which can be used to track the status of the application.</li>
			 <li>Once the application has been processed, a notification will be sent via SMS.</li>

		</ul>

 	
		</div>
		<!-- Quick links  -->
		<div class="col-md-3  create-new-account">
				@include('front.information.quick_links')
			</div>
	</div><!-- /.row -->
</div><!-- /.container -->

@endsection