@extends('layouts.app')
@section('content')

<div class="col-md-12">
    <!-- Custom Tabs -->
    <div class="nav-tabs-custom">
      <ul class="nav nav-tabs">
        <li class="active"><a href="#itineraries" data-toggle="tab">Itineraries</a></li>
        <li><a href="#includes" data-toggle="tab">Includes</a></li>
      </ul>
      <div class="tab-content">
        <div class="tab-pane active" id="itineraries">
            <form  method="POST" id="form_info" role="form">
                <div class="row">
                    <div class="form-group col-md-12">
                        <div class="form-group col-md-3">
                            <label for="provinces" value="provinces" name="provinces"> Provinces/Cities/Countries</label>
                            <input type="text" name="provinces_name" class="form-control" required autocomplete="off">
                        </div>
                        <div class="form-group col-md-2">
                            <label for="budget" value="budget" name="budget"> Budget</label>
                            <input type="number" name="budget" class="form-control" required autocomplete="off">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-12">
                        <div class="col-md-2">
                            <label for="days1" value="days1" name="days1">No of Days</label>
                            <input type="number" id="noOfDays" name="noOfDays" class="col-md-1  form-control" required placeholder="Days" autocomplete="off">
                        </div>
                        <div class="col-md-2" >
                            <label for="nights" value="nights" name="nights">Nights</label>
                            <input type="number" name="nights" class="col-md-1 form-control"placeholder="Nights" autocomplete="off">
                        </div>
                        {{-- <div class="col-md-2" style="margin-top:25px;">
                            <a href="#" class="btn btn-primary addRow"><i class="fa fa-plus" style="color:white;"></i></a>
                        </div> --}}
                    </div>
                </div>
                <div class="row itinerary">
        
                </div>
                <div class="row ">
                    <div class="form-group col-md-12">
                        <input class="pull-right btn btn-danger next" type="submit" name="" value="Next">
                    </div>
                </div>
            </form>
        </div>

        <!--Includes Tab -->
        <div class="tab-pane" id="includes">

            
        </div>
       
      </div>
    </div>
   
    
</div>
<script src="{{ asset ("js/jQuery-2.1.3.min.js") }}"></script>
<script src="{{ asset ("js/modernizr.js") }}"></script>
<script src="{{ asset ("https://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.min.js") }}"></script>
<script>



$('#noOfDays').unbind("change").on("change",function(e){
    $('.itinerary').html('');
    var value = parseFloat($('#noOfDays').val() ) + 1;
    value = value;
    console.log(value);
    for ( i = 1; i < value; i++) {
        var div = 
            '<div class="row nextRow" id="row'+i+'">'+
                '<div class="form-group col-md-12 ">'+
                    '<div class="col-md-2" >'+
                        '<label for="noOfDays" name="noOfDays">Days</label>'+
                        '<input type="number" name="days[]"  value='+i+' class="form-control" required autocomplete="off">'+
                    '</div>'+
                    '<div class="col-md-2 addTime" >'+
                        '<label for="time" name="time">Time</label>'+
                        '<input type="time" name="daystime'+i+'[]" class="form-control" required>'+
                    '</div>'+
                    '<div class="col-md-5 addActivities" >'+
                        '<label for="activities" name="activities">Activities</label>'+
                        '<input type="text" name="daysactivities'+i+'[]" class="form-control" required>'+
                    '</div>'+
                    '<div class="col-md-2 addImage" >'+
                        '<label for="Image" name="Image">Image</label>'+
                        '<input type="file" name="daysImage'+i+'[]" multiple class="form-control" required>'+
                    '</div>'+
                    '<div class="col-md-1 addClose" >'+
                        '<label for="" name="">&nbsp;</label>'+
                        '<a href="#" class="form-control btn btn-primary addRow" id="addRow"  data-id='+i+'> <i class="fa fa-plus"></i></a>'+
                    '</div>'+    
                '</div>'+
            '</div>';
            $(".itinerary").append(div);
            $('.addRow').unbind("click").on('click',function(){
                addRow($(this).data('id'));
            });
        }

});

function addRow(id){
    var addTime=
    
    '<div class="form-group col-md-12">'+
        '<div class="col-md-2 col-md-offset-2" >'+
            '<input type="time" name="daystime'+id+'[]" class=" form-control" required>'+
        '</div>'+
        '<div class="col-md-5" >'+
            '<input type="text" name="daysactivities'+id+'[]" class="form-control" required>'+
        '</div>'+
        '<div class="col-md-2 addImage" >'+
            // '<label for="Image" name="Image">Image</label>'+
            '<input type="file" name="daysImage'+i+'[]" multiple class="form-control" required>'+
        '</div>'+
        '<div class="col-md-1 " >'+
            // '<label for="" name="">&nbsp;</label>'+
            '<button href="#" class="form-control btn btn-danger removeRow" data-id="delete'+id+'" > <i class="fa fa-trash"></i></button>'+
        '</div>'+ 
    '</div>';
    $('#row'+id+'').append(addTime);
};
$('.removeRow').live('click', function(){
    var last=$('.nextRow').length;
    console.log(last);
    if(last==1){
    alert("You can't remove last row");
    }
    else{
    $(this).parent().parent().remove();
    }
});


$('#form_info').unbind('submit').on('submit',function(){
		$.notyfy.closeAll();
		var form_data = $(this).serializeArray();
 
            form_data.push({
                name : '_token',
                value: "{{ csrf_token() }}"
            });
		$("button[type='submit']").button('loading');	
		$.ajax({
			url: "{{ route('saveItineraries') }}",
			type: "POST",
			dataType : "JSON",
			data: form_data,
			success:function(dta){
				$("button[type='submit']").button('reset');
			}
		});
		return false;
	});

</script>
@endsection