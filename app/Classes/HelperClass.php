<?php
namespace TuklasPinas\Classes;
use TuklasPinas\Post;
use Illuminate\Support\Facades\Facade;

class HelperClass {


    public function process_dt_array($param, $return=false){
        ini_set('memory_limit', '2048M');
        
        $final_query = $param['sql'];
        $columns = $param['columns'];
        $likes = $param['likes'];
        $result['iTotalRecords'] = 0;

        $param['union'] = !empty($param['union']) ? $param['union'] : array() ;
        
        # echo '<pre>';var_dump($param['sql']);die;
        $counter = 0;



        if(isset($param['group'])&&$param['group']):
            $result["iTotalRecords"] = count($param['sql']->groupBy($param['group'])->distinct($param['group'])->get());
        elseif(isset($param['having'])&&$param['having']):
            $result["iTotalRecords"] = count($param['sql']->having($param['having'][0][0],$param['having'][0][1],$param['having'][0][2])->get());
        elseif(isset($param['distinct'])&&$param['distinct']):
            if(isset($param['union']) && $param['union']):
                if(count($param['union'])>0):
                    #$tmp_query = $final_query;
                    foreach($param['union'] as $unions):
                        $counter++;

                        $result["iTotalRecords"] += $unions->distinct($param['distinct'])->count();
                        if($counter!=1):
                            $final_query = $final_query->unionAll($unions);
                        endif;
                    endforeach;
                endif;
            else:
                $result["iTotalRecords"] = $param['sql']->distinct($param['distinct'])->count();
            endif;

        else:
            $result["iTotalRecords"] = $param['sql']->count();
        endif;

    
    
        /** Search fields here */
        $extrawhere = array();
        

        
        $sval = isset($param['var']->sSearch)?$param['var']->sSearch:"";
        #dd($sval);
        if($sval){
            
            
            $final_query = $final_query->where(function($q) use ($sval,$likes){
                foreach($likes as $tb){
                    #$q = $q->orWhere($tb,"LIKE","'%{$sval}%'");
                    $q = $q->orWhereRaw($tb." LIKE ?",'%'.$sval.'%');

                    
                }
            });


            if(count($param['union'])>0):
            
                $counter  = 0;
                $tmp_query = $param['union'][0]->where(function($q) use ($sval,$likes){
                    foreach($likes as $tb):
                        #$q = $q->orWhere($tb,"LIKE","'%{$sval}%'");
                    $q = $q->orWhereRaw($tb." LIKE ?",'%'.$sval.'%');

                        
                    endforeach;
                });
                $final_query = $tmp_query;
                foreach($param['union'] as $unions):
                    $counter++;
                #	$result["iTotalRecords"] += $unions->distinct($param['distinct'])->count();
            #  dd($);
                    if($counter!=1):
                        $unions = $unions->where(function($q) use ($sval,$likes){
                            foreach($likes as $tb):
                                $q = $q->orWhereRaw($tb." LIKE ?",'%'.$sval.'%');
                                #$q = $q->orWhere($tb,"LIKE","'%{$sval}%'");
                                
                            endforeach;
                        });
                        $final_query = $final_query->unionAll($unions);
                    endif;
                endforeach;
            endif;

        }

        
        /** Order fields here */
        $order = "";
        $orderBy = array();
        if($param['var']->iSortingCols > 0){
            foreach ($columns as $cval) {
                for($icol=0;$icol<$param['var']->iSortingCols;$icol++):
                    if($cval['dt'] == $param['var']->{"iSortCol_".$icol}){
                        if ( $param['var']->{"bSortable_" . $cval['dt']} == 'true' ) {
                            $dir = $param['var']->{"sSortDir_".$icol} === 'asc' ?
                                'ASC' :
                                'DESC';
                            $final_query = $final_query->orderBy($cval['db'],$dir);
                        }
                    }
                endfor;
            }
        }

        if( $param['var']->iDisplayLength > 0 ){
            $final_query = $final_query->skip(intval($param['var']->iDisplayStart))->take(intval($param['var']->iDisplayLength));
        }

        $result["iTotalDisplayRecords"] = $result["iTotalRecords"];
        #if($sval){
        #    dd(DB::connection('aims' . Auth::user()->school_id)->getQueryLog());
        #}

        if(isset($param['group'])&&$param['group']):
            $tmpgroup = is_array($param['group'])?$param['group']:[$param['group']];
            $final_query = call_user_func_array([$final_query,'groupBy'],$tmpgroup);
        endif; 
        // if(isset($param['group'])&&$param['group']) $final_query = $final_query->groupBy($param['group']);
        if(isset($param['having'])&&$param['having']):
            foreach ($param['having'] as $con):
                $final_query = call_user_func_array([$final_query,'having'],$con);
                // $final_query = $final_query->having($con[0],$con[1],$con[2]);
            endforeach;
        endif;
        if(isset($param['distinct'])&&$param['distinct']) $final_query->distinct();


        $result["aaData"] = array();
        $count = intval($param['var']->iDisplayStart?$param['var']->iDisplayStart:0);
        
        foreach ($final_query->get() as $finres){
            $count ++;
            $isAModel = is_a($finres,'Illuminate\Database\Eloquent\Model');
            $mrow = $isAModel ? $finres : (array) $finres;

            $tmpr = array();
            foreach ($columns as $cc=>$cval) {
                $val = $mrow[ $cval['db'] ];

                if(isset($cval['sortnum'])&&$cval['sortnum']){
                    $tmpr[] = $count;
                }else if ( isset( $cval['formatter'] ) ) {
                    $tmpr[] = $cval['formatter']( $val, $mrow);
                }else {
                    $tmpr[] = $val;
                }
            }
            $result["aaData"][] = $tmpr;
        }
        # dd(DB::connection('aims' . Auth::user()->school_id)->getQueryLog());
    #  echo "<pre>";
        if($return){
            return $result;
        }
        echo json_encode($result);
    }
    public function post($id){
        $post = Post::find($id);
        return $post;
    }

}