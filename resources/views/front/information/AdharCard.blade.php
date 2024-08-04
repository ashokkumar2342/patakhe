@extends('front.layout.main')
@section('breadcrumb')
<div class="breadcrumb">
    <div class="container">
        <div class="breadcrumb-inner">
            <ul class="list-inline list-unstyled">
                <li><a href="{{ route('front.home') }}">Home</a></li>
                <li class='active'>About Aadhaar Card</li>
            </ul>
        </div><!-- /.breadcrumb-inner -->
    </div><!-- /.container -->
</div><!-- /.breadcrumb -->
@endsection
@section('content')
<div class="container">
	<div class="row ">
		<div class="col-md-9 sign-in-page">
			<h4><b>About Aadhaar Card</b></h4>
			<img src="{{asset('assets/images/aadhar.jpg')}}" height="150px;" alt="pan card" title="about pan card" class="thumbnail" style="margin-left:10px;" align="right">

			<p align="justify">Aadhaar is a 12 digit unique-identity number issued to all Indian residents based on their biometric and demographic data. The data is collected by the Unique Identification Authority of India (UIDAI), a statutory authority established on 12 July 2016 by the Government of India, under the Ministry of Electronics and Information Technology, under the provisions of the Aadhaar Act 2016. </p>

			<p align="justify">Aadhaar is the world's largest biometric ID system, with over 1.112 billion enrolled members. As of January 2017, 99% of Indians aged 18 and above had enrolled in Aadhaar.</p>
			 
			<h4>Documents Required For Aadhaar Card</h4>
			<p align="justify">These are some of the most basic requirements that you will need to abide by to get an Aadhar card.</p>
			<ul style="list-style: disc; padding-left: 30px;line-height: 25px;">
				 <li>Your physical presence is paramount due to the need to collect biometric data.</li>
				 <li>	You will need to carry document as proof of the following: </li>
				 	<ul style="list-style: disc; padding-left: 30px;line-height: 25px;">
				 		<li>Establishing the age</li>
				 		<li>Establishing the identity</li>
				 		<li>Establishing the place residence of the applicant</li>
				 		<li>Establishing proof of marriage</li>
				 		

				 	</ul>
				 	<p align="justify">To provide proof of the points mentioned above you can carry any or all of the following documents</p>
				 <li>Passport</li>
				 <li>Drivers licence</li>
				 <li>Identity cards issued by the government</li>
				 <li>Birth certificates</li>
				 <li>SSLC certificates</li>
				 <li>PAN cards</li>
				 <li>Voter identity card</li>
			</ul>
			<h4>Aadhaar Forms</h4>
		  	<p align="justify">There is just one form that is related to this service. It is known as the enrolment/correction form and can be used to apply for a new Aadhaar number or to have the details of an existing number corrected. The form will collect the basic information of the person along with information about the documents that are being submitted in the capacity of supporting documents.</p>
		  	<h4>Fee ForAadhaar Card</h4>
		  	<p align="justify">This is a service that is being provided for free and has no fee or charges associated with it.Aadhar is a service that is intended to provide the residents of India with an identity card that is valid throughout the country and is treated as a standard beyond question. It is also a card that is meant to make it easier to avail any and all benefits that the government plans to issue. These two facts alone make it a good idea to get an Aadhaar number even though it is not mandatory at the moment.</p>
		</div>
		<!-- Quick links  -->
		<div class="col-md-3  create-new-account">
				@include('front.information.quick_links')
			</div>
	</div><!-- /.row -->
</div>

@endsection