/**
 * Created by osmany.torres on 27/08/15.
 */

var customers = function () {
    var _initActivateButton = function (id, route) {
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        $('#activate').on('click', function (e) {
            e.preventDefault();
            $.ajax({
                url: laroute.route('customers.activate'),
                type: 'POST',
                data: {_token: CSRF_TOKEN, id: id, route: route},
                success: function (data) {
                    var info = $('<div class="alert alert-info alert-dismissable"><button aria-hidden="true" data-dismiss="alert" class="close" type="button"></button>' + data['message'] + '</div>');
                    $('#info').append(info);
                    if (data['value'] == true) {
                        $('#activate').html('<i class="fa fa-ban"></i> Inactivar');
                    }
                    else {
                        $('#activate').html('<i class="fa fa-check"></i> Activar');
                    }
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    var info =
                        $('<div class="alert alert-danger alert-dismissable"><button aria-hidden="true" data-dismiss="alert" class="close" type="button"></button> Ha ocurrido un error inesperado: '
                            + errorThrown + '.</div>');
                    $('#info').append(info);
                }
            });
        });
    };

    return {
        initActivateButton: function (id, route) {
            _initActivateButton(id, route)
        }
    }
}();