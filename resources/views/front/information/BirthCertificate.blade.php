@extends('front.layout.main')
@section('breadcrumb')
<div class="breadcrumb">
    <div class="container">
        <div class="breadcrumb-inner">
            <ul class="list-inline list-unstyled">
                <li><a href="{{ route('front.home') }}">Home</a></li>
                <li class='active'>About Birth Certificate in India</li>
            </ul>
        </div><!-- /.breadcrumb-inner -->
    </div><!-- /.container -->
</div><!-- /.breadcrumb -->
@endsection
@section('content')
<div class="container">
	<div class="row ">		
		<div class="col-md-9 sign-in-page">
		<h4><b>About Birth Certificate in India</b></h4>
		<img src="{{asset('assets/images/birth.jpg')}}" alt="birth certificate" title="about birth cerificate " class="thumbnail" style="margin-left:10px;" align="right">

		<p align="justify">A birth certificate is an important document that establishes the date of birth of a person. It is usually required for admission of your child in a school, applying for a passport etc. If you apply for a birth certificate for your child immediately after birth, you will realize that it is a very simple process. If you delay it, the process can get unnecessarily complicated.</p>
		<p align="justify">Birth Certificate is issued by the Municipal Corporation/Municipal Council in urban areas whereas in rural areas the authority is the Tehsildar at the Taluka level. The authority at the village level is the Gram Panchayat Office.</p>
		 <h4><b>To apply for a Birth CertificateWithin 21 days.</b></h4>
		 <p align="justify">you must first register the birth. The birth has to be registered with the concerned local authorities within 21 days of its occurrence, by filling up the form prescribed by the Registrar. Birth Certificate is then issued after verification with the actual records of the concerned hospital. Here are the steps to register a birth and obtain a birth certificate.</p>
		 <ol>
		 	<li>Obtain a birth registration form from the birth center (hospital) or Town Registrar’s office and fill in complete details.   In rural areas, there may not be actual application forms available and in such cases, the applications with complete details of birth can be written on plain paper. The details that are typically asked for in the registration form are: Name of the child, Name of Father, Name of Mother, Place of Birth, Date of Birth, Sex (Gender), Permanent address of Parents.</li>
		 	<li>Submit the duly completed application form along with fee. The fee may vary from one state to another.</li>
		 	<li>The registrar of births will verify the birth with birth center (hospital) and then issue a birth certificate by mail.</li>
		 	<li>In case the birth has not been registered within the specified time of its occurrence (21 days), the certificate is issued after due police verification ordered by the revenue authorities.  This can take a long time and it is therefore better to register the birth within 21 days</li>
		  

		 </ol>
		 <p align="justify">It will usually take about 10 days for the birth certificate to be ready.  There is a legal fast-track process where the birth certificate can be collected in 2 days.</p>

		 <h4><b> Procedure for getting a Birth Certificate After 30 days</b></h4>
		 <p align="justify">The registration and certification of Birth is given under the registration of Births and Deaths act, 1969 and rule, 2002 notified vide notification no. S.O.87/CA, Haryana Municipal act, 1973 under section 57 (2) (i) and Haryana Municipal Corporation act, 1994 under section 42 (16). The Birth and Death Certificates in Urban Area Haryana are issued by the Local Bodies namely respectively Municipal Corporation /Municipal Council /Municipal Committee within 3 working days from the date of receipt of application from the applicant provided the birth /death has already been registered. Single copy of Birth & Death Certificate is given free of cost to the informant immediately after the registration procedure is completed. First copy of the Birth certificate is also issued @ Rs.12/- per copy and additional copies of the Birth Certificate is  also issued @ Rs.10/- per copy The certificates are issued from the Secretary/Registrar Birth & Death respective area of the local bodies.</p>

		 <h4><b>Document required for Birth Certificate</b></h4>
		 <ol>
		 	<li>Application on a plain paper/prescribe Performa by concern authority.</li>
		 	<li>Proof of Birth/Death of the person in respect of whom certificate is required.</li>
		 	<li>In case of late (more than 30 days) registration an Affidavit specifying place, date and time of birth/death of the person. For proforma of affidavit attested by Gazetted officers. Birth Certificate affidavit ( Copy Enclosed), Death Certificate affidavit (Copy Enclosed)</li>

		 	<li>All documents to be self attested.</li>
		 	<p align="justify">Note:-Every Birth is to be reported and registered within 21 days at the place of its occurrence in the prescribed reporting forms. The persons required to register Birth / Death are:</p>
		  
			</ol>	
		</div>
		<div class="col-md-3  create-new-account">
			   @include('front.information.quick_links')
			 </div>

	</div><!-- /.row -->
</div><!-- /.container -->
@endsection