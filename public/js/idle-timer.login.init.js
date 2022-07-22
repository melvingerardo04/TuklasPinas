(function($, window)
{
	var laravel_session = {
            //Logout Settings
            inactiveTimeout: 60000,     //(ms) The time until we display a warning message
            //inactiveTimeout: 11000,     //(ms) The time until we display a warning message
            warningTimeout: 10000,      //(ms) The time until we log them out
            minWarning: 5000,           //(ms) If they come back to page (on mobile), The minumum amount, before we just log them out
            warningStart: null,         //Date time the warning was started
            warningTimer: null,         //Timer running every second to countdown to logout
            logout: function () {       //Logout function once warningTimeout has expired
            	$(document).idleTimer('destroy');
                window.location = window.location.href;
            },
            //Keepalive Settings
            keepaliveTimer: null,
            keepaliveUrl: "",
            keepaliveInterval: 5000,     //(ms) the interval to call said url
            keepAlive: function () {
                $(document).idleTimer(laravel_session.inactiveTimeout);
            }
        };

    $(document).on("idle.idleTimer", function (event, elem, obj) {
	    //Get time when user was last active
	    var
	        diff = (+new Date()) - obj.lastActive - obj.timeout,
	        warning = (+new Date()) - diff
	    ; 
	    
	    //On mobile js is paused, so see if this was triggered while we were sleeping
	    if (diff >= laravel_session.warningTimeout || warning <= laravel_session.minWarning) {
	        //$("#logout-form").submit();
	        console.log(warning);
	    } else {
	        //Show dialog, and note the time
	        //console.log(Math.round((laravel_session.warningTimeout - diff) / 1000));
	        //$('#sessionSecondsRemaining').html(Math.round((laravel_session.warningTimeout - diff) / 1000));
	        //$("#myModal").modal("show");
	        laravel_session.warningStart = (+new Date()) - diff;
	        //Update counter downer every second
	        laravel_session.warningTimer = setInterval(function () {

	            var remaining = Math.round((laravel_session.warningTimeout / 1000) - (((+new Date()) - laravel_session.warningStart) / 1000));
	            if (remaining > 0) {
	            	console.log(remaining);
	                //$('#sessionSecondsRemaining').html(remaining);
	            } else {
	                laravel_session.logout();
	            }
	        }, 1000)
	    }
	});
	 $(document).on("active.idleTimer", function () {
        clearTimeout(laravel_session.warningTimer);
    });

	$(document).idleTimer(laravel_session.inactiveTimeout);

})(jQuery, window);	 