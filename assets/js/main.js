
function ajax(url, type, data, callback, beforeSend) {

    type = type ? type : "HTML";
    beforeSend = beforeSend ? beforeSend : function () {
        return false;
    };

    $.ajax({
        url: url,
        type: "POST",
        dataType: type,
        data: (data),
        beforeSend: function () {
            beforeSend();
        },
        success: function (response) {
            callback(response);
        }
    });

}