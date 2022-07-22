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
		"sDom": "<'row separator bottom'<'col-md-9'><'col-md-3'l><'col-md-8'>r>t<'row'<'col-md-6'i><'col-md-6'p>>",
		"oLanguage": {
			"sLengthMenu": "_MENU_ Show"
		},
		"fnInitComplete": function () {
	    	fnInitCompleteCallback(this);
        },
	    "aoColumnDefs": [
          { 'sClass':'col-md-1', 'aTargets': [ 0 ] },
          { 'sClass':'col-md-3', 'aTargets': [ 1 ] },
        //   { 'sClass':'center nopadding','sWidth':'20px', 'bSortable': false, 'aTargets': [ 3 ] }
       	],
       	"aaSorting": [[0,'desc'],[1,'desc']],
        "bProcessing": true,
        "bServerSide": true,
        "bPaginate":true,
        // "bInfo" : false,
        "sAjaxSource": "{{ url('postTable') }}",
        "fnRowCallback": function( nRow, aData, iDisplayIndex, iDisplayIndexFull ) {
            $(nRow).find(".fa-edit").parent().unbind("click").on("click",function(){
                var form_data = $(this).data();
                form_data = $(this).serializeArray();
                form_data.push({
				name : 'id',
				value: "{{ csrf_token() }}"
			});
                $.ajax({
					url: "{{ route('editpost') }}",
					type: "POST",
					dataType : "JSON",
					data: form_data,
					success:function(dta){
                        console.log(form_data);
					}
				});
            });
            $(nRow).find(".fa-trash").parent().unbind("click").on("click",function(){
                var form_data = $(this).data();
                $.ajax({
					url: "{{ route('destroy') }}",
					type: "POST",
					dataType : "JSON",
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