@extends('front.layout.main')
@section('breadcrumb')
<div class="breadcrumb">
    <div class="container">
        <div class="breadcrumb-inner">
            <ul class="list-inline list-unstyled">
                <li><a href="{{ route('front.home') }}">Home</a></li>
                <li class='active'>About Voter Id Card</li>
            </ul>
        </div><!-- /.breadcrumb-inner -->
    </div><!-- /.container -->
</div><!-- /.breadcrumb -->
@endsection
@section('content')
<div class="container">
	<div class="row ">
		<div class="col-md-9 sign-in-page">
			<h4><b>About Voter Id Card</b></h4>
			<img src="{{asset('assets/images/voterid.png')}}" height="150px;" alt="Voter Id card" title="Voter id card card" class="thumbnail" style="margin-left:10px;" align="right">

			<p align="justify">Voter ID is a very important document of any Indian citizen. As India is the Democratic country, the country runs with the Government and the people or citizen of India have the right to vote to the right person as the government. To make the Voter Id card, one must attain his or her 18 year of age by birth. And thus he or she is eligible for casting votes to select the government. </p>				 
			 
			<h4>Voter Id Card Online </h4>
			 
			<ul style="list-style: disc; padding-left: 30px;line-height: 25px;">
				 <li>Your physical presence is paramount due to the need to collect biometric data.</li>
				 <li>The first thing to do for applying voter Id card is, go to the official site of Election commission of India http://eci.nic.in/eci/eci.html in your desktop or laptop. You can also select your preferred languages for operating the website. </li>
				 	 
				 <li>In the website, you will find lots of stuffs regarding election and its functions of India. While under the categories you will find the Enrolment section, go to the enrolment and select the Become a Voter option.</li>
				 <li>Once you click on the Enrolment option, you will be redirected to the new windows where you will find a gate for logging in. There you have click on the new registration for getting your password and user name. Once you complete your log in process you will received the password and username via email and mobile number.</li>
				 <li>Now, Log into your account by providing the password and username for further process to create voter ID card easily</li>
				 <li>Now after logging in, you have to provide your full detail like name, father’s name, mother’s name, DOB, address etc. and make a specific password for your account. After filling up all the required details about you, the last step is to click on the Submit button.</li>
				 <li>After submitting, a new successful page will be appeared which will include complete details about you and then you can download it for further used.</li>
				 <li>The online applying for voter ID is done and you will receive an email for the confirmatory of successfully applied for new voter ID card.</li>			 
				 
			</ul>

			<h4>Voter Id Card Offline</h4>
		  	<p align="justify">But those who have difficulties for applying for voter ID card through online can also apply offline for new voter ID card.</p>
		  	 
		  	<p align="justify">For applying voter ID card offline will take you to the official and traditional method of creating Voter ID card. All you have to do is download the offline form the official site of ElectionCommission of India and fill up the form by providing your details in the form including your mobile numbers. </p>
		  	<p align="justify">The form will ask for all the photo copy of each document mentioned in the form before submitting it to the office of election commission of your state or city.</p>
		  	<p align="justify">In this manner, one can easily apply for voter ID card through Offline methods and also all the required documents including passport size photo is must for the offline process. And all the work will be done in the office itself and when your Voter ID card is ready they will be sent in your given address by post.</p>
		  	<p align="justify">So above are the important details about how to apply voter ID card Online and Offline. We have discuss the complete steps which are very simple too and any fresh or new applicant can easily perform the application and get their voter ID card very soon in few days. The online is more efficient as they consume lesser time and energy and easily you can get your Voter ID card through Post.</p>
		  	<p align="justify">Hope you have known the best and easy detail about online and Offline applying for voter ID card and easily you can create one in few days.</p>

		  	<h4>Required Documents for Voter ID </h4>
		  	<p align="justify">Copy of Proof of Residence: This is required to validate the address you provide while filling the Form No. 6. Valid of address proofs are as follows:</p>

		  	<ul style="list-style: disc; padding-left: 30px;line-height: 25px;">
				 <li>Electricity/Water Bill </li>
				 <li>Statement issued by Bank </li>
				 <li>MTNL / BSNL Telephone bills </li>
				 <li>Bank Passbooks </li>
				 <li>Passport </li>
				 <li>Driving License </li>
				 <li>Ration Card </li>					 

			</ul>

			<p align="justify">Copy of Proof of Residence: This is required to validate the address you provide while filling the Form No. 6. Valid of address proofs are as follows:</p>

		  	<ul style="list-style: disc; padding-left: 30px;line-height: 25px;">
				 <li>10th Standard passing certificate</li>
				 <li>Birth certificate issued by the civic agency of your state or any other appropriate document signifying the voter’s age. </li>
				 <li>School Leaving Certificate Specifying Age </li>
				 <li>PAN Card </li>
				 <li>Driving License </li>
				 <li>Passport </li>
				 <li>Senior Citizen Card (if applicable) </li>
				 <li>Aadhar Card </li>
				 <li>Kissan Card </li>
				 <li>2 recent passport size photographs, which would appear on the Elector’s Photo Identity Card.</li>

			</ul>
		</div>
		<!-- Quick links  -->
		<div class="col-md-3  create-new-account">
				@include('front.information.quick_links')
			</div>
	</div><!-- /.row -->
</div><!-- /.container -->

@endsection