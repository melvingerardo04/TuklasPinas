<!DOCTYPE html>
<html>
<head>
	<title> Pop Out Info</title>
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons"  rel="stylesheet">
    <link href="{{ asset("css/info.css")}}" rel="stylesheet" type="text/css" /> 
</head>
<body>
	<div class="container" onclick="expand()">
		<div class="toggle" id="toggle">
        <i class="material-icons" id="add"> <img src={{asset('storage/img/I.png')}} height="78px" >
            
            
			</i>
			</div>
		</div>


<div class="menu" id="menu">
	<div class="item">
		<a href="https://www.facebook.com/tuklas-pinas-109629840475794/?modal=admin_todo_tour" class="ey">
			<i class="material-icons"><img src={{asset('storage/img/star1.png')}} title="Facebook" height="35px"></i>
		</a>
	</div>
	<div class="item">
		<a href="#" class="ey">
		<i class="material-icons"><img src=""></i>
	</div>
	<div class="item">
		<a href="#" class="ey">
			<i class="material-icons"><img src="">  </i>
		</a>
	</div>
	<div class="item">
		<a href="#">
			<i class="material-icons"><img src=""></i>
		</a>
	</div>
	<div class="item">
		<a href="#" class="ey">
		<i class="material-icons"><img src={{asset('storage/img/star2.png')}} title="Instagram" height="55px"></i>
		</a>
	</div>
	<div class="item">
		<a href="https://www.twitter.com/PinasTuklas/" class="ey">
			<i class="material-icons"><!--<img src="notification.ico" id="notification">--> <img src={{asset('storage/img/star3.png')}} title="Twitter" height="33px"></i>
		</a>
	</div>
</div>
<script src="{{ asset ("js/info.js") }}" type="text/javascript"></script>
</body>
</html>
<!--
i[1].style.transform='translateY(-50px)';
				i[9].style.transform='translateY(-95px)';
				i[11].style.transform='translateY(-140px)';-->