/**
 * Created by manytostao on 28/05/15.
 */
'use strict';

/*
 * show.bs.modal
 * shown.bs.modal
 * hide.bs.modal
 * hidden.bs.modal
 *
 * */
var users = function () {

    var $startDate;
    var $endDate;
    var _initDateRangePicker = function (startDate, endDate) {
        $startDate = startDate;
        $endDate = endDate;
        $('#register_date_range').daterangepicker({
                opens: (Metronic.isRTL() ? 'left' : 'right'),
                format: 'DD/MM/YYYY',
                separator: ' a ',
                startDate: startDate !== undefined && startDate !== '' ? startDate : moment().subtract('days', 29),
                endDate: endDate !== undefined && startDate !== '' ? endDate : moment(),
                minDate: '01/04/2014',
                locale: {
                    applyLabel: 'Aplicar',
                    cancelLabel: 'Cancelar',
                    fromLabel: 'Desde',
                    toLabel: 'Hasta',
                    weekLabel: 'Semana',
                    customRangeLabel: 'Rango propio',
                    daysOfWeek: moment.weekdaysMin(),
                    monthNames: moment.monthsShort(),
                    firstDay: moment.localeData()._week.dow
                }
            },
            function (start, end) {
                $('#register_date_range').find('input').val(start.format('DD/MM/YYYY') + ' - ' + end.format('DD/MM/YYYY'));
                $startDate = start.format('DD/MM/YYYY');
                $endDate = end.format('DD/MM/YYYY');
            }
        );
    };

    var _initFilter = function () {
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        $('#filter').on('click', function (e) {
            e.preventDefault();
            var form = {};
            form['first_name'] = $('#form_first_name').val();
            form['last_name'] = $('#form_last_name').val();
            form['email'] = $('#form_email').val();
            form['roles'] = $('#form_roles').val();
            form['from_register_date'] = $startDate !== undefined ? $startDate : '';
            form['to_register_date'] = $endDate !== undefined ? $endDate : '';
            //form['inactivo'] = $('#form_inactivo').is(":checked");
            form['_token'] = $('#form__token').val();
            $.ajax({
                url: laroute.route('users.filter'),
                type: 'POST',
                data: {_token: CSRF_TOKEN, form: form},
                success: function (data) {
                    $('#usersListDatatable').DataTable().ajax.reload();
                },
                error: function (data) {
                    alert(data);
                }
            });
        });
    };

    var _initRefreshFilter = function () {
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        $('.reload').on('click', function (e) {
            e.preventDefault();
            $.ajax({
                url: laroute.route('users.clean'),
                type: 'POST',
                data: {_token: CSRF_TOKEN},
                success: function (data) {
                    $('#form_first_name').val('');
                    $('#form_last_name').val('');
                    $('#form_email').val('');
                    $('#form_roles').val('');
                    $('#form_created_at').val('');
                    //$('#form_inactivo').prop("checked", false);
                    //$('#form_inactivo').parent().removeClass("checked");
                    $('#usersListDatatable').DataTable().search('').columns().search('');
                    $('#form_roles').select2({
                        placeholder: "Roles",
                        allowClear: true
                    });
                    _initDateRangePicker();
                    $('#usersListDatatable').DataTable().ajax.reload();
                }
            });
        });
    };

    return {
        initDateRangePicker: function () {
            _initDateRangePicker()
        },

        initFilter: function () {
            _initFilter()
        },

        initRefreshFilter: function () {
            _initRefreshFilter()
        }
    }
}();