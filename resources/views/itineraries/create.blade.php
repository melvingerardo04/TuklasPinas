@extends('layouts.app')
@section('content')

<div class="panel panel-default" style="margin-top:50px;">
    {!! Form::open(['action' => 'ItineraryController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!} 
        <div class="panel-heading">
            <h1 class="text-center">Create Itinerary</h1>
        </div>
        <div class="panel-body">
            <div class="row col-md-12">
                <div class="form-group ">
                    <div class="col-md-2 col-md-offset-4 text-center">
                        <label for="days1" value="days1" name="days1">Days</label>
                        <input type="number" name="days1" class="col-md-1  form-control" required placeholder="Days" autocomplete="off">
                    </div>
                    <div class="col-md-2 text-center" >
                        <label for="nights" value="nights" name="nights">Nights</label>
                        <input type="number" name="nights" class="col-md-1 form-control"placeholder="Nights" autocomplete="off">
                    </div>
                </div>
            </div>
            <br>
            <table class="table table-bordered" style="margin-top:50px;">
                <thead>
                    <tr> 
                        <th> Provinces/Cities/Countries</th>
                        <th><input type="text" name="provinces_name" class="form-control" required autocomplete="off"></th>
                        <th></th>
                        <th>Budget</th>
                        <th><input type="number" name="budget" class="form-control" required autocomplete="off"></th>
                    </tr>
                    <tr>
                        <th>Days</th>
                        <th>Places</th>
                        <th>Time</th>
                        <th>Stories</th>
                        <th>Other Expenses</th>  
                        <th><a href="#" class="addRow"><i class="glyphicon glyphicon-plus" style="color:black;font-size:20px;width:5px;"></i></a></th>   
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><input type="text" name="days[]" class="form-control" required autocomplete="off"></td>
                        <td><input type="text" name="places[]" class="form-control" required></td>
                        <td><input type="time" name="time[]" class="form-control" required></td>
                        <td><textarea name="activities[]" class="form-control" rows="1" required></textarea></td>
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
                        <td class="text-right"> <b class="total ">0.00</b></td>
                        <td> <input class="btn btn-success" type="submit" name="" value="Submit"></td>     
                    </tr>
                </tfoot>
            </table>
        </div>
    {!! Form::close() !!}
</div>
<script src="{{ asset ("js/jQuery-2.1.3.min.js") }}"></script>
<script src="{{ asset ("js/modernizr.js") }}"></script>
<script src="{{ asset ("https://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.min.js") }}"></script>
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
        '<td><textarea name="activities[]" class="form-control" rows="1" required></textarea></td>'+
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
    @endsection