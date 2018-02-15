<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>G Toolz | Carrier Lookup</title>

    <!-- Bootstrap Core CSS -->
    <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="{{asset('css/sb-admin.css')}}" rel="stylesheet">
    
    <!-- Custom Fonts -->
    <link href="{{asset('font-awesome/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="/email2sms">~~~~G Toolz~~~~</a>
            </div>
            <!-- Top Menu Items -->
            <ul class="nav navbar-right top-nav">
                <li>
                       <a href="/lookup"><i class="fa fa-fw fa-phone"></i> Phone Lookup</a>
                </li>
                <li>
                       <a href="#"><i class="fa fa-fw fa-envelope"></i> Email Lookup</a>
                </li>
            </ul>
        </nav>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                           Phone Lookup <small> Lookup Toolz </small>
                        </h1>
                        <ol class="breadcrumb">
                            <li class="active">
                                <i class="fa fa-dashboard"></i> Phone Lookup
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->

                <div class="row">
                    <div class="col-lg-12">
                        <div class="alert alert-info alert-dismissable">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <i class="fa fa-info-circle"></i>  <strong>Like Phone Lookup?</strong> Try out <a href="#" class="alert-link">Email Lookup</a> !
                        </div>
                    </div>
                </div>
                <!-- /.row -->
                
                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title"><i class="fa fa-phone fa-fw"></i> Phone Lookup</h3>
                            </div>
                            <div class="panel-body" id="searchbox">
                                  <form method="post" class="form-horizontal" id="lookup-form" action="{{url('lookup')}}">
                                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                                    <div class="row">
                                        <input type="hidden" id="test" name="test" value="456">
                                        <div class="col-md-11 col-sm-11 col-xs-11">
                                            <div class="form-group" style="margin-left: 3px;">
                                                <textarea class="form-control required pageload-focus" data-label="Phone numbers" name="phonenums" id="phonenums" rows="8" required></textarea>
                                                <p class="help-block"><small>Phone numbers (one number per line)</small></p>
                                                <div style='margin-top: 10px;'>
                                                   <button class="btn btn-success btn-lg" type="submit">
                                                     <i class="glyphicon glyphicon-search"></i> Search
                                                   </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                <div id="search-loading" class="col-sm-6 text-center hidden">
                                      Processing.. <img src="img/loading.gif" width="150" height="150"/>
                                </div>
                                <div id="search-result" class="hidden">
                                	<table id="st" class="table table-responsive">
                                	 <thead>
                                	  <tr>
                                	   <th>Area code</th>
                                       <th>Prefix</th>
                                       <th>City/Switch</th>
                                       <th>State</th>
                                       <th>Tel Company</th>
                                       <th>Gateway Email</th>
                                      </tr>
                                     </thead>
                                     <tbody></tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="{{asset('js/jquery.js')}}"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="{{asset('js/bootstrap.min.js')}}"></script>

        <script>
    	
    $(document).ready(function(){

        //lookform submit for all freesites
        $('#lookup-form').submit(function(e){
            var valError = false;
            var errors = '';
            $('#st > tbody').html("");
            
            var $requiredFields = $(this).find('.required');
            if ($requiredFields.length){
                $requiredFields.each(function( index ) {
                    if ($.trim($(this).val()) == ''){
                        valError = true;
                        errors += $(this).attr('data-label') + ' can not be empty'+"\n";
                    }
                });
            }
            
            if (valError){
                alert(errors);
                return false;
            }
            
            var $loading = $('#search-loading');
            var $resultBox = $('#search-result');
            
            
            $.ajax({
                url: $(this).attr('action'),
                type: 'post',
                data: $(this).serialize(),
                dataType: "json", 
                beforeSend: function() {
                    $loading.addClass('show').removeClass('hidden');
                    $resultBox.addClass('hidden').removeClass('show');
                },
                complete: function() {
                    $loading.addClass('hidden').removeClass('show');
                    $('html, body').animate({
                        scrollTop: $("#searchbox").offset().top}, 500
                    );
                },
                success: function(response) {
                	console.log(response);
                    ss = response.ss; raw = response.raw; nums = response.nums;
                
                   for(var i = 0; i < response.ret.length; i++){
                   num = nums[i];
                   el = $('<div></div>');
                     el.html(response.ret[i]);
                     data = $('td > a',el);

                    tr = $('<tr></tr>');
                    c = 0;
                    carrier = "";
                    	
                      data.each(function(){
                    	  ++c;                          
                          if(c >5) {}         
                          else{
                          	if(c == 5) carrier = $(this).text();
                          	td = $('<td></td>');
                      	    console.log($(this).text());
                          	td.append($(this).text());
                              tr.append(td);        
                          }                              
                       });
                    
                       if(carrier != ""){
                          	//console.log("carrier: " + carrier + ", key: " + key);
                              for(var key in ss){                             	
                              	if(stristr(carrier, key) != false){
                              	console.log("carrier: " + carrier + ", key: " + key);
                                  
                                  gwcode = ss[key];
                                  console.log("gwcode: " + gwcode);
                                  gwsyntax = raw[gwcode];
                                  
                                  gbana = "";
                                  for(var q = 0; q < gwsyntax.length; q++){                               	
                                  	addy = gwsyntax[q].split('@');
                                      gbana += num + "@" + addy[1] + "<br>";
                                  } 
                                  
                                  td = $('<td></td>');
                                  td.append(gbana);
                                  tr.append(td);
                                } 
      		                } 
                          }               	    
                     
                     $('#st > tbody').append(tr);
                    } 
                    
                    $resultBox.addClass('show').removeClass('hidden');
                    
                }
            });
            
            response = "";ss = "";raw=""; nums="";
            return false;
            
        });
        
        
    });

   </script>
   <script>
   	function stristr(haystack, needle, bool) {
//  discuss at: http://locutus.io/php/stristr/
// original by: Kevin van Zonneveld (http://kvz.io)
// bugfixed by: Onno Marsman (https://twitter.com/onnomarsman)
//   example 1: stristr('Kevin van Zonneveld', 'Van')
//   returns 1: 'van Zonneveld'
//   example 2: stristr('Kevin van Zonneveld', 'VAN', true)
//   returns 2: 'Kevin '
var pos = 0;
haystack += '';
pos = haystack.toLowerCase().indexOf((needle + '').toLowerCase ());

if (pos === - 1) {
return false;
} 

else {
if (bool) {
return haystack. substr(0 , pos);
} 
else {
return haystack.slice(pos);
}
}
}
   </script>

</body>

</html>
