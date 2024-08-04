@extends('front.layout.main')
@section('breadcrumb')
<div class="breadcrumb">
    <div class="container">
        <div class="breadcrumb-inner">
            <ul class="list-inline list-unstyled">
                <li><a href="{{ route('front.home') }}">Home</a></li>
                <li class='active'>About Visa</li>
            </ul>
        </div><!-- /.breadcrumb-inner -->
    </div><!-- /.container -->
</div><!-- /.breadcrumb -->
@endsection
@section('content')
<div class="container">
	<div class="row ">			
		<div class="col-md-9 sign-in-page">
		<h4><b>About Visa</b></h4>
		<img src="{{asset('assets/images/visa.jpg')}}" alt="visa" title="about visa" align="right">

		<p align="justify">A visa (from the Latin charta visa, meaning "paper which has been seen")[1] is a conditional authorization granted by a country to a foreigner, allowing them to enter and temporarily remain within, or to leave that country. Visas typically include limits on the duration of the foreigner's stay, territory within the country they may enter, the dates they may enter, the number of permitted visits or an individual's right to work in the country in question. Visas are associated with the request for permission to enter a country and thus are, in some countries, distinct from actual formal permission for an alien to enter and remain in the country. In each instance, a visa is subject to entry permission by an immigration official at the time of actual entry and can be revoked at any time.</p>
		<p align="justify">A visa is most commonly a sticker endorsed in the applicant's passport or other travel document. The visa, when required, was historically granted by an immigration official on a visitor's arrival at the frontiers of a country, but increasingly today a traveller wishing to enter another country must apply in advance for a visa, sometimes in person at a consular office, by mail or over the internet. The actual visa may still be a sticker or a stamp in the passport or may take the form of a separate document or an electronic record of the authorisation, which the applicant can print before leaving home and produce on entry to the host country. Some countries do not require visas for short visits.</p>
		<p align="justify">Some countries require that their citizens, as well as foreign travelers, obtain an "exit visa" to be allowed to leave the country.[2] Uniquely, the Norwegian special territory of Svalbard is an entirely visa-free zone under the terms of the Svalbard Treaty.</p>
		<p align="justify">Some countries – such as those in the Schengen Area – have agreements with other countries allowing each other's citizens to travel between them without visas. The World Tourism Organization announced that the number of tourists who require a visa before traveling was at its lowest level ever in 2015.</p>
	 


		<h4><b>Type Of Visa</b></h4><hr>
		<h4>By purpose</h4>
		<h5>Transit visas</h5>
		<p align="justify">For passing through the country of issue to a destination outside that country. Validity of transit visas are usually limited by short terms such as several hours to 10 days depending on the size of the country and/or the circumstances of a particular transit itinerary.</p>
		<ul style="list-style: disc; padding-left: 30px;line-height: 25px;">
			<li>Airside transit visa, required by some countries for passing through their airports even without going through passport control.</li>
			<li>Crew member, steward or driver visa, issued to persons employed or trained on aircraft, vessels, trains, trucks, buses and any other means of international transportation, or ships fishing in international waters.</li>
		</ul>

		<h5><b>Short-stay or visitor visas</b></h5>
		<p align="justify">For short visits to the visited country. Many countries differentiate between different reasons for these visits, such as:</p>
		<ul style="list-style: disc; padding-left: 30px;line-height: 25px;">
			<li>Private visa, for private visits by invitation from residents of the visited country.</li>
			<li>Tourist visa, for a limited period of leisure travel, no business activities allowed.</li>
			<li>Visa for medical reasons, for undertaking diagnostics or a course of treatment in the visited country's hospitals.</li>
			<li>Business visa, for engaging in commerce in the country. These visas generally preclude permanent employment, for which a work visa would be required.</li>
			<li>Working holiday visa, for individuals traveling between nations offering a working holiday program, allowing young people to undertake temporary work while traveling.</li>
			<li>Athletic or artistic visa, issued to athletes and performing artists (and their supporting staff) performing at competitions, concerts, shows and other events.</li>
			<li>Cultural exchange visa, usually issued to athletes and performing artists participating in a cultural exchange program.</li>
			<li>Refugee visa, issued to persons fleeing the dangers of persecution, a war or a natural disaster.</li>
		 
		</ul>

		<h5><b>Short-stay or visitor visas</b></h5>
		<p align="justify">Visas valid for longer but still finite stays:</p>
		<ul style="list-style: disc; padding-left: 30px;line-height: 25px;">
			<li> Student visa (F-1 in the U.S.), which allows its holder to study at an institution of higher learning in the issuing country. The F-2 visa allows the student's dependents to accompany them in the U.S.</li>
			<li>Research visa, for students doing fieldwork in the host country.</li>
			<li>Temporary worker visa, for approved employment in the host country. These are generally more difficult to obtain but valid for longer periods of time than a business visa. Examples of these are the United States' H-1B and L-1 visas. Depending on a particular country, the status of temporary worker may or may not evolve into the status of permanent resident or to naturalization.</li>
			<li>Journalist visa, which some countries require of people in that occupation when traveling for their respective news organizations. Countries which insist on this include Cuba, Iran, North Korea, Saudi Arabia, the United States (I-visa) and Zimbabwe.</li>
			<li>Residence visa, granted to people obtaining long-term residence in the host country. In some countries, such as New Zealand, long-term residence is a necessary step to obtain the status of a permanent resident.</li>
			<li>Asylum visa, issued to people who have suffered or reasonably fear persecution in their own country due to their political activities or opinion, or features, or association with a social group; or were exiled from their own country.</li>
		 
		</ul>

		<h5><b>Immigrant visas</b></h5>
		<p align="justify">Granted for those intending to immigrate to the issuing country (obtain the status of a permanent resident with a prospect of possible naturalization in the future):</p>
		<ul style="list-style: disc; padding-left: 30px;line-height: 25px;">
			<li> Spouse visa or partner visa, granted to the spouse, civil partner or de facto partner of a resident or citizen of a given country to enable the couple to settle in that country.</li>
			<li>Marriage visa, granted for a limited period before intended marriage or civil partnership based on a proven relationship with a citizen of the destination country. For example, a German woman who wishes to marry an American man would obtain a Fiancée Visa (also known as a K-1 visa) to allow her to enter the United States. A K1 Fiancée Visa is valid for four months from the date of its approval.[8]</li>
			<li>Pensioner visa (also known as retiree visa or retirement visa), issued by a limited number of countries (Australia, Argentina, Thailand, Panama, etc.), to those who can demonstrate a foreign source of income and who do not intend to work in the issuing country. Age limits apply in some cases.</li>
			 
		</ul>
		<h5><b>Official visas</b></h5>
		<p align="justify">Are granted to officials doing jobs for their governments or otherwise representing their countries in the host country, such as the personnel of diplomatic missions.</p>
		<ul style="list-style: disc; padding-left: 30px;line-height: 25px;">
			<li>Diplomatic visas are normally only available to bearers of diplomatic passports.</li>
			<li>Courtesy visas are issued to representatives of foreign governments or international organizations who do not qualify for diplomatic status but do merit expedited, courteous treatment - an example of this is Australia's Special purpose visa.</li>
			
		</ul>
		<h5><b>By method of issue</b></h5>
		<p align="justify">Normally visa applications are made at and collected from a consulate, embassy or other diplomatic mission.</p>
		<h5>On-arrival visas</h5>
		<p align="justify">(Also known as Visa On Arrival, VOA), granted at a port of entry. This is distinct from not requiring a visa at all, as the visitor must still obtain the visa before they can even try to pass through immigration.</p>
		<ul style="list-style: disc; padding-left: 30px;line-height: 25px;">
		<li>Almost all countries will consider issuing a visa (or another document to the same effect) on arrival to a visitor arriving in unforeseen exceptional circumstances, for example:</li>
		<ul style="list-style: disc; padding-left: 30px;line-height: 25px;">
		<li>Under provisions of article 35 of the Schengen Visa Code, a visa may be issued at a border in situations such as the diversion of a flight causing air passengers in transit to pass through two or more airports instead of one. In 2010, Iceland's Eyjafjallajökull volcano erupted, causing significant disruption of air travel throughout Europe, and the EU responded by announcing that it would issue visas at land borders to stranded travelers.</li>
		<li>Under section 212(d)(4) of the Immigration and Naturalization Act, visa waivers can be issued to travelers arriving at American ports of entry in emergency situations or under other conditions.</li>
		<li>Certain international airports in Russia have consuls on-duty, who have the power to issue visas on the spot.</li>
		</ul>
		<li>Some countries issue visas on arrival to special categories of travelers, such as seafarers or air crew</li>
		
		<li>Some countries issue them to regular visitors; however, there often are restrictions, for example:</li>
		 <ul style="list-style: disc; padding-left: 30px;line-height: 25px;">
		<li>Belarus issues visas on arrival in Minsk international airport only to nationals of countries where there is no consular representation of Belarus.</li>
		<li>Thailand only issues visas on arrival at certain border checkpoints. The most notable crossing where visas on arrival are not issued is the Padang Besar checkpoint for passenger trains between Malaysia and Thailand.</li>
		<li>Russia issues visas on arrival for short visits to its Western exclave, Kaliningrad oblast.</li>
		 
		</ul>
		</ul>

		<h4>Electronic visas</h4>
		<p align="justify">An electronic visa (e-Visa or eVisa) is stored in a computer and is linked to the passport number; no label, sticker or stamp is placed in the passport before travel. The application is done over the internet.	</p>
		<ul  style="list-style: disc; padding-left: 30px;line-height: 25px;">	
			<li>Antigua and Barbuda issues Electronic Entry Visa (EEV) online to nationals of countries that require a visa.</li>
			<li>Armenia issues electronic visas to certain eligible countries.</li>
			<li>Australia pioneered electronic visa issuance with the Electronic Travel Authority for tourists, and is also issuing the eVisitor for European tourists and businessmen. Recent changes in immigration law mean that almost all visas (including those for permanent residency) are issued electronically by default unless a label is required (for example to board an aircraft).</li>
			<li>Azerbaijan issues electronic visas to nationals of 81 countries and stateless persons through its ASAN visa system.</li>
			<li>Bahrain issues electronic visas to nationals of certain eligible countries.</li>
			<li>Cambodia issues electronic visas to most visitors through their eVisa system.</li>
			<li>Georgia issues electronic visas to nationals of eligible countries.</li>
			<li>India issues electronic visas (called e-Tourist Visas) to nationals of certain eligible countries.</li>
			<li>Ivory Coast allows visitors to apply online for an electronic visa that if approved can be picked up at the Port Bouet Airport in Abidjan. </li>
			<li>Kuwait issues electronic visas to nationals of 52 countries via its online portal. Other nationalities may apply for an eVisa if they possess a valid GCC residency and work in select professions.</li>
			<li>Myanmar issues electronic visas to nationals of eligible countries.</li>
		 

		</ul>

		<h4><b>Visa refusal</b></h4>
		<p>In general, an applicant may be refused a visa if he or she does not meet the requirements for admission or entry under that country's immigration laws. More specifically, a visa may be denied or refused when the applicant:</p>
		<ul  style="list-style: disc; padding-left: 30px;line-height: 25px;">	
			<li>has committed fraud, deception or misrepresentation in his or her current application as well as in a previous application </li>
			<li>has obtained a criminal record, has been arrested, or has criminal charges pending </li>
			<li>is considered to be a threat to national security </li>
			<li>does not have a good moral character </li>
			<li>has previous visa/immigration violations (even if the violations didn't happen in the country the applicant is seeking a visa for) </li>
			<li>had their previous visa application(s) or application for immigration benefits refused and cannot prove that the reasons for the previous refusals no longer exist or are not applicable any more (even if the refusals didn't previously happen in the country the applicant is seeking a visa for) </li>
			<li>cannot prove to have strong ties to their current country of nationality and/or residence (for those who are applying for temporary or non-immigrant visas </li>
			<li>intends to reside or work permanently in the country she/he will visit if not applying for an immigrant or work visa respectively </li>
			<li>fails to demonstrate intent to return (for non-immigrants) </li>
			<li>fails to provide sufficient evidence/documents to prove eligibility for the visa sought after</li>
			<li>does not have a legitimate reason for the journey</li>
			<li>does not have travel arrangements (i.e. transport and lodging) in the destination country</li>
			<li>does not have health/travel insurance valid for the destination and the duration of stay</li>
			<li>has a sexually transmitted disease</li>
			<li>is applying on excessively short notice without an exceptionally justifiable reason</li>
			<li>is a citizen of a country to which the destination country is hostile</li>
			<li>has previously visited, or intends to visit, a country to which the destination country is hostile</li>
			<li>has a communicable disease, such as tuberculosis</li>
			<li>has a passport that expires too soon</li>
			<li>didn't use a previously issued visa at all without a valid reason (e.g., a trip cancellation due to a family emergency)</li>


		</ul>

		<p align="justify">Even if a traveller does not need a visa, the aforementioned criteria can also be used by border police to refuse the traveller entry into the country in question.</p>
		</div>
		<div class="col-md-3  create-new-account">
			@include('front.information.quick_links')
			</div>
	</div><!-- /.row -->
</div><!-- /.container -->
@endsection