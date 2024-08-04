@extends('front.layout.main')
@section('breadcrumb')
<div class="breadcrumb">
    <div class="container">
        <div class="breadcrumb-inner">
            <ul class="list-inline list-unstyled">
                <li><a href="{{ route('front.home') }}">Home</a></li>
                <li class='active'>About PAN Card</li>
            </ul>
        </div><!-- /.breadcrumb-inner -->
    </div><!-- /.container -->
</div><!-- /.breadcrumb -->
@endsection
@section('content')
<div class="container">
	<div class="row ">
		<div class="col-md-9 sign-in-page">
			<h4><b>About PAN Card</b></h4>
			<img src="{{asset('assets/images/pan_card.jpg')}}" alt="pan card" title="about pan card" class="thumbnail" style="margin-left:10px;" align="right">

			<p align="justify">PAN has become an essential part of any financial transaction, it is now mandatory to obtain a PAN for yourself. Moreover, it is a widely recognized photo identity and proof of address. </p>

			<p align="justify">I-CAPS facilitates you to apply for a new PAN Card in 3 simple steps. Individuals who have never applied for a PAN Card before and currently don't have a PAN card can apply online.</p>
			<p align="justify">To confirm if there is PAN card allotted or not, one may visit the UTIITSL website.</p>
			<h4>Permanent account number</h4>
			<p align="justify">Permanent account number (PAN) is the identifier of Indian income tax payers. It is unique, 10-character alpha-numeric identifier, issued to all juristic entities identifiable under the Indian Income Tax Act 1961. It is issued by the Indian Income Tax Department under the supervision of the Central Board for Direct Taxes (CBDT) and it also serves as an important proof of identification.</p>

			<h4>PAN Card</h4>

			<p align="justify">PAN card size is of standard plastic bank-card. It bears face-photo of the holder, date of birth, date of issue and a hologram sticker as security feature. (The card does not bear address of the holder.) The proof of PAN Card is almost mandatory for financial transactions such as opening a bank account, receiving taxable salary or professional fees, sale or purchase of assets above specified limits etc.</p>
			<p align="justify">The primary purpose of PAN is to bring a universal identification to all financial transactions and to prevent tax evasion by keeping track of monetary transactions of high-net-worth individuals. The PAN is unique, valid for life-time of the PAN-holder throughout India. It is not affected by change of address.</p>
			<h4>PAN Application / Form 49A</h4>
			<p align="justify">Use of PAN is mandatory at required places, like for Income Tax Returns, high-value financial transactions, etc. However, it is options for people not falling under any of the requirement. One can apply for PAN by submitting the prescribed PAN application along with photo, ID proof, address proof and applicable fee.</p>

			<h4>Documents for proof of identity</h4>
			<ul style="list-style: disc; padding-left: 30px;line-height: 25px;">
				 <li>Voter Identity Card</li>
				 <li>Driving License </li>
				 <li>Passport</li>
				 <li>Arm’s License</li>
				 <li>Central Government Health Scheme Card or Ex-servicemen Contributory Heath Scheme photo card</li>
				 <li>Ration Card having photograph of applicant</li>
				 <li>Photo identity card issued by the Central Government or a State Government or a Public Sector Undertaking</li>
				 <li>Pensioner Card having photograph of the applicants</li>
				 <li>Elector’s photo identity card</li>
				 
			</ul>

				<h4>Documents for proof of address</h4>
			<ul style="list-style: disc; padding-left: 30px;line-height: 25px;">
				 <li>Elector's Photo Identity Card</li>
				 <li>Driving License </li>
				 <li>Passport</li>
				 <li>Arm’s License</li>
				 <li>Bank Account Statement/Passbook</li>
				 <li>Credit Card Statement</li>
				 <li>Landline telephone or broadband connection bill</li>
				 <li>Passport of the Spouse</li>
				 <li>Post office pass book having address of the applicant</li>
				 <li>Electricity Bill</li>
				 <li>Depository Account Statement</li>
				 <li>Latest Property Tax Assessment Order</li>
				 <li>Domicile certificate issued by the Government</li>

				 
			</ul>

						<h4>Documents for proof of address</h4>
			<ul style="list-style: disc; padding-left: 30px;line-height: 25px;">
				 <li>Birth Certificate issued by the Municipal Authority</li>
				 <li>Pension Payment Order </li>
				 <li>Marriage certificate issued by Registrar of Marriages</li>
				 <li>Matriculation certificate</li>
				 <li>Domicile certificate issued by Government</li>
				 <li>Affidavit sworn before a magistrate stating the date of birth by the Government</li>
				 <li>Driving License</li>
				 <li>Passport</li>
				 <li>Post office pass book having address of the applicant</li>
				 <li>Electricity Bill</li>
				 <li>Depository Account Statement</li>
				 <li>Latest Property Tax Assessment Order</li>
				 <li>Domicile certificate issued by the Government</li>
				 
				 
			</ul>				
		</div>
		<!-- Quick links  -->
		<div class="col-md-3  create-new-account">
				@include('front.information.quick_links')
			</div>
	</div><!-- /.row -->
</div><!-- /.container -->

@endsection