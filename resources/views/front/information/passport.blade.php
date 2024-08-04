@extends('front.layout.main')
@section('breadcrumb')
<div class="breadcrumb">
    <div class="container">
        <div class="breadcrumb-inner">
            <ul class="list-inline list-unstyled">
                <li><a href="{{ route('front.home') }}">Home</a></li>
                <li class='active'>About Passport</li>
            </ul>
        </div><!-- /.breadcrumb-inner -->
    </div><!-- /.container -->
</div><!-- /.breadcrumb -->
@endsection
@section('content')
<div class="container">
	<div class="row ">		
		<div class="col-md-9 sign-in-page">
		<h4>About Passport</h4>
		<p align="justify">A Passport is an essential travel document for those who are traveling abroad for education, tourism, pilgrimage, medical attendance, business purposes and family visits. During the last few years, the growing economy and spreading globalization have led to an increased demand for Passport and related services. The passport demand is estimated to be growing by around 10% annually. This increased demand for passport and related services is coming from both large cities and smaller towns, creating a need for wider reach and availability. To augment and improve the delivery of passport services to Indian citizens, the Ministry of External Affairs (MEA) launched the Passport Seva Project (PSP) in May 2010.</p>

		<h4>Document Required For Fresh Passport</h4>
		<ul style="list-style: disc; padding-left: 30px;line-height: 25px;">
			<li>Applicants are advised to visit their jurisdictional passport office's home page under Passport Office Page to know about additional documents required, if any.</li>
			<li>Applicants are required to furnish original documents along with one set of self-attested photocopies of the same at the Passport Seva Kendra (PSK) for processing.</li>
		</ul>

		<h4>Type of Application :</h4>
		<img src="{{asset('assets/images/passport.jpg')}}" alt="passport" title="about passport" align="right">
		<ul style="  padding-left: 10px;line-height: 25px;">
			<li>1.	Normal</li>
			<li>2.	Tatkaal</li>
		</ul>


		<h4>Information About Normal Passport Service :-</h4>
		<h4>Three applicant categories lie in normal passport Services  :-</h4>

		<ul style="  padding-left: 10px;">
			<li>	1.	Minor</li>
			<li>	2.	Adult </li>
			<li>	3.	Senior Citizen </li>

		</ul>

		<h4>1.	Minor:-</h4>
		<ul style="list-style: disc; padding-left: 30px;line-height: 25px;">
			 <li>It is assumed that consent of both parents is available, unless specified.</li>
			 <li>For minor applicants, present address proof document in the name of parent(s) can be submitted.</li>
			 <li>It is advised to carry original and self-attested copies of parents passport to Passport Seva Kendra (PSK), in case parents possess passport.</li>
			 <li>For minor applicants, documents can be attested by parents.</li>
			 <li>The minor applicant is eligible for Non-ECR till he/she attains the age of 18 years.</li>
		 

		</ul>
				<h4>2.	Adult:-</h4>
		<ul style="list-style: disc; padding-left: 30px;">
			 <li>Excluding Senior Citizens</li>	
		 
		</ul>

		<h4>Document Required For All Category</h4>
		<h4><b>Proof of Date of Birth (DOB)</b></h4>
		<h5>List Of Acceptable Document :-</h5>
			<ol style=" padding-left: 30px;line-height: 25px;">
			 <li>Birth Certificate issued by the Registrar of Births and Deaths or the Municipal Corporation or any other prescribed authority,whosoever has been empowered under the Registration of Birth and Deaths Act, 1969 to register the birth of a child born in India</li>
			 <li>Transfer/School leaving/Matriculation Certificate issued by the school last attended/recognised educational board</li>
			 <li>Policy Bond issued by the Public Life Insurance Corporations/Companies having the DOB of the holder of the insurance policy</li>
			 <li>Copy of an extract of the service record of the applicant (only in respect of Government servants) or the Pay Pension Order (in respect of retired Government Servants), duly attested/certified by the officer/in-charge of the Administration of the concerned Ministry/Department of the applicant</li>
			 <li>Aadhaar Card/E-Aadhaar</li>
			 <li>Election Photo Identity Card (EPIC) issued by the Election Commission of India</li>
			 <li>PAN Card issued by the Income Tax Department</li>
			 <li>Driving License issued by the Transport department of concerned state Government</li>
			 <li>A declaration given by the Head of the Orphanage/Child Care Home on their official letter head of the organization confirming the DOB of the applicant</li>
			 
		</ol>
		<p>Note: Documents mentioned in point 4 to 8 are acceptable as proof of Date of Birth only if it has the precise Date of Birth of the applicant.</p>

		<h4><b>Proof of Address</b></h4>
		<h5>List Of Acceptable Document :-</h5>
		 <ol style=" padding-left: 30px; line-height: 25px;">
		 	<li>Water Bill</li>
		 	<li>Telephone (landline or post paid mobile bill)</li>
		 	<li>Electricity bill</li>
		 	<li>Income Tax Assessment Order</li>
		 	<li>Election Commission Photo ID card</li>
		 	<li>Proof of Gas Connection</li>
		 	<li>Certificate from Employer of reputed companies on letter head</li>
		 	<li>Spouse's passport copy (First and last page including family details), (provided the applicant's present address matches the address mentioned in the spouses passport)</li>
		 	<li>Parent's passport copy, in case of minors(First and last page)</li>
		 	<li>Aadhaar Card</li>
		 	<li>Registered Rent Agreement</li>
		 	<li>Photo Passbook of running Bank Account (Scheduled Public Sector Banks, Scheduled Private Sector Indian Banks and Regional Rural Banks only)</li>
		 	 

		 </ol>

		 <h4>Note:</h4>
		 <ul style="list-style: disc; padding-left: 30px; line-height: 25px;">
			 <li>Applicants are required to submit the proof of address of the present address only, irrespective of the date from which he/she has been residing at the given address. However, he/she is required to mention all the places of stay during previous one year (from the date of application filling) in the Passport application form.</li>
			 <li>Furnishing of Aadhaar card will expedite processing of passport applications.</li>
			 <li>Aadhaar letter/card or the e-Aadhaar (an electronically generated letter from the website of UIDAI), as the case may be, will be accepted as Proof of Address (POA) and Proof of Photo-Identity (POI) for availing passport related services. Acceptance of Aadhaar as PoA and PoI would be subject to successful validation with Aadhaar database.</li>
			 <li>(For Minor): For minor applicants, present address proof document in the name of parent(s) can be submitted.</li>
			 <li>(For Document No. 7): Only public limited companies can give address proof on company letter head along with seal. Computerised print-outs shall not be entertained.</li>
			 <li>Any of the remaining documents containing address out of sixteen documents listed under Tatkaal application, could also be accepted as proof of residence if such documents have the same present residential address as given by the applicant in the Passport Application Form.</li>
			 <li>(For Minor ) A Declaration affirming the particulars furnished in the application about the minor as per: Annexure 'D'</li>
			 
		</ul>

		<h4><b>Document required for Re- Issue Passport</b></h4>
		<p>Old Passport in original with self-attested photocopy of its first two and last two pages, including ECR/Non-ECR page (previously ECNR) and the page of observation (if any), made by Passport Issuing Authority and validity extension page, if any, in respect of short validity passport</p>

		 <ol style=" padding-left: 30px; line-height: 25px;">
		 	<li>Water Bill</li>
		 	<li>Telephone (landline or post paid mobile bill)</li>
		 	<li>Electricity bill</li>
		 	<li>Income Tax Assessment Order</li>
		 	<li>Election Commission Photo ID card</li>
		 	<li>Proof of Gas Connection</li>
		 	<li>Certificate from Employer of reputed companies on letter head</li>
		 	<li>Spouse's passport copy (First and last page including family details), (provided the applicant's present address matches the address mentioned in the spouses passport)</li>
		 	<li>Parent's passport copy, in case of minors(First and last page)</li>
		 	<li>Aadhaar Card</li>
		 	<li>Registered Rent Agreement</li>
		 	<li>Photo Passbook of running Bank Account (Scheduled Public Sector Banks, Scheduled Private Sector Indian Banks and Regional Rural Banks only)</li>
		 	 

		 </ol>

		 	 <h4>Note:</h4>
		 <ul style="list-style: disc; padding-left: 30px; line-height: 25px;">
			 <li>Applicants are required to submit the proof of address of the present address only, irrespective of the date from which he/she has been residing at the given address. However, he/she is required to mention all the places of stay during previous one year (from the date of application filling) in the Passport application form.</li>
			 <li>Furnishing of Aadhaar card will expedite processing of passport applications.</li>
			 <li>Aadhaar letter/card or the e-Aadhaar (an electronically generated letter from the website of UIDAI), as the case may be, will be accepted as Proof of Address (POA) and Proof of Photo-Identity (POI) for availing passport related services. Acceptance of Aadhaar as PoA and PoI would be subject to successful validation with Aadhaar database. </li>
			 <li>(For Minor): For minor applicants, present address proof document in the name of parent(s) can be submitted.</li>
			 <li>(For Document No. 7): Only public limited companies can give address proof on company letter head along with seal. Computerized print-outs shall not be entertained.</li>
			 <li>Any of the remaining documents containing address out of sixteen documents listed under Tatkaal application, could also be accepted as proof of residence if such documents have the same present residential address as given by the applicant in the Passport Application Form.</li>
			 <li>(For Minor)A Declaration affirming the particulars furnished in the application about the minor as per: Annexure 'D'</li>
			 <li>It is advised to carry original and self-attested copies of parents passport to Passport Seva Kendra (PSK), in case parents possess passport.</li>
			 <li>For minor applicants, documents can be attested by parents.</li>
			 
		</ul>		
		</div>
		<div class="col-md-3  create-new-account">
			@include('front.information.quick_links')
		</div>
		<!-- Right quicklinks menus end -->	
	</div><!-- /.row -->
</div><!-- /.container -->
@endsection