@extends('layouts.app')
@section('content')
<center><h1>Posts</h1> </center>
<div class="col-md-12">
    <button><i class="fa fa-plus"></i></button>
    <div class="well">
        <div class='row'>
            {{-- <img style="width: 30px; height:30px;border-radius: 50%;" align="left"src="/storage/profiles/{{$post->user->profile_pic}}"> --}}
            {{-- <h5></h5>  --}}
            <div class="col-sm-12">
                <div class="form-group">
                    <table id='post' class="table table-bordered table-condensed table-primary">
                        <!-- Table heading -->
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Provinces</th>
                                <th>Itinerary</th>
                                <th>CreatedBy:</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <!-- // Table heading END -->
                        
                    </table>
                </div>
            </div>
            
        
            
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="modal-info">
	
	<div class="row">
        <div class="col-md-8 col-md-offset-3"> 
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h1> Post</h1>
                </div>
                <div class="panel-body">
                {!! Form::open(['action' => 'PostsController@updatepost', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}  
                <input type="hidden" id="postID" name ="postID" value="">          
                    <div class="form-group col-md-10 col-md-offset-1">
                        {{Form::label('title' , 'Title')}}            
                        {{Form::text('title', '' , ['id' => 'title','class' => 'form-control' ,'name' => 'title', 'required','value'=> ''])}}
                </div>
                    <div class="form-group col-md-10 col-md-offset-1">
                        {{Form::label('provinces' , 'Provinces')}}
                        {{Form::text('provinces', '' , ['id' => 'provinces','class' => 'form-control' ,'required'])}}
                    </div>  
                   
                    
                    <div class="form-group col-md-10 col-md-offset-1"></div>
                    <div class="form-group col-md-10 col-md-offset-1">
                        {{Form::label('body' , 'Post',['class' =>'body'])}}
                        {{Form::textarea('body', '' , ['id'=> 'body','class' => 'form-control' ,'required', 'value' => 'Body', 'name' => 'body'])}}        
                    </div>    
                    <div class="form-group col-md-10 col-md-offset-1">
                        {{Form::label('uploadPhoto' , 'Upload Photo')}}
                        {{Form::file('cover_image',['id'=>'cover_image','name'=>'cover_image'] )}}
                    </div>
                    <div class="form-group col-md-10 col-md-offset-1">  
                        {{Form::submit('Submit', ['class' => 'btn btn-primary'])}}
                    </div>
                {!! Form::close() !!}
            </div>
    
        </div>
    </div>
	
</div>
{{-- @push('scripts::after') --}}
    <script src="{{ asset ("js/jQuery-2.1.3.min.js") }}"></script>
    <script src="{{ asset('assets/components/modules/admin/tables/datatables/assets/lib/js/jquery.dataTables.min.js?v=v2.1.0') }}"></script>
    <script src="{{ asset('assets/components/modules/admin/tables/datatables/assets/lib/extras/TableTools/media/js/TableTools.min.js?v=v2.1.0') }}"></script>
    <script src="{{ asset('assets/components/modules/admin/tables/datatables/assets/lib/extras/ColVis/media/js/ColVis.min.js?v=v2.1.0') }}"></script>
    <script src="{{ asset('assets/components/modules/admin/tables/datatables/assets/custom/js/DT_bootstrap.js?v=v2.1.0') }}"></script>
    <script src="{{ asset('assets/components/modules/admin/forms/elements/fuelux-checkbox/fuelux-checkbox.js?v=v2.1.0') }}"></script>
    
    <script type="text/javascript">
        function fnInitCompleteCallback(that){
		var p = that.parent();
    	var l = p.find('label').not('.checkbox-custom');

    	l.each(function(index, el) {
    		var iw = $("<div>").addClass('col-md-8').appendTo($(el).parent());
    		$(el).parent().addClass('row form-horizontal').parent().addClass('form-group');
           	$(el).find('input, select').addClass('form-control').removeAttr('size').appendTo(iw);
           	$(el).addClass('col-md-4 control-label');
    	});
		var s = p.find('select').not(function(){
		return $(this).closest('.dataTables_paginate').length;
		});
		// s.addClass('selectpicker').selectpicker();
	}

        var post = $("#post").dataTable({
		"sPaginationType": "bootstrap",
		"sDom": "<'row separator bottom'<'col-md-9'><'col-md-3'l><'col-md-8'>r>t<'row'<'col-md-6'i><'col-md-6'>>",
		"oLanguage": {
			"sLengthMenu": "_MENU_ Show"
		},
		"fnInitComplete": function () {
	    	fnInitCompleteCallback(this);
        },
	    "aoColumnDefs": [
          { 'sClass':'col-md-1', 'aTargets': [ 0 ] },
        //   { 'sClass':'col-md-1', 'aTargets': [ 4 ] },
        //   { 'sClass':'col-md-2', 'aTargets': [ 2 ] },
        //   { 'sClass':'col-md-3', 'aTargets': [ 3 ] },
          { 'sClass':'col-md-2', 'aTargets': [ 4 ] },
        //   { 'sClass':'center nopadding','sWidth':'20px', 'bSortable': false, 'aTargets': [ 3 ] }
       	],
       	"aaSorting": [[0,'desc'],[1,'desc']],
        "bProcessing": true,
        "bServerSide": true,
        "bPaginate":true,
        // "bInfo" : false,
        "sAjaxSource": "{{ url('postTable') }}",
        "fnRowCallback": function( nRow, aData, iDisplayIndex, iDisplayIndexFull ) {
            $(nRow).find(".fa-eye").parent().unbind("click").on("click",function(){
                var id = $(this).data();
                var form_data = $(this).serializeArray();
                form_data.push({
                    name : 'id',
                    value: id.id
                });            
                form_data.push({
                    name : '_token',
                    value: "{{ csrf_token() }}"
                });
                $("#mainpage_content").html('<i class="fa fa-spinner fa-spin fa-2x fa-fw text-danger"></i> Loading...');
                $.ajax({
					url: "{{ route('viewpost') }}",
					type: "POST",
					// dataType : "JSON",
					data: form_data,
					success:function(dta){
                        console.log(dta);
                        $("#mainpage_content").html(dta);
                        // $("#postID").val(dta.id);
                        // $("#title").val(dta.title);
                        // $("#provinces").val(dta.provinces);
                        // $("#body").val(dta.body);
                        // // $("#cover_image").val(dta.cover_image);
                        // $("#modal-info").modal('show');
                        // console.log(dta.title);
                        // location.href = "posts/show/";
                       
					}
				});
            });
            $(nRow).find(".fa-edit").parent().unbind("click").on("click",function(){
                var id = $(this).data();
                var form_data = $(this).serializeArray();
                form_data.push({
                    name : 'id',
                    value: id.id
                });            
                form_data.push({
                    name : '_token',
                    value: "{{ csrf_token() }}"
                });
                $.ajax({
					url: "{{ route('editpost') }}",
					type: "POST",
					// dataType : "JSON",
					data: form_data,
					success:function(dta){
                        console.log(dta);
                        $("#postID").val(dta.id);
                        $("#title").val(dta.title);
                        $("#provinces").val(dta.provinces);
                        $("#body").val(dta.body);
                        // $("#cover_image").val(dta.cover_image);
                        $("#modal-info").modal('show');
                        // location.href = "posts/edit/";
                       
					}
				});
            });
            $(nRow).find(".fa-trash").parent().unbind("click").on("click",function(){
                var id = $(this).data();
                var form_data = $(this).serializeArray();
                form_data.push({
                    name : 'id',
                    value: id.id
                });            
                form_data.push({
                    name : '_token',
                    value: "{{ csrf_token() }}"
                });
                $.ajax({
					url: "{{ route('destroy') }}",
					type: "POST",
					// dataType : "JSON",
					data: form_data,
					success:function(dta){
                        console.log(form_data);
					}
				});
            });
	    }
	});
  
    </script>
{{-- @endpush --}}
@endsection