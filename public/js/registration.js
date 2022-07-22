function checknoconflict(data){
	var conflict=[];

		
	for (let key in subject_enrolled){
		var d = subject_enrolled[key];
		var i = key;

		$.each(d.Schedule,function(ii,dd){
			if(d.id != data.id){
				$.each(data.Schedule,function(iii,ddd){
					if(ddd.DayOfWeek==dd.DayOfWeek){
						if((_atime(ddd.StartTime,1)>_atime(dd.StartTime,0)&&_atime(ddd.StartTime,1)<_atime(dd.EndTime,0)) 
							|| (_atime(ddd.EndTime,0)>_atime(dd.StartTime,0)&&_atime(ddd.EndTime,0)<_atime(dd.EndTime,0))
							|| (_atime(dd.EndTime,0)>_atime(ddd.StartTime,0)&&_atime(dd.EndTime,0)<_atime(ddd.EndTime,0))
							){
							var stime 	= new Date(_atime(dd.StartTime,0));
							var stime_a = "AM";
							var stime_h = stime.getHours();
							if(stime.getHours()>12){
								stime_a = "PM";
								stime_h = stime.getHours()-12;
							}
								stime_h = addZero(stime_h);
							var stime_m = addZero(stime.getMinutes());

							var etime 	= new Date(_atime(dd.EndTime,0));
							var etime_a = "AM";
							var etime_h = etime.getHours();
							if(etime.getHours()>12){
								etime_a = "PM";
								etime_h = etime.getHours()-12;
							}
								etime_h = addZero(etime_h);
							var etime_m = addZero(etime.getMinutes());

							conflict.push(i + " [" + dd.DayOfWeek + " " + stime_h + ":" + stime_m + stime_a + " - " + etime_h + ":" + etime_m + etime_a + "]");
							return false;
						}
					}
				});
			}
		});
	}
	/*$.each(subject_enrolled,function(i,d){
				
		$.each(d.Schedule,function(ii,dd){
			$.each(data.Schedule,function(iii,ddd){
				if(ddd.DayOfWeek==dd.DayOfWeek){
					if((_atime(ddd.StartTime,1)>_atime(dd.StartTime,0)&&_atime(ddd.StartTime,1)<_atime(dd.EndTime,0)) 
						|| (_atime(ddd.EndTime,0)>_atime(dd.StartTime,0)&&_atime(ddd.EndTime,0)<_atime(dd.EndTime,0))
						|| (_atime(dd.EndTime,0)>_atime(ddd.StartTime,0)&&_atime(dd.EndTime,0)<_atime(ddd.EndTime,0))
						){
						var stime 	= new Date(_atime(dd.StartTime,0));
						var stime_a = "AM";
						var stime_h = stime.getHours();
						if(stime.getHours()>12){
							stime_a = "PM";
							stime_h = stime.getHours()-12;
						}
							stime_h = addZero(stime_h);
						var stime_m = addZero(stime.getMinutes());

						var etime 	= new Date(_atime(dd.EndTime,0));
						var etime_a = "AM";
						var etime_h = etime.getHours();
						if(etime.getHours()>12){
							etime_a = "PM";
							etime_h = etime.getHours()-12;
						}
							etime_h = addZero(etime_h);
						var etime_m = addZero(etime.getMinutes());

						conflict.push(i + " [" + dd.DayOfWeek + " " + stime_h + ":" + stime_m + stime_a + " - " + etime_h + ":" + etime_m + etime_a + "]");
						return false;
					}
				}
			});
		});
	});*/
	return conflict;
}
function checkprereq(data,obj){
	var ts = true;
	// check muna kung may prereq
	// check din kung may prereq pero enrolled na, once enrolled na, wala nang pop up, pero pag hindi pa enrolled, may popup
	if(global_prereq[data] && subject_enrolled[data]==undefined){
		var ts = false;
		bootbox.dialog({
			message : "This subject has a prerequisite.",
			buttons:{
				allow: {
		            label: (typeof isstudent=="undefined"?'Authenticate':'Ok'),
		            className: 'btn-success',
		            callback: function(a){
		            	if(typeof isstudent=="undefined"){
							userauthenticate('',1,function(){	
								obj.parent().parent().parent().parent().find("select:eq(0)").prop("disabled",false);
							},function(){
								obj.checkbox("uncheck");
								obj.parent().parent().parent().parent().find("select:eq(0)").val("").attr("disabled",true);
							});
						}else{
							obj.checkbox("uncheck");
							obj.parent().parent().parent().parent().find("select:eq(0)").val("").attr("disabled",true);
						}
						
					}
		        }
			},
			callback:function(){
				return false;
			},
			onEscape:function(a){
				obj.checkbox("uncheck");
				obj.parent().parent().parent().parent().find("select:eq(0)").val("").attr("disabled",true);
			}
		});
	}
	return ts;
}
function _atime(t,a){
	var d=new Date("2017-01-01 "+t);
	return (d.getTime() + (a*1000));
}
function addZero(i) {
    if (i < 10) {
        i = "0" + i;
    }
    return i;
}
function checkprereqPass(data,obj){
	var ts = true;
	// check muna kung may prereq
	if(global_prereq[data] && subject_enrolled[data]==undefined){
		if(global_prereq[data][1] == true){
			ts = false;
			userauthenticate('',1,function(){	
				obj.parent().parent().parent().parent().find("select:eq(0)").prop("disabled",false);
			},function(){
				obj.checkbox("uncheck");
				obj.parent().parent().parent().parent().find("select:eq(0)").val("").attr("disabled",true);
			});
		}
	}
	return ts;
}