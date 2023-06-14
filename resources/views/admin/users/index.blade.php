@extends('admin.layouts.app')

@section('content')
<center><h1>Users</h1> </center>

<div class=" col-md-12">
    <div class="well">
        <div class="row">
            <div class="col-sm-2">
                <label for="name">Name</label>
                <input type="text" id="searchName" name="searchName" class="form-control">
            </div>
            <div class="col-sm-2">
                <label for="email">Email</label>
                <input type="text" name="searchEmail" id="searchEmail" class="form-control">
            </div>
            <div class="col-sm-3">
                <label for="user">User</label>
                @php
		        echo Form::select('user', Helpers::userList('',true,true), null, array('class' => 'form-control','id' => 'user'));
		        @endphp 
            </div>
            <div class="col-sm-3">
                <label for="type">User Type</label>
                @php
		        echo Form::select('userType', Helpers::userType('',true), null, array('class' => 'form-control','id' => 'userType'));
		        @endphp 
            </div>
            <div class="col-sm-1">
                <label for="">&nbsp; </label>
                <a class="btn btn-warning form-control" id='search'><i class='fa fa-search'></i></a>
            </div>
        </div>
    </div>
</div>

<div class="col-md-12">
    
    <div class="well">
        <div class='row'>
            @if ($message = Session::get('success'))
                <div class="alert alert-success alert-block">
                    <strong>{{ $message }}</strong>
                    <button style="margin-top:-25px;" type="button" class="close" data-dismiss="alert">×</button>
                </div>
            @endif
            <div class="col-sm-12">
                <div class="form-group">
                    <table id='dataTable' class="table table-bordered table-condensed table-primary">
                        <!-- Table heading -->
                        <thead>
                            <tr>
                                <th></th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Type</th>
                                {{-- <th>CreatedBy:</th> --}}
                                <th><a class="btn btn-primary" id="adddata"><i class="fa fa-plus"></i></a ></th>
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
	@component('components.panel')
        <h5>No available load.</h5>
    @endcomponent
</div>
    
    <script src="{{ asset ("js/jQuery-2.1.3.min.js") }}"></script>
    <script src="{{ asset('assets/components/modules/admin/tables/datatables/assets/lib/js/jquery.dataTables.min.js?v=v2.1.0') }}"></script>
    <script src="{{ asset('assets/components/modules/admin/tables/datatables/assets/lib/extras/TableTools/media/js/TableTools.min.js?v=v2.1.0') }}"></script>
    <script src="{{ asset('assets/components/modules/admin/tables/datatables/assets/lib/extras/ColVis/media/js/ColVis.min.js?v=v2.1.0') }}"></script>
    <script src="{{ asset('assets/components/modules/admin/tables/datatables/assets/custom/js/DT_bootstrap.js?v=v2.1.0') }}"></script>
    <script src="{{ asset('assets/components/modules/admin/forms/elements/fuelux-checkbox/fuelux-checkbox.js?v=v2.1.0') }}"></script>

    <script>
       
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

        var user = $("#dataTable").dataTable({
            "sPaginationType": "bootstrap",
            "sDom": "<'row separator bottom'<'col-md-9'><'col-md-3'l><'col-md-8'>r>t<'row'<'col-md-6'i><'col-md-6'>>",
            "oLanguage": {
                "sLengthMenu": "_MENU_ Show"
            },
            "fnInitComplete": function () {
                fnInitCompleteCallback(this);
            },
            "fnServerParams": function ( aoData ) {
                aoData.push( { "name": "name", "value": $("[name=searchName]").val() } );
                aoData.push( { "name": "email", "value": $("[name=searchEmail]").val() } );
                aoData.push( { "name": "user", "value": $("[name=user]").val() } );
                aoData.push( { "name": "userType", "value": $("[name=userType]").val() } );
            },
            "aoColumnDefs": [
            { 'sClass':'col-md-1', 'aTargets': [ 0 ] },
            { 'sClass':'col-md-2', 'aTargets': [ 4 ] },
            
            ],
            "aaSorting": [[0,'desc'],[1,'desc']],
            "bProcessing": true,
            "bServerSide": true,
            "bPaginate":true,
            // "bInfo" : false,
            "sAjaxSource": "{{ url('userDatatable') }}",
            "fnRowCallback": function( nRow, aData, iDisplayIndex, iDisplayIndexFull ) {
                $(nRow).find(".fa-eye").parent().unbind("click").on("click",function(){
                    alert("1");
                });
                $(nRow).find(".fa-edit").parent().unbind("click").on("click",function(){
                    alert("1");
                });
                $(nRow).find(".fa-trash").parent().unbind("click").on("click",function(){
                    alert("1");
                });
            }
        });

        $("#searchName , #searchEmail , #user , #userType").change(function(){
            user.fnDraw();

        });
        $("#adddata").unbind("click").bind("click",function(){
            // $.notyfy.closeAll();
            $("#modal-info").modal('show');
        });
    </script>
@endsection

