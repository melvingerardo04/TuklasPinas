<?php

namespace TuklasPinas\Http\Controllers\Admin;

use Illuminate\Http\Request;
use TuklasPinas\Http\Controllers\Controller;
use TuklasPinas\Admin\User;
use Helpers;
use DB;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::orderBy('id','asc')->get();
        return view('admin/users/index')->with('users',$users);
        // $users = User::orderBy('id','asc')->get();
        // return view('/admin/users/index')->with('users', $users);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    public function userDatatable(Request $request){
        $var = (object) $request->all();
        $columns = array(
            array( 'db' => 'id', 'dt' => 0,'orderable' => false, 'sortnum'=>true),
            array( 'db' => 'FullName', 'dt' => 1 ),
            array( 'db' => 'email', 'dt' => 2 ),
            array( 'db' => 'userType', 'dt' => 3 ),
            array( 'db' => 'id', 'dt' => 4,'formatter' => function($d,$mrow){
                return "<div class='btn-group btn-group-sm'>
                <a data-id='{$d}' class='btn btn-warning'><i class='fa fa-eye'></i></a>
                <a data-id='{$d}' class='btn btn-success'><i class='fa fa-edit'></i></a>
                <a data-id='{$d}' class='btn btn-danger'><i class='fa fa-trash'></i></a>
                </div>";
            },'orderable' => false)
        );
        # This is for extra condition
        $where = array();
    
        $result = array("aaData"=>array(),"sEcho"=>(int)$var->sEcho,"iTotalDisplayRecords"=>0,"iTotalRecords"=>0); 

        $rsql   = User::select("id",DB::raw('CONCAT(lastName,", ", firstName, " ", middleName) AS FullName'),"email","userType");

        if (!empty($var->name)) {
            $rsql = $rsql->where("lastName",$var->name);
            // $rsql = $rsql->where("firstName",$var->name);
            // $rsql = $rsql->where("middleName",$var->name);
        }
        if (!empty($var->email)) {
            $rsql = $rsql->where("email",$var->email);
        }
        if (!empty($var->userType)) {
            $rsql = $rsql->where("userType",$var->userType);
        }
        // dd($var->email);


        $likes = array(
            "lastName",
            "email",
            "userType"
        );  
        $params = array(
            "var" => $var,
            "columns" => $columns,
            "likes" => $likes,
            "sql" => $rsql
        );
        Helpers::process_dt_array($params);
    }
}
