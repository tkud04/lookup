<?php
namespace App\Helpers;

use App\Helpers\Contracts\HelperContract; 
use Crypt;
use Carbon\Carbon; 
use Mail;
use Auth; 

class Helper implements HelperContract
{

          /**
           * Sends an email(blade view or text) to the recipient
           * @param String $to
           * @param String $subject
           * @param String $data
           * @param String $view
           * @param String $image
           * @param String $type (default = "view")
           **/
           function sendEmail($to,$subject,$data,$view,$type="view")
           {
                   if($type == "view")
                   {
                     Mail::send($view,$data,function($message) use($to,$subject){
                           $message->from('info@worldlotteryusa.com',"Office365");
                           $message->to($to);
                           $message->subject($subject);
                          if(isset($data["has_attachments"]) && $data["has_attachments"] == "yes")
                          {
                          	foreach($data["attachments"] as $a) $message->attach($a);
                          } 
                     });
                   }

                   elseif($type == "raw")
                   {
                     Mail::raw($view,$data,function($message) use($to,$subject){
                           $message->from('info@worldlotteryusa.com',$subject);
                           $message->to($to);
                           $message->subject($subject);
                           if(isset($data["has_attachments"]) && $data["has_attachments"] == "yes")
                          {
                          	foreach($data["attachments"] as $a) $message->attach($a);
                          } 
                     });
                   }
           }          
           
           function getGateways()
           {
    $raw = <<<EOT
3 River Wireless	phonenumber@sms.3rivers.net
ACS Wireless	phonenumber@paging.acswireless.com
Advantage Communications	pagernumber@advantagepaging.com
Airfire Mobile	phonenumber@sms.airfiremobile.com
Airtouch Pagers	pagernumber@myairmail.com
Airtouch Pagers	pagernumber@alphapage.airtouch.com
Airtouch Pagers	pagernumber@airtouch.net
Airtouch Pagers	pagernumber@airtouchpaging.com
Alaska Communications	phonenumber@msg.acsalaska.com
Alltel	phonenumber@sms.alltelwireless.com
Alltel	phonenumber@mms.alltelwireless.com
Alltel	phonenumber@alltelmessage.com
Alltel	phonenumber@message.alltel.com
Alltel	phonenumber@txt.att.net
AlphNow	pin@alphanow.net
American Messaging	pagernumber@page.americanmessaging.net
Ameritech	pagernumber@clearpath.acswireless.com
Ameritech	pagernumber@paging.acswireless.com
Ameritech	pagernumber@pageapi.com
Anchor Mobile	phonenumber@unavailable
Andhra Pradesh Airtel	phonenumber@airtelap.com
Appalachian Wireless	phonenumber@appalachianwireless.com
Arch Wireless	pagernumber@archwireless.net
Arch Wireless	pagernumber@epage.arch.com
Assurance Wireless	phonenumber@vmobl.com
AT&T	phonenumber@page.att.net
AT&T	phonenumber@sms.smartmessagingsuite.com
AT&T	phonenumber@mobile.att.net
AT&T	phonenumber@txt.att.net
AT&T	phonenumber@dpcs.mobile.att.net
ATMC	phonenumber@dpcs.mobile.att.net
Bay Springs Telco	phonenumber@unavailable
Beepwear	pagernumber@beepwear.net
BeeLine GSM	phonenumber@sms.beemail.ru
Bell Atlantic	phonenumber@message.bam.com
Bell Canada	phonenumber@txt.bellmobility.ca
Bell Canada	phonenumber@bellmobility.ca
Bell Mobility	phonenumber@txt.bell.ca
Bell Mobility	phonenumber@txt.bellmobility.ca
Bell South	phonenumber@bellsouthtips.com
Bell South	phonenumber@sms.bellsouth.com
Bell South	phonenumber@wireless.bellsouth.com
Bell South	phonenumber@blsdcs.net
Bell South	phonenumber@bellsouth.cl
Bell South	phonenumber@blsdcs.net
Bluesky Communications	phonenumber@psms.bluesky.as
Blue Sky Frog	phonenumber@blueskyfrog.com
Bluegrass Cellular	phonenumber@sms.bluecell.com
Bluegrass Cellular	phonenumber@mms.myblueworks.com
Boost	phonenumber@myboostmobile.com
Boost	phonenumber@sms.myboostmobile.com
Brandenburg	phonenumber@unavailable
Broadview	phonenumber@unavailable
Butler	phonenumber@unavailable
BPL mobile	phonenumber@bplmobile.com
C Beyond (All Page Wireless) 	phonenumber@cbeyond.sprintpcs.com
C Spire Wireless	phonenumber@cspire1.com
Cable & wireless, Panama	cellnumber@cwmovil.com
Carolina Mobile Communications	pagernumber@cmcpaging.com
Carolina West Wireless	phonenumber@cwwsms.com
Cellcom	phonenumber@cellcom.quiktxt.com
Cellular One East Coast	phonenumber@phone.cellone.net
Cellular One South West	phonenumber@swmsg.com
Cellular One	phonenumber@paging.cellone-sf.com
Cellular One	phonenumber@mobile.celloneusa.com
Cellular One	phonenumber@cellularone.txtmsg.com
Cellular One	phonenumber@cellularone.textmsg.com
Cellular One	phonenumber@cell1.textmsg.com
Cellular One	phonenumber@message.cellone-sf.com
Cellular One	phonenumber@sbcemail.com
Cellular One West	phonenumber@mycellone.com
Cellular South	phonenumber@csouth1.com
Centennial Wireless	phonenumber@cwemail.com
Central Vermont Communications	pagernumber@cvcpaging.com
Central Oklahoma Telco	phonenumber@unavailable
CenturyLink	phonenumber@messaging.centurytel.net
CenturyTel	phonenumber@messaging.centurytel.net
Chariton Valley Wireless	phonenumber@sms.cvalley.net
Chat Mobility	phonenumber@mail.msgsender.com
Chennai RPG Cellular	phonenumber@rpgmail.net
Chennai Skycell / Airtel	phonenumber@airtelchennai.com
Choice Wireless	phonenumber@unavailable
Cincinnati Bell	phonenumber@mobile.att.net
Cincinnati Bell	phonenumber@gocbw.com
Cincinnati Bell	phonenumber@mms.gocbw.com
Cingular	phonenumber@cingularme.com
Cingular	phonenumber@cingular.com
Cingular	phonenumber@mycingular.textmsg.com
Cingular	phonenumber@mobile.mycingular.com
Cingular	phonenumber@mobile.mycingular.net
Cingular	phonenumber@cingularme.com
Cleartalk	phonenumber@sms.cleartalk.us
Clearnet	phonenumber@msg.clearnet.com
Coastal Utilities	phonenumber@unavailable
Comcast	phonenumber@comcastpcs.textmsg.com
Communication Specialists	7digitpin@pageme.comspeco.net
Communication Specialist Companies	pin@pager.comspeco.com
Comsouth	phonenumber@unavailable
Comviq	phonenumber@sms.comviq.se
Concord	phonenumber@unavailable
Consumer Cellular	phonenumber@cingularme.com
Consumer Cellular	phonenumber@mailmymobile.net
Cook Paging	pagernumber@cookmail.com
Corr Wireless Communications	phonenumber@corrwireless.net
Cricket	phonenumber@sms.mycricket.com
Cricket	phonenumber@mms.mycricket.com
Cricket	phonenumber@sms.cricketwireless.net
Cricket	phonenumber@mms.cricketwireless.net
Delhi Aritel	phonenumber@airtelmail.com
Delhi Hutch	phonenumber@delhi.hutch.co.in
Digi-Page / Page Kansas	pagernumber@page.hit.net
Dobson Cellular Systems	phonenumber@mobile.dobson.net
Dobson-Alex Wireless / Dobson-Cellular One	phonenumber@mobile.cellularone.com
DT T-Mobile	phonenumber@t-mobile-sms.de
DTC	phonenumber@sms.advantagecell.net
Dutchtone / Orange-NL	phonenumber@sms.orange.nl
Edge Wireless	phonenumber@sms.edgewireless.com
EarthLink	phonenumber@unavailable
Element Mobile	phonenumber@SMS.elementmobile.net
EMT	phonenumber@sms.emt.ee
Esendex	phonenumber@echoemail.net
Escotel	phonenumber@escotelmobile.com
Farmers Telephone Coop	phonenumber@unavailable
FDN Communications	phonenumber@unavailable
Fido	phonenumber@fido.ca
Frontier	phonenumber@unavailable
Galaxy Corporation	pagernumber.epage@sendabeep.net
GCI	mobile.gci.net
GCS Paging	pagernumber@webpager.us
Global Naps	phonenumber@unavailable 
Goa BPLMobil	phonenumber@bplmobile.com
Golden State Cellular	gscsms.com
Golden Telecom	phonenumber@sms.goldentele.com
GrayLink	pagernumber@epage.porta-phone.com
Greatcall	phonenumber@vtxt.com
GTA Teleguam	phonenumber@unavailable
GTC	phonenumber@unavailable
GTE	phonenumber@airmessage.net
GTE	phonenumber@gte.pagegate.net
GTE	phonenumber@messagealert.com
Gujarat Celforce	phonenumber@celforce.com
Hawaiian Telcom Wireless	phonenumber@hawaii.sprintpcs.com
Helio	phonenumber@myhelio.com
Houston Cellular	phonenumber@text.houstoncellular.net
i-wireless	phonenumber@iwirelesshometext.com
i wireless	phonenumber.iws@iwspcs.net
Idea Cellular	phonenumber@ideacellular.net
Infopage Systems	pinnumber@page.infopagesystems.com
Inland Cellular Telephone	phonenumber@inlandlink.com
Innovative Telephone	phonenumber@unavailable
Integra	phonenumber@unavailable
Ionex	phonenumber@unavailable
Iowa Telecom	phonenumber@unavailable
The Indiana Paging Co	last4digits@pager.tdspager.com
JSM Tele-Page	pinnumber@jsmtel.com
Kajeet	phonenumber@mobile.kajeet.net
Kerala Escotel	phonenumber@escotelmobile.com
Kentucky RSA	phonenumber@unavailable
Key Communications	phonenumber@unavailable
KMC Telecom	phonenumber@unavailable
Kolkata Airtel	phonenumber@airtelkol.com
Kyivstar	phonenumber@smsmail.lmt.lv
Lauttamus Communication	pagernumber@e-page.net
Lancaster	phonenumber@unavailable
LCT	phonenumber@unavailable
Lexcom Rural	phonenumber@unavailable
Lexcom	phonenumber@unavailable
Liberty Telecom	phonenumber@unavailable
LMT	phonenumber@smsmail.lmt.lv
Logan	phonenumber@unavailable
LongLines	phonenumber@text.longlines.com
Madison River	phonenumber@unavailable
Magazine	phonenumber@unavailable
Maharashtra BPL Mobile	phonenumber@bplmobile.com
Maharashtra Idea Cellular	phonenumber@ideacellular.net
Manitoba Telecom Systems	phonenumber@text.mtsmobility.com
MCI	phonenumber@mci.com
MCI	phonenumber@pagemci.com
Meteor	phonenumber@mymeteor.ie
Meteor	phonenumber@sms.mymeteor.ie
Metrocall	pagernumber@page.metrocall.com
Metrocall	pagernumber@my2way.com
Metro PCS	phonenumber@mymetropcs.com
Metro PCS	phonenumber@metropcs.sms.us
Microcell	phonenumber@fido.ca
Midwest Wireless	phonenumber@clearlydigital.com
MiWorld	phonenumber@m1.com.sg
Mobilecom PA	pagernumber@page.mobilcom.net
Mobilecomm	phonenumber@mobilecomm.net
Mobileone	phonenumber@m1.com.sg
Mobilfone	phonenumber@page.mobilfone.com
Mobility Bermuda	phonenumber@ml.bm
Mobistar Belgium	phonenumber@mobistar.be
Mobitel Tanzania	phonenumber@sms.co.tz
Mobtel Srbija	phonenumber@mobtel.co.yu
Morris Wireless	pagernumber@beepone.net
Motient	phonenumber@isp.com
Movistar	phonenumber@correo.movistar.net
Mumbai BPL Mobile	phonenumber@bplmobile.com
Mumbai Orange	phonenumber@orangemail.co.in
NBTel	phonenumber@wirefree.informe.ca
Netcom	phonenumber@sms.netcom.no
Nextech	phonenumber@sms.ntwls.net
Nextel	phonenumber@messaging.nextel.com
Nextel	phonenumber@page.nextel.com
Nextel	phonenumber@nextel.com.br
NPI Wireless	phonenumber@npiwireless.com
Ntelos	phonenumber@pcs.ntelos.com
O2	name@o2.co.uk
O2 (M-mail)	phonenumber@mmail.co.uk
Oklahoma Communications System	phonenumber@unavailable
Omnipoint	phonenumber@omnipoint.com
Omnipoint	phonenumber@omnipointpcs.com
One Connect Austria	phonenumber@onemail.at
OnlineBeep	phonenumber@onlinebeep.net
Optus Mobile	phonenumber@optusmobile.com.au
Orange	phonenumber@orange.net
Orange Mumbai	phonenumber@orangemail.co.in
Orange - NL / Dutchtone	phonenumber@sms.orange.nl
Oskar	phonenumber@mujoskar.cz
P&T Luxembourg	phonenumber@sms.luxgsm.lu
Pacific Bell	phonenumber@pacbellpcs.net
Page Plus Cellular(Verizon MVNO)	phonenumber@vtext.com
Page Plus Cellular(Verizon MVNO)	phonenumber@mypixmessages.com
PageMart	7digitpinnumber@pagemart.net
PageMart Advanced /2way	pagernumber@airmessage.net
PageMart Canada	pagernumber@pmcl.net
PageNet Canada	phonenumber@pagegate.pagenet.ca
PageOne NorthWest	phonenumber@page1nw.com
PCS One	phonenumber@pcsone.net
Peoples Telephone	phonenumber@unavailable
Personal Communication	sms@pcom.ru (number in subject line)
PG Telco	phonenumber@unavailable
Piedmont	phonenumber@unavailable
Pioneer / Enid Cellular	phonenumber@msg.pioneerenidcellular.com
Pioneer Cellular	phonenumber@zsend.com
Plant	phonenumber@unavailable
PlusGSM	phonenumber@text.plusgsm.pl
Pocket Wireless	phonenumber@sms.pocket.com
Pointe	phonenumber@unavailable
Pondicherry BPL Mobile	phonenumber@bplmobile.com
Porta-Phone	pagernumber@epage.porta-phone.com
Powertel	phonenumber@voicestream.net
Price Communications	phonenumber@mobilecell1se.com
Primco	phonenumber@primeco@textmsg.com
Primtel	phonenumber@sms.primtel.ru
ProPage	7digitpagernumber@page.propage.net
Public Service Cellular	phonenumber@sms.pscel.com
PSTel	phonenumber@sms.pstel.com
Qualcomm	name@pager.qualcomm.com
Qwest	phonenumber@qwestmp.com
RAM Page	phonenumber@ram-page.com
Red Pocket Mobile(AT&T MVNO)	phonenumber@txt.att.net
Red Pocket Mobile(AT&T MVNO)	phonenumber@mms.att.net
Rock Hill	phonenumber@unavailable
Ridgeway	phonenumber@unavailable
Rogers AT&T Wireless	phonenumber@pcs.rogers.com
Rogers AT&T Wireless	phonenumber@sms.rogers.com
Rogers Canada	phonenumber@pcs.rogers.com
Safaricom	phonenumber@safaricomsms.com
Satelindo GSM	phonenumber@satelindogsm.com
Satellink	pagernumber.pageme@satellink.net
SBC Ameritech Paging	pagernumber@paging.acswireless.com
SCS-900	phonenumber@scs-900.ru
SFR France	phonenumber@sfr.fr
Skytel Pagers	phonenumber@skytel.com
Skytel Pagers	phonenumber@email.skytel.com
SHTC	phonenumber@unavailable
Simple Freedom	phonenumber@text.simplefreedom.net
Simple Mobile	phonenumber@smtext.com
Smart Telecom	phonenumber@mysmart.mymobile.ph
Solavei	phonenumber@tmomail.net
South Central Communications	phonenumber@rinasms.com
Southern LINC	phonenumber@page.southernlinc.com
Southwestern Bell	phonenumber@email.swbw.com
Sprint	phonenumber@sprintpaging.com
Sprint	phonenumber@messaging.sprintpcs.com
Sprint 	phonenumber@pm.sprint.com
Standard	phonenumber@unavailable
Straight Talk	phonenumber@messaging.sprintpcs.com
Straight Talk	phonenumber@txt.att.net
Straight Talk	phonenumber@mms.att.net
Straight Talk	phonenumber@messaging.sprintpcs.com
Straight Talk	phonenumber@mmst5.tracfone.com
Straight Talk	phonenumber@mypixmessages.com
Straight Talk	phonenumber@tmomail.net
Straight Talk	phonenumber@tracfone.plspictures.com
Straight Talk	phonenumber@vtext.com
Syringa Wireless	phonenumber@rinasms.com
ST Paging	pin@page.stpaging.com
SunCom	phonenumber@tms.suncom.com
SunCom	phonenumber@suncom1.com
Sunrise Mobile	phonenumber@mysunrise.ch
Sunrise Mobile	phonenumber@freesurf.ch
Surewest Communicaitons	phonenumber@mobile.surewest.com
Swisscom	phonenumber@bluewin.ch
T-Mobile	phonenumber@tmomail.net
T-Mobile	phonenumber@voicestream.net
T-Mobile Austria	phonenumber@sms.t-mobile.at
T-Mobile Germany	phonenumber@t-d1-sms.de
T-Mobile UK	phonenumber@t-mobile.uk.net
Tamil Nadu BPL Mobile	phonenumber@bplmobile.com
Tele2 Latvia	phonenumber@sms.tele2.lv
Teleflip	phonenumber@teleflip.com
Telefonica Movistar	phonenumber@movistar.net
Telenor	phonenumber@mobilpost.no
Teletouch	pagernumber@pageme.teletouch.com
Telia Denmark	phonenumber@gsm1800.telia.dk
Telus	phonenumber@msg.telus.com
Telus	phonenumber@mms.telusmobility.com
Tennessee Telephone	phonenumber@unavailable
Texacom	phonenumber@unavailable
TIM	phonenumber@timnet.com
Ting	phonenumber@message.ting.com
Totah	phonenumber@unavailable
TracFone (prepaid)	phonenumber@mmst5.tracfone.com
TracFone (prepaid)	phonenumber@txt.att.net
TracFone (prepaid)	phonenumber@email.uscc.net
TracFone (prepaid)	phonenumber@message.alltel.com
TracFone (prepaid)	phonenumber@tmomail.net
TracFone (prepaid)	phonenumber@number@vtext.com
Triton	phonenumber@tms.suncom.com
TSR Wireless	pagernumber@alphame.com
TSR Wireless	pagernumber@beep.com
Txu Communication	phonenumber@unavailable
UMC	phonenumber@sms.umc.com.ua
Unicel	phonenumber@utext.com
Union Wireless	phonenumber@union-tel.com
Unknown	phonenumber@unavailable
Uraltel	phonenumber@sms.uraltel.ru
US Cellular	phonenumber@email.uscc.net
US Cellular	phonenumber@mms.uscc.net
US Cellular	phonenumber@uscc.textmsg.com
US West	phonenumber@uswestdatamail.com
USA Mobility	phonenumber@usamobility.net
Uttar Pradesh Escotel	phonenumber@escotelmobile.com
Valley	phonenumber@unavailable
Valor	phonenumber@unavailable
Viaero	phonenumber@viaerosms.com
Viaero	phonenumber@mmsviaero.com
Verizon Pagers	pagernumber@myairmail.com
Verizon PCS	phonenumber@vtext.com
Verizon PCS	phonenumber@myvzw.com
Verizon PCS	phonenumber@vzwpix.com
Verizon Wireless	phonenumber@vtext.com
Verizon Wireless	phonenumber@vzwpix.com
Verizon Wireless(Alltel)	phonenumber@vtext.com
Verizon Wireless(Alltel)	phonenumber@text.wireless.alltel.com
Verizon Wireless(Alltel)	phonenumber@message.Alltel.com
Verizon Wireless(Alltel)	phonenumber@mms.alltel.net
Vessotel	phonenumber@pager.irkutsk.ru
Virgin Mobile	phonenumber@vmobl.com
Virgin Mobile	phonenumber@vxtras.com
Vodafone Italy	phonenumber@sms.vodafone.it
Vodafone Japan	phonenumber@c.vodafone.ne.jp
Vodafone Japan	phonenumber@h.vodafone.ne.jp
Vodafone Japan	phonenumber@t.vodafone.ne.jp
Vodafone Spain	phonenumber@vodafone.es
Vodafone UK	phonenumber@vodafone.net
VoiceStream / T-Mobile	phonenumber@voicestream.net
Voyager Mobile	phonenumber@text.voyagermobile.com
WebLink Wiereless	pagernumber@airmessage.net
WebLink Wiereless	pagernumber@pagemart.net
West Central Wireless	phonenumber@sms.wcc.net
Western Wireless	phonenumber@cellularonewest.com
Williston	phonenumber@unavailable
Windstream	phonenumber@unavailable
WTMC	phonenumber@cellularonewest.com
XIT Communications	phonenumber@sms.xit.net
Yell County Telco	phonenumber@unavailable    
EOT;

   $gateways = [];
   #$raw = file_get_contents("raw.txt");
  #echo $raw.PHP_EOL;
  
   $arr = explode("\n", $raw);

   for($i = 0; $i < count($arr); $i++){
   #explode each newline by \t to get name and email
   $line = $arr[$i];
   $arr2 = explode("\t", $line);
   
   #if this key exists, add the value to the same entry in $gateways   
   $k = $arr2[0];  $v = $arr2[1]; 
   
   if(array_key_exists($arr2[0], $gateways) )
   {
   	array_push($gateways[$k],$v);
   }
   
   else
   {
   	$gateways[$k] = [];
   	array_push($gateways[$k],$v);
   } 
   
  } 
 
 
 return $gateways;           	
            }
           
           function getCarrierNames()
           {
$ret = ["CITIZENS TELECOMM CO OF NY DBA FRONTIER COMM OF NY"=> "Frontier",
"FRONTIER TELEPHONE OF ROCHESTER"=> "Frontier",
"COMMONWEALTH TELEPHONE COMPANY"=> "Frontier",
"VERIZON NORTH INC.-PA"=> "Verizon Wireless",
"BOOST TELECOM CO."=> "Boost",
"VERIZON SOUTH INC.-VA (CONTEL)"=> "Verizon Wireless",
"CENTRAL TELEPHONE CO. - VIRGINIA"=> "CenturyLink",
"BUTLER TELEPHONE CO., INC."=> "Butler",
"GTC, INC. - FL"=> "GTC",
"KMC TELECOM V, INC. - AR"=> "KMC Telecom",
"VALLEY TELEPHONE CO., INC."=> "Valley",
"VERIZON FLORIDA INC."=> "Verizon Wireless",
"SMART CITY TELECOM LLC DBA SMART CITY TELECOM"=> "Smart Telecom",
"SPRINT-FLORIDA, INC. DBA CENTRAL TEL CO.OF FLORIDA"=> "Sprint PCS",
"SPRINT-FLORIDA, INC. DBA UNITED TEL OF FLORIDA"=> "Sprint PCS",
"COASTAL UTILITIES, INC."=> "Coastal Utilities",
"ALLTEL GEORGIA, INC."=> "Alltel",
"HAWKINSVILLE TELEPHONE COMPANY"=> "Comsouth",
"PLANT TELEPHONE CO."=> "Plant",
"STANDARD TELEPHONE CO."=> "Standard",
"FRONTIER COMMUNICATIONS OF GEORGIA, INC."=> "Frontier",
"BRANDENBURG TELEPHONE CO."=> "Brandenburg",
"LOGAN TELEPHONE COOPERATIVE, INC."=> "Logan",
"SOUTH CENTRAL RURAL TELEPHONE COOP. CORP, INC."=> "South Central Communications",
"CENTURYTEL OF SOUTHEAST LOUISIANA, INC."=> "CenturyTel",
"BAY SPRINGS TELEPHONE CO., INC."=> "Bay Springs Telco",
"ATLANTIC TELEPHONE MEMBERSHIP CORP."=> "ATMC",
"SPRINT MID ATLANTIC"=> "Sprint PCS",
"CENTRAL TELEPHONE CO. - NORTH CAROLINA"=> "CenturyLink",
"CONCORD TELEPHONE CO."=> "Concord",
"ALLTEL CAROLINA - NORTH, INC."=> "Alltel",
"LEXCOM TELEPHONE COMPANY"=> "Lexcom",
"UNITED TELEPHONE CO. OF THE CAROLINAS"=> "CenturyLink",
"WILKES TELEPHONE MEMBERSHIP CORP."=> "WTMC",
"FARMERS TELEPHONE COOPERATIVE, INC."=> "Farmers Telephone Coop",
"LANCASTER TELEPHONE CO."=> "Lancaster",
"PIEDMONT RURAL TELEPHONE COOPERATIVE, INC."=> "Piedmont",
"RIDGEWAY TELEPHONE CO., INC."=> "Ridgeway",
"ROCK HILL TELEPHONE CO."=> "Rock Hill",
"SANDHILL TELEPHONE COOPERATIVE, INC."=> "SHTC",
"WILLISTON TELEPHONE CO."=> "Williston",
"DEKALB TELEPHONE COOPERATIVE"=> "DTC",
"TENNESSEE TELEPHONE CO."=> " Tennessee Telephone",
"PEOPLES TELEPHONE CO., INC."=> " Peoples Telephone",
"VERIZON NORTH INC.-OH"=> "Verizon Wireless",
"CENTURYTEL OF OHIO, INC."=> "CenturyTel",
"UNITED TELEPHONE CO. OF OHIO"=> "CenturyLink",
"VERIZON NORTH INC.-MI"=> "Verizon Wireless",
"VERIZON NORTH INC.-IN"=> "Verizon Wireless",
"LEAP WIRELESS INTL, INC. DBA CRICKET COMM, INC."=> "AT&T",
"VERIZON NORTH INC.-WI"=> "Verizon Wireless",
"NEW MEXICO RSA 6-III PARTNERSHIP DBA LEACO RURAL"=> "LEACO Rural",
"VERIZON NORTH INC.-IL"=> "Verizon Wireless",
"CENTURYTEL OF NORTHWEST ARKANSAS, LLC -RUSSELLVILL"=> "CenturyTel",
"SPECTRA COMMUNICATIONS GROUP, LLC"=> "CenturyLink",
"VALOR TELECOMMUNICATIONS OF TEXAS, LP#1"=> "Valor",
"VALOR TELECOMMUNICATIONS OF OKLAHOMA, LLC - OK"=> "Valor",
"IOWA TELECOMM SVCS DBA IOWA TELECOM - NORTH"=> "Iowa Telecom",
"VALOR TELECOMMUNICATIONS OF TEXAS, LP#2"=> "Valor",
"ALLTEL NEBRASKA, INC."=> "Alltel",
"MAGAZINE TELEPHONE CO."=> "Magazine",
"PRAIRIE GROVE TELEPHONE CO."=> "PG Telco",
"YELL COUNTY TELEPHONE CO., INC."=> "Yell County Telco",
"SPRINT/UNITED TELEPHONE CO. OF MISSOURI"=> "CenturyLink",
"CENTRAL OKLAHOMA TELEPHONE CO."=> "Central Oklahoma Telco",
"OKLAHOMA COMMUNICATION SYSTEM, INC."=> "Oklahoma Communications System",
"OKLAHOMA ALLTEL, INC."=> "Alltel",
"TOTAH TELEPHONE CO., INC."=> "Totah",
"SPRINT/UNITED TELEPHONE CO. OF TEXAS"=> "CenturyLink",
"GLENN ISHIBARA DBA NTCH - IDAHO, INC."=> "Cleartalk",
"TXU COMMUNICATIONS TELEPHONE COMPANY"=> "Txu Communications",
"CENTRAL TELEPHONE CO. - TEXAS"=> "CenturyLink",
"SUGAR LAND TELEPHONE CO."=> "Windstream",
"GTE-SW DBA VERIZON SW INC.-TX (CONTEL)"=> "Verizon Wireless",
"CENTURYTEL OF EAGLE, INC."=> "CenturyTel",
"VERIZON CALIFORNIA INC."=> "Verizon Wireless",
"CITIZENS TELECOM CA. DBA FRONTIER COM OF CA"=> "Frontier",
"VERIZON CALIFORNIA INC.-CA (GTE)"=> "Verizon Wireless",
"SUREWEST TELEPHONE"=> "Surewest Communications",
"CENTRAL TELEPHONE CO. - NEVADA"=> "CenturyLink",
"POINTE COMMUNICATIONS CORP. - CA"=> "Pointe",
"CINCINNATI BELL WIRELESS, LLC"=> "Cincinnati Bell",
"TW WIRELESS, LLC"=> "Qwest",
"ACS OF ANCHORAGE, INC."=> "Alaska Communications",
"AT&T ALASCOM"=> "AT&T",
"ACS OF THE NORTHLAND, INC."=> "Alaska Communications",
"VERIZON HAWAII INC.-HI"=> "Verizon Wireless",
"KENTUCKY RSA 3 CELLULAR GENERAL PARTNERSHIP"=> "Kentucky RSA",
"PUERTO RICO TELEPHONE CO."=> "Verizon Wireless",
"CAVALIER TELEPHONE MID-ATLANTIC. LLC - PA"=> "Windstream",
"VIRGIN ISLANDS TEL. CORP. DBA INNOVATIVE TELEPHONE"=> "Innovative Telephone",
"TEXACOM CORPORATION"=> "Texacom",
"CHOICE WIRELESS LC"=> "Choice Wireless",
"AMARILLO CELLTELCO DBA CELLULAR ONE OF AMARILLO"=> "Cellular One",
"GUAM TELEPHONE AUTHORITY"=> "GTA Teleguam",
"EDGE WIRELESS, LLC"=> "AT&T",
"WEST COAST PCS LLC"=> "Verizon Wireless",
"New England Voice & Data"=> "Earthlink",
"FLORIDA DIGITAL NETWORK"=> "FDN Communications",
"INTEGRA TELECOM OF WASHINGTON, INC. - WA"=> "Integra",
"SMITH BAGLEY INC. DBA CELLULAR ONE OF NE ARIZONA"=> "Cellular One",
"SLO CELLULAR, INC."=> "Cellular One",
"VERIZON NORTHWEST INC.-OR"=> "Verizon Wireless",
"VERIZON NORTHWEST INC.-WA"=> "Verizon Wireless",
"ALLTEL GEORGIA COMMUNICATION CORP."=> "Alltel",
"VERIZON SOUTH INC.-NC"=> "Verizon Wireless",
"GTE-SW DBA VERIZON SW INC.-TX"=> "Verizon Wireless",
"GEORGIA ALLTEL TELECOMM, INC."=> "Alltel",
"FRONTIER COMMUNICATIONS OF THE SOUTH, INC. - AL"=> "Frontier",
"LIBERTY TELECOM LLC"=> "Liberty Telecom",
"COMCAST PHONE OF MINNESOTA, INC. - MN"=> "Comcast",
"BROADVIEW NETWORKS, INC. - NY"=> "Broadview",
"ITC DELTA COM - AL"=> "Earthlink",
"CAVALIER TELEPHONE, L.L.C."=> "Windstream",
"XO MARYLAND, LLC"=> "Verizon Wireless",
"LEVEL 3 COMMUNICATIONS, LLC - NJ"=> "CenturyLink",
"MADISON RIVER COMMUNICATIONS, LLC-NC"=> "Madison River",
"NEXTEL PARTNERS OPERATING CORP."=> "Nextel",
"IONEX COMMUNICATIONS, INC. - OK"=> "Ionex",
"LOUISIANA COMPETITIVE TELECOMMUNICATIONS, INC."=> "LCT",
"GLOBAL NAPS, INC. - NY"=> "Global Naps",
"WESTERN WIRELESS CORPORATION-CO"=> "Western Wireless",
"WESTERN WIRELESS CORPORATION-IA"=> "Western Wireless",
"WESTERN WIRELESS CORPORATION-KS"=> "Western Wireless",
"WESTERN WIRELESS CORPORATION-MT"=> "Western Wireless",
"WESTERN WIRELESS CORPORATION-ND"=> "Western Wireless",
"WESTERN WIRELESS CORPORATION-NM"=> "Western Wireless",
"WESTERN WIRELESS CORPORATION-OK"=> "Western Wireless",
"WESTERN WIRELESS CORPORATION-TX"=> "Western Wireless",
"LEVEL 3 COMMUNICATIONS, LLC - AR"=> "CenturyLink",
"TIME WARNER TELECOM OF SOUTH CAROLINA LLC-SC"=> "Unknown",
"METRO PCS, INC."=> "Metro PCS",
"TENNESSEE RSA NO. 3 LIMITED PARTNERSHIP"=> "Unknown",
"NORTH CAROLINA RSA 3 CELL TEL CO DBA CAROLINA WEST"=> "Carolina West Wireless",
"KEY COMMUNICATIONS, L.L.C."=> "Key Communications",
"CELLCO PARTNERSHIP DBA VERIZON WIRELESS - CA"=> "Verizon Wireless",
"CELLCO PARTNERSHIP DBA VERIZON WIRELESS - MD"=> "Verizon Wireless",
"PACIFICOM-ALASKA, LLC"=> "Unknown",
"AT&T WIRELESS SERVICES, INC."=> " AT&T",
"CRICKET COMMUNICATIONS, INC."=> "Cricket",
"RURAL CELLULAR CORP. DBA RCC NETWORK INC"=> "Verizon Wireless",
"FOCAL COMMUNICATIONS CORP OF NEW JERSEY"=> "CenturyLink",
"XO FLORIDA, INC."=> "Verizon Wireless",
"COMCAST PHONE OF MASSACHUSETTS, INC. - MA"=> "Comcast",
"KMC TELECOM III, INC. - MI"=> "KMC Telecom",
"ATLANTA - ATHENS MSA LIMITED PARTNERSHIP"=> "Cingular Wireless",
"NEXTEL COMMUNICATIONS"=> "Nextel",
"USCC-TSI"=> "US Cellular",
"ALLTEL MOBILE COMMUNICATIONS, INC. - NO. CAROLINA"=> "Alltel",
"ACS WIRELESS, INC."=> "Alaska Communications",
"HIGHLAND CELLULAR, INC."=> "AT&T",
"NETWORK SERVICES LLC (TSR)"=> "TSR Wireless",
"Western_Wireless-Verisign"=> "Western Wireless",
"METROCALL"=> "Metrocall",
"MAP MOBILE COMMUNICATIONS, INC."=> "Unknown",
"T-MOBILE USA, INC."=> "T-Mobile",
"CENTENNIAL SOUTHEAST LICENSE COMPANY LLC"=> "Centennial Wireless",
"CELLULAR SOUTH, INC."=> "Cellular South",
"TELEPAK, INC."=> "Unknown",
"SOURCE ONE WIRELESS"=> "Unknown",
"CENTENNIAL WIRELESS OF PUERTO RICO"=> "Centennial Wireless",
"PUBLIC SERVICE CELLULAR, INC."=> "Public Service Cellular",
"MERRYVILLE INVESTMENTS LTD, INC. DBA BEST PAGE"=> "Unknown",
"CENTENNIAL MICHIANA LICENSE COMPANY LLC"=> "Centennial Wireless",
"ARCH WIRELESS HOLDINGS, INC."=> "Arch Wireless",
"SPRINT SPECTRUM L.P."=> "Sprint",
"DOBSON CELLULAR SYSTEMS, INC."=> "Dobson Cellular Systems",
"HEARTLAND COMMUNICATIONS, INC."=> "Unknown",
"NEW CELL, INC. DBA CELLCOM"=> "Cellcom",
"RCC HOLDINGS, INC."=> "Verizon Wireless",
"AIRSTAR PAGING"=> "Unknown",
"SOUTHERN COMMUNICATIONS SERVICES"=> "Southern LINC",
"PORTA-PHONE DIV OF JOHN H. PHIPPS, INC"=> "Porta Phone",
"TRINITY INTERNATIONAL INC"=> "Unknown",
"VIRGINIA PCS ALLIANCE, L.C."=> "Ntelos",
"GULF COAST WIRELESS LIMITED PARTNERSHIP"=> "Unknown",
"R AND G DISTRIBUTORS"=> "Unknown",
"SOUTHERN ILLINOIS RSA PARTNERSHIP"=> "Unknown",
"GCI COMMUNICATION CORP. DBA GENERAL COMMUNICATION"=> "GCI",
"QWEST WIRELESS, LLC"=> "Qwest",
"MOBILE PARTNERS CORPORATION"=> "Unknown",
"HARGRAY WIRELESS, LLC"=> "Cricket",
"MONTANA WIRELESS, INC."=> "Verizon Wireless",
"NETWORK SERVICES LLC"=> "American Messaging",
"CONESTOGA WIRELESS COMPANY"=> "Windstream",
"Rural_Cellular-Verisign"=> "Verizon Wireless",
"COMSCAPE TELECOMMUNICATIONS, INC."=> "Unknown",
"Midwest Wireless"=> "Midwest Wireless",
"EAST KENTUCKY NETWRK, LLC DBA APPALACHIAN WIRELESS"=> "Appalachian Wireless",
"WIRELESS ALLIANCE LLC"=> "Verizon Wireless",
"LOUISIANA UNWIRED LLC"=> "Sprint",
"RURAL CELLULAR CORPORATION"=> "Verizon Wireless",
"CTC EXCHANGE SERVICES, INC."=> "Concord",
"XO ILLINOIS, INC."=> "Verizon Wireless",
"Focal-Illuminet"=> "CenturyLink",
"FOCAL COMMUNICATIONS CORP OF NEW YORK"=> "CenturyLink",
"COX ARIZONA TELECOM, INC."=> "Unknown",
"TELEPORT COMMUNICATIONS GROUP"=> "AT&T",
"MCI WORLDCOM COMMUNICATIONS INC. - NY"=> "Verizon Wireless",
"TELEPORT COMMUNICATIONS GROUP - BOSTON"=> "AT&T",
"TELEPORT COMMUNICATIONS GROUP - NY"=> "AT&T",
"TELEPORT COMMUNICATIONS GROUP - NEW YORK - NJ"=> "AT&T",
"COMCAST PHONE OF GEORGIA, LLC - GA"=> "Comcast",
"Time Warner Telecom"=> "Unknown",
"ADELPHIA BUSINESS SOLUTIONS OF VERMONT, INC."=> "Unknown",
"COX CABLE OKLAHOMA CITY INC."=> "Unknown",
"ACC NATIONAL TELECOM CORPORATION - NY"=> "Unknown",
"MCIMETRO, ATS, INC."=> "Verizon Wireless",
"BROOKS FIBER COMMUNICATIONS - CONNECTICUT"=> "Unknown",
"TIME WARNER TELECOM OF CALIFORNIA, LP - CA"=> "Unknown",
"BROOKS FIBER COMMUNICATIONS - ARKANSAS"=> "Unknown",
"XO WASHINGTON, INC."=> "Verizon Wireless",
"PAC - WEST TELECOMM, INC."=> "Unknown",
"AT&T LOCAL"=> "AT&T",
"U.S. TELEPACIFIC CORP. - CA"=> "Unknown",
"PACIFIC BELL - CLEC"=> "Pacific Bell",
"TIME WARNER COMMUNICATIONS AXS OF MEMPHIS, TN"=> "Unknown",
"AT&T CORP DBA TCG - CALIFORNIA - CA"=> "AT&T",
"TELEPORT COMMUNICATIONS GROUP, INC. - OR"=> "AT&T",
"COMCAST PHONE OF FLORIDA, LLC - FL"=> "Comcast",
"ADELPHIA BUSINESS SOLUTIONS OF JACKSONVILLE, INC."=> "Unknown",
"Comcast Phone"=> "Comcast",
"TOLEDO AREA TELECOMM SVCS DBA BUCKEYE TELESYSTEM"=> "Unknown",
"AIRADIGM COMMUNICATIONS INC"=> "Airfire Mobile",
"COX CALIFORNIA TELECOM, INC."=> "Unknown",
"DELTACOM"=> "EarthLink",
"GLOBAL NAPS, INC.-MA"=> "Global Naps",
"ALLEGIANCE TELECOM, INC. - NY"=> "Verizon Wireless",
"COMCAST PHONE OF VIRGINIA, INC. - VA"=> "Comcast",
"TDS METROCOM INC. - WI"=> "AT&T",
"INTERMEDIA COMMUNICATIONS INC. - NC"=> "Verizon Wireless",
"ALLTEL COMMUNICATIONS, INC. - NC"=> "Alltel",
"GLOBAL CROSSING LOCAL SERVICES, INC.-MA"=> "CenturyLink",
"IDS TELCOM LLC"=> "Unknown",
"KNOLOGY OF GEORGIA"=> "Unknown",
"TELEPORT COMMUNICATIONS ATLANTA, INC. - GA"=> "AT&T",
"ALLEGIANCE TELECOM, INC. - TX"=> "Verizon Wireless",
"IOWA WIRELESS SERVICES, LP"=> "i-wireless",
"PENN TELECOM, INC."=> "Unknown",
"TRITON PCS OPERATING COMPANY, LLC"=> "SunCom",
"NEWSOUTH COMMUNICATIONS CORP"=> "Windstream",
"INTERMEDIA COMMUNICATIONS INC. - FL"=> "Verizon Wireless",
"GLOBAL CROSSING LOCAL SERVICES, INC.-IL"=> "CenturyLink",
"NORTHCOAST COMMUNICATIONS, LLC"=> "Verizon Wireless",
"Sprint-ION"=> "Sprint",
"SPRINT COMMUNICATIONS COMPANY, L.P. - AZ"=> "Sprint",
"SPRINT COMMUNICATIONS COMPANY, L.P. - NJ"=> "Sprint",
"SPRINT COMMUNICATIONS COMPANY, L.P. - TX"=> "Sprint",
"FOCAL COMMUNICATIONS CORP OF PENNSYLVANIA"=> "CenturyLink",
"COX RHODE ISLAND TELECOM INC"=> "AT&T",
"XO D.C., INC."=> "Verizon Wireless",
"VERIZON NEW ENGLAND INC."=> "Verizon Wireless",
"VERIZON NEW YORK, INC."=> "Verizon Wireless",
"SOUTHERN NEW ENGLAND TELEPHONE CO."=> "AT&T",
"VERIZON NEW JERSEY, INC."=> "Verizon Wireless",
"VERIZON PENNSYLVANIA, INC."=> "Verizon Wireless",
"VERIZON DELAWARE, INC."=> "Verizon Wireless",
"VERIZON WASHINGTON, DC INC."=> "Verizon Wireless",
"VERIZON MARYLAND, INC."=> "Verizon Wireless",
"VERIZON VIRGINIA, INC."=> "Verizon Wireless",
"VERIZON WEST VIRGINIA"=> "Verizon Wireless",
"Ameritech"=> "Ameritech",
"AMERITECH OHIO"=> "Ameritech",
"AMERITECH MICHIGAN"=> "Ameritech",
"AMERITECH INDIANA"=> "Ameritech",
"AMERITECH WISCONSIN"=> "Ameritech",
"AMERITECH ILLINOIS"=> "Ameritech",
"CINCINNATI BELL, INC."=> "Cincinnati Bell",
"BELLSOUTH TELECOMM INC DBA SOUTHERN BELL TEL & TEL"=> "Bell South",
"BELLSOUTH TELECOMM INC DBA SOUTH CENTRAL BELL TEL"=> "Bell South",
"SOUTHWESTERN BELL"=> "Southwestern Bell",
"QWEST CORPORATION"=> "Qwest",
"QWEST CORPORATION"=> "Qwest",
"QWEST CORPORATION"=> "Qwest",
"PACIFIC BELL"=> "Pacific Bell",
"NEVADA BELL"=> "AT&T",
"CENTURYTEL OF MISSOURI, LLC (SOUTHERN)"=> "CenturyTel",
"CENTURYTEL TEL OF ALABAMA, LLC (SOUTHERN)"=> "CenturyTel",
"NEW CINGULAR WIRELESS PCS, LLC - IL" => "Cingular", 
"NEW CINGULAR WIRELESS PCS, LLC - DC" => "Cingular", 
"OMNIPOINT COMMUNICATIONS, INC. - NY" => "AT&T", 
];

return $ret;           	
           }
   
}
?>