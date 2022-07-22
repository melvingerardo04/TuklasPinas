(function ($, window) {
    var laravel_session = {
        //Logout Settings
        inactiveTimeout: 300000,    //(ms) The time until we display a warning 
        warningTimeout: 21000,      //(ms) The time until we log them out
        minWarning: 5000,           //(ms) If they come back to page (on mobile), The minumum amount, before we just log them out
        warningStart: null,         //Date time the warning was started
        warningTimer: null,         //Timer running every second to countdown to logout
        logout: function () {       //Logout function once warningTimeout has expired
            clearTimeout(laravel_session.warningTimer);
            $.ajax({
                url: $("#logout-form").attr("action"),
                type: "POST",
                success: function () {
                    window.location = window.location.href;
                },
                error: function () {
                    window.location = window.location.href;
                }
            });
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
        }else {
            //Show dialog, and note the time
            laravel_session.warningStart = (+new Date()) - diff;
            //Update counter downer every second
            laravel_session.warningTimer = setInterval(function () {
                // hold the count down if there is process 
                if (progress_on) {
                    clearTimeout(laravel_session.warningTimer);
                    $(document).idleTimer(laravel_session.inactiveTimeout);
                }

                var remaining = Math.round((laravel_session.warningTimeout / 1000) - (((+new Date()) - laravel_session.warningStart) / 1000));
                if (remaining > 0) {
                    let countdown = (laravel_session.warningTimeout / 1000) - 1
                    let countdown_timer;
                    clearInterval(countdown_timer)
                    if (!$('#session_timeout_modal').is(':visible')) {
                        $('#sessionSecondsRemaining').html(remaining)
                        $('#session_timeout_modal').modal('show').one('click', '[data-action=login]', function (e) {
                            e.preventDefault()
                            clearInterval(countdown_timer)
                            $('#session_timeout_modal').modal('hide')
                            location.reload()
                        }).one('click', '[data-action=logoff]', function (e) {
                            e.preventDefault()
                            clearInterval(countdown_timer)
                            laravel_session.logout();
                        })
                        countdown_timer = setInterval(() => {
                            $('#sessionSecondsRemaining').html(--countdown)
                            if (countdown == 0){
                                clearInterval(countdown_timer)
                                laravel_session.logout();
                            }
                        }, 1000);
                    }
                } else {
                    $('#sessionSecondsRemaining').html(0)
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