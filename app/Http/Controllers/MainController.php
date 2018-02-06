<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Helpers\Contracts\HelperContract; 
use Auth;
use Session; 
use Validator; 
use Carbon\Carbon; 

class MainController extends Controller {

	protected $helpers; //Helpers implementation
    
    public function __construct(HelperContract $h)
    {
    	$this->helpers = $h;            
    }

	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function getIndex()
    {
    	return view('index');
    }
    
    
    public function postLookup(Request $request)
	{
           $req = $request->all();
          #dd($req);
               
                $validator = Validator::make($req, [
                             'phonenum' => 'required|numeric',
                   ]);
         
                 if($validator->fails())
                  {
                       $messages = $validator->messages();
                       return redirect()->back()->withInput()->with('errors',$messages);
                 }
                
                 else
                 { 
                 	 $phone = $_POST["phonenum"];
	$npa = substr($phone,0,3); $nxx = substr($phone,3,3); $thou = substr($phone,-4);
	$result = "";
	$url = "http://www.fonefinder.net/findome.php?npa=".$npa."&nxx=".$nxx."&thoublock=".$thou."&usaquerytype=Search+by+Number&cityname=";
	echo "url is ". $url."<br><br>";
	
    $ch = curl_init();

curl_setopt($ch, CURLOPT_HEADER, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_HTTPGET, 1);
curl_setopt($ch, CURLOPT_URL, $url );
curl_setopt($ch, CURLOPT_DNS_USE_GLOBAL_CACHE, false );
curl_setopt($ch, CURLOPT_DNS_CACHE_TIMEOUT, 2 );
curl_setopt($ch, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4 );

   
    $result = curl_exec($ch);
    
    if (curl_errno ( $ch )) {
    echo curl_error ( $ch );
    curl_close ( $ch );
    exit ();
    }
    
   curl_close ( $ch );
    
    print_r($result);
    echo $result;                       
                   }                                                                                                   
	}

}
