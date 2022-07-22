<html>
<head>
        <meta charset="UTF-8">
        <title>{{ config('app.name', 'Laravel') }}</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <!-- Bootstrap 3.3.2 -->
        <link href="{{ asset("css/bootstrap.min.css") }}" rel="stylesheet" type="text/css" />
        <!-- Font Awesome Icons -->
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <!-- Ionicons -->
        <link href="http://code.ionicframework.com/ionicons/2.0.0/css/ionicons.min.css" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
        <link href="{{ asset("css/AdminLTE.min.css")}}" rel="stylesheet" type="text/css" />
        <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
              page. However, you can choose any other skin. Make sure you
              apply the skin class to the body tag so the changes take effect.
        -->
        <link href="{{ asset("css/skin-blue.min.css")}}" rel="stylesheet" type="text/css" />
        <link href="{{ asset("css/background.css")}}" rel="stylesheet" type="text/css" /> 
    
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
        <link href='https://fonts.googleapis.com/css?family=Open+Sans:300,700,400' rel='stylesheet' type='text/css'>
    
        <link rel="stylesheet" href="css/reset.css"> <!-- CSS reset -->
        <link rel="stylesheet" href="css/style.css"> <!-- Resource style -->
        <link rel="stylesheet" href="https://maxcdn.bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="js/modernizr.js"></script> <!-- Modernizr -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.min.js"></script>
</head>
<body>
    @if(Auth::guest())
        @include('inc.header')    
        <section class="cd-intro">
           
          <div class="cd-intro-content bouncy">
              <p><img src="img/Final.png" height="180px" width="550px;"></p>
              
              <div class="action-wrapper" style="margin-top:-250px;">
                
                  <a href="#0" class="cd-btn main-action">Explore</a>
                  <a href="#0" class="cd-btn">Learn More</a>
              </div>
          </div>
      </section>
    @else
        @include('inc.header')
      
      <!-- Sidebar -->
        @include('inc.sidebar')
            <div class="wrapper">
                
            <!-- Content Wrapper. Contains page content -->
                <div class="content-wrapper">
                        {!! Form::open(['action' => 'ItineraryController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
                       
                    <section class="content" style="margin-top:50px;">
                        
                        <div class="panel panel-footer" style="margin-top:50px;">
                            <center><label for="Range" value="range" name="range">Range</label></center>
                            <input type="text" name="days1" class="col-md-1" required style="margin-left:400px;" placeholder="Days" autocomplete="off">
                            <input type="text" name="nights" class="col-md-1" required style="margin-left:100px;" placeholder="Nights" autocomplete="off">
                            <table class="table table-bordered" style="margin-top:50px;">
                                <thead>
                                    
                                    <tr>
                                       
                                        <th> Provinces</th>
                                        <th><input type="text" name="provinces_name" class="form-control" required autocomplete="off"></th>
                                        <th></th>
                                        <th>Budget</th>
                                        <th><input type="number" name="budget" class="form-control" required autocomplete="off"></th>
                                    </tr>
                                    <tr>
                                       
                                        <th>Days</th>
                                        <th>Places</th>
                                        <th>Time</th>
                                        <th>Activities</th>
                                        <th>Other Expenses</th>  
                                        <th><a href="#" class="addRow"><i class="glyphicon glyphicon-plus" style="color:black;font-size:20px;width:5px;"></i></a></th>   
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                      
                                        <td><input type="text" name="days[]" class="form-control" required autocomplete="off"></td>
                                        <td><input type="text" name="places[]" class="form-control" required></td>
                                        <td><input type="time" name="time[]" class="form-control" required></td>
                                        <td><input type="text" name="activities[]" class="form-control" required></td>
                                        <td><input type="text" name="expenses[]" class="form-control expenses" autocomplete="off" required></td>
                                        <td><a href="#" class="btn btn-danger remove">X</a></td>
                                    </tr>
                                </tbody>  
                                <tfoot>
                                    <tr>
                                        <td style="border: none"></td>
                                        <td style="border: none"></td>
                                        <td style="border: none"></td>
                                        <td> Total</td>
                                        <td> <b class="total"></b></td>
                                        <td> <input class="btn btn-success" type="submit" name="" value="Submit"></td>     
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </section>
                    {!! Form::close() !!}
                </div>
            </div>
        <script type="text/javascript"> 
        $('tbody').delegate('.expenses','keyup',
            function(){
                var tr=$(this).parent().parent();
                var expenses=tr.find('.expenses').val();
                var expenses=expenses; 
                tr.find('.expenses').val(expenses);
                total();
            });
        function total(){
            var total=0;
            $('.expenses').each(function(i,e){
                var expenses=$(this).val()-0;
                total +=expenses;
            });
            $('.total').html(total+".00");
        } 
            $('.addRow').on('click',function(){
            addRow();
            })
            function addRow()
            {
                var tr='<tr>'+
                '<td><input type="text" name="days[]" class="form-control" required ></td>'+
                '<td><input type="text" name="places[]" class="form-control" required></td>'+
                '<td><input type="time" name="time[]" class="form-control" required></td>'+
                '<td><input type="text" name="activities[]" class="form-control" required></td>'+
                '<td><input type="text" name="expenses[]" class="form-control expenses" autocomplete="off" required></td>'+
                '<td><a href="#" class="btn btn-danger remove">X</a></td>'+
                '</tr>';
                $('tbody').append(tr);
            };
            $('.remove').live('click', function(){
                var last=$('tbody tr').length;
                if(last==1){
                alert("You can't remove last row");
                }
                else{
                $(this).parent().parent().remove();
                }
            });
        </script>
    @endif
</body>
</html>