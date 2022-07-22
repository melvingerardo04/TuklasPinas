/** usage: doSequentially('identifier',response.data,{ type: 'post', url: url , data: data }); */
function doSequentially(key,sequence,ajax_settings,i){
    if (typeof window._sequence == "undefined") {
        window._sequence = [];
    } if (typeof window._sequence_queque == "undefined") {
        window._sequence_queque = [];
    } if (typeof window._sequence_last == "undefined") {
        window._sequence_last = {};
    }

    if(typeof i == "undefined"){
        window._sequence_queque.push(key);
        window._sequence.push(key);

        $(window).on(key+':sequence:pause',function(){
            window._sequence_queque.splice(window._sequence_queque.indexOf(key),1);
        });
        $(window).on(key+':sequence:continue',function(){
            // window._sequence_queque.push(key);
            doSequentially(key,sequence,ajax_settings,window._sequence_last[key]);
        });
        $(window).on(key+':sequence:stop',function(){
            window._sequence_queque.splice(window._sequence_queque.indexOf(key),1);
            window._sequence.splice(window._sequence.indexOf(key),1);
            delete _sequence_last[key];
        });
    }
    if(i > 0 && window._sequence_queque.indexOf(key) === -1){
        return;
    }
    if (window._sequence.indexOf(key) !== -1){
        i = i||0;
        if(i==0){
            $(window).trigger(key + ':sequence:start');
        }
        var data = sequence[i];
        window._sequence_last[key] = i;
        ajax_settings.data[key] = data;
        var ajax = $.ajax(ajax_settings);
        if(data){
            var e_data = { progress: ((i+1)/sequence.length) };
            e_data[key] = data;
            if(typeof sequence[i+1] !== "undefined"){
                ajax.then(function (response) {
                    e_data.response = response;
                    $(window).trigger($.Event(key+':sequence',e_data));
                    doSequentially(key, sequence, ajax_settings, i + 1);
                }).fail(function (request) {
                    e_data.request = request;
                    $(window).trigger($.Event(key+':sequence',e_data));
                    doSequentially(key, sequence, ajax_settings, i + 1);
                });
            }
            else{
                    ajax.then(function(response){
                        e_data.response = response;
                        $(window).trigger($.Event(key+':sequence',e_data));
                        $(window).trigger(key+':sequence:stop');
                    }).fail(function (request) {
                        e_data.request = request;
                        $(window).trigger($.Event(key + ':sequence', e_data));
                        $(window).trigger(key + ':sequence:stop');
                    });
            }
        }
    }
}