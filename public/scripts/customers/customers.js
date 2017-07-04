/**
 * Created by osmany.torres on 27/08/15.
 */

var customers = function () {
    var _initExcel = function () {
        $('#excel').on('click', function (e) {
            e.preventDefault();
            var origColumns = ['id',
                'name',
                'last_name',
                'id_card',
                'phone',
                'email',
                'customer_type',
                'professional_type',
                'institution',
                'library_card',
                'specialty',
                'profession',
                'dedication',
                'occupational_category',
                'scientific_category',
                'investigative_category',
                'teaching_category',
                'country',
                'position',
                'topic',
                'comments',
                'attended_by',
                'active',
                'student',
                'created_at'
            ];
            var inputs = $('#usersListDatatable_column_toggler').find('input');
            var table = $('#usersListDatatable').DataTable();
            var info = table.page.info();
            var order = table.order();
            var start = info.start;
            var end = info.end;
            var length = info.length;
            var columns = [];
            for (var i = 0; i <= inputs.length; i++)
                if ($(inputs[i]).is(':checked'))
                    columns.push($(inputs[i]).data('field'));
            $('#start').val(start);
            $('#end').val(end);
            $('#length').val(length);
            $('#columns').val(origColumns);
            $('#visColumns').val(columns);
            $('#order').val(order);
            $('#excelExport').submit();
        });
    };

    var _select2Initialization = function (element_id, placeholder, nomenclator_type_id, route, defaultValue, extra_field, minimum_input_length) {
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        var $page = 0;
        var select = $(element_id).select2({
            allowClear: true,
            minimum_input_length: minimum_input_length,
            quietMillis: 7200,
            placeholder: placeholder,
            class_name: 'form-control',
            ajax: {
                delay: 7200,
                dataType: 'json',
                url: route,
                type: 'POST',
                data: function (term, page) { // page is the one-based page number tracked by Select2
                    $page = page;
                    return {
                        _token: CSRF_TOKEN,
                        q: {
                            nomenclator_type_id: nomenclator_type_id,
                            description: term,
                            page: page,
                            pageCount: 10,
                            extra_field: extra_field
                        }, //search term
                        page: page // page number
                    };
                },
                results: function (data, page) {
                    var more = (page * 10) < data.total_count; // whether or not there are more results available
                    $page = page;
                    // notice we return the value of more so Select2 knows if more results can be loaded
                    return {results: data.items, more: more};
                },
                escapeMarkup: function (m) {
                    return m;
                }
            },
            initSelection: function (element, callback) {
                // the input tag has a value attribute preloaded that points to a preselected repository's id
                // this function resolves that id attribute to an object that select2 can render
                // using its formatResult renderer - that way the repository name is shown preselected
                var id = $(element).val();
                if (id !== "") {
                    $.ajax({
                        url: route,
                        dataType: 'json',
                        type: 'POST',
                        data: {
                            _token: CSRF_TOKEN,
                            q: {
                                nomenclator_type_id: nomenclator_type_id,
                                id: id,
                                page: $page,
                                pageCount: 10,
                                extra_field: extra_field
                            }, //search term
                            page: $page // page number,
                        }
                    }).done(function (data) {
                        callback(data.items[0]);
                    });
                }
            }
        });
        if (defaultValue == '')
            defaultValue = select.val();
        select.val(defaultValue).trigger('change');
    };

    var _initSpecificSelects = function (show_placeholder, extra_field) {
        /*form_professional_type y form_profession se inicializan en la función
         * switchSelectsByCheck porque tienen un comportamiento diferente
         * al resto de select2 y dicha función se llama tambien en el
         * OnLoad del documento HTML*/
        _select2Initialization("#form_country", show_placeholder == true ? "País" : ' ', 12, laroute.route('nomenclators.json'), '', extra_field != undefined ? extra_field : true);
        _select2Initialization("#form_position", show_placeholder == true ? "position" : ' ', 4, laroute.route('nomenclators.json'), '', extra_field != undefined ? extra_field : true);
        _select2Initialization("#form_dedication", show_placeholder == true ? "Dedicación" : ' ', 6, laroute.route('nomenclators.json'), '', extra_field != undefined ? extra_field : true);
        _select2Initialization("#form_specialty", show_placeholder == true ? "specialty" : ' ', 2, laroute.route('nomenclators.json'), '', extra_field != undefined ? extra_field : true);
        _select2Initialization("#form_scientific_category", show_placeholder == true ? "Categoría Científica" : ' ', 10, laroute.route('nomenclators.json'), '', extra_field != undefined ? extra_field : true);
        _select2Initialization("#form_teaching_category", show_placeholder == true ? "Categoría Docente" : ' ', 7, laroute.route('nomenclators.json'), '', extra_field != undefined ? extra_field : true);
        _select2Initialization("#form_investigative_category", show_placeholder == true ? "Categoría Investigativa" : ' ', 9, laroute.route('nomenclators.json'), '', extra_field != undefined ? extra_field : true);
        _select2Initialization("#form_occupational_category", show_placeholder == true ? "Categoría Ocupacional" : ' ', 8, laroute.route('nomenclators.json'), '', extra_field != undefined ? extra_field : true);
        _select2Initialization("#form_customer_type", show_placeholder == true ? "Tipo de Usuario" : ' ', 11, laroute.route('nomenclators.json'), '', extra_field != undefined ? extra_field : true);
        _select2Initialization("#form_institution", show_placeholder == true ? "Institución" : ' ', 5, laroute.route('nomenclators.json'), '', extra_field != undefined ? extra_field : true);
        _select2Initialization("#form_professional_type", show_placeholder == true ? "Tipo de professional" : ' ', 1, laroute.route('nomenclators.json'), '', extra_field != undefined ? extra_field : true);
        _select2Initialization("#form_profession", show_placeholder == true ? "Profesión" : ' ', 3, laroute.route('nomenclators.json'), '', extra_field != undefined ? extra_field : true);
        _select2Initialization("#form_attended_by", show_placeholder == true ? "Atendido por" : ' ', null, laroute.route('users.json'), '', extra_field != undefined ? extra_field : true);
    };

    var _initDetailsSpecificSelects = function () {
        $("#form_servicio").select2({
            allowClear: true,
            class_name: 'form-control'
        });
        $("#form_pc").select2({
            allowClear: true,
            class_name: 'form-control'
        });
        $("#form_fuentesInfo").select2({
            allowClear: true,
            class_name: 'form-control'
        });
    };

    var _switchSelectsByCheck = function () {
        if ($('#form_student').is(':checked')) {
            $("#form_professional_type").attr("placeholder", "Carrera en salud");
            _select2Initialization("#form_professional_type", "Carrera en salud", 1, laroute.route('nomenclators.json'), '', true);
            $("#form_profession").attr("placeholder", "Carrera fuera de salud");
            _select2Initialization("#form_profession", "Carrera fuera de salud", 3, laroute.route('nomenclators.json'), '', true);
            $('.non-student').hide();
        } else {
            $("#form_professional_type").attr("placeholder", "Tipo de professional");
            _select2Initialization("#form_professional_type", "Tipo de professional", 1, laroute.route('nomenclators.json'), '', true);
            $("#form_profession").attr("placeholder", "Profesión");
            _select2Initialization("#form_profession", "Profesión", 3, laroute.route('nomenclators.json'), '', true);
            $('.non-student').show();
        }
    };

    var _switchEditSelectsByCheck = function () {
        if (document.getElementById("form_student").checked) {
            _select2Initialization("#form_professional_type", "Carrera en salud...", 1, laroute.route('nomenclators.json'), '', true);
            _select2Initialization("#form_profession", "Carrera fuera de salud...", 3, laroute.route('nomenclators.json'), '', true);
            document.getElementById("specialty").style = "display : none";
            document.getElementById("position").style = "display : none";
            document.getElementById("dedication").style = "display : none";
            document.getElementById("experiencia").style = "display : none";
            $("#professional_type").text("Carrera en Salud");
            $("#profession").text("Carrera fuera de Salud");
        } else {
            _select2Initialization("#form_professional_type", "Tipo de professional...", 1, laroute.route('nomenclators.json'), '', true);
            _select2Initialization("#form_profession", "Profesión...", 3, laroute.route('nomenclators.json'), '', true);
            document.getElementById("specialty").style = "";
            document.getElementById("position").style = "";
            document.getElementById("dedication").style = "";
            document.getElementById("experiencia").style = "";
            $("#professional_type").text("Tipo de professional");
            $("#profession").text("Profesión");
        }
    };

    var _noCIConfirm = function () {
        if ($('#form_id_card').val() == '')
            $('#save').modal();
        else
            document.forms[0].submit();
    };

    var _refreshTable = function (tableId, urlData) {
        $.getJSON(urlData, null, function (json) {
            table = $(tableId).dataTable();
            oSettings = table.fnSettings();

            table.fnClearTable(this);

            for (var i = 0; i < json.data.length; i++) {
                table.oApi._fnAddData(oSettings, json.data[i]);
            }

            oSettings.aiDisplay = oSettings.aiDisplayMaster.slice();
            table.fnDraw();
        });
    };

    var _initBanButton = function (id, route) {
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        $('#ban').on('click', function (e) {
            e.preventDefault();
            $.ajax({
                url: laroute.route('customers.ban'),
                type: 'POST',
                data: {_token: CSRF_TOKEN, id: id, route: route},
                success: function (data) {
                    var info = $('<div class="alert alert-info alert-dismissable"><button aria-hidden="true" data-dismiss="alert" class="close" type="button"></button>' + data['message'] + '</div>');
                    $('#info').append(info);
                    if (data['value'] == true) {
                        $('#ban').html('<i class="fa fa-check"></i> Permitir');
                    }
                    else {
                        $('#ban').html('<i class="fa fa-ban"></i> Restringir');
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
                    if (data['value'] === true) {
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

    var _initFilter = function () {
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        $('#filter').on('click', function (e) {
            e.preventDefault();
            var form = {};
            form['name'] = $('#form_name').val();
            form['last_name'] = $('#form_last_name').val();
            form['id_card'] = $('#form_id_card').val();
            form['phone'] = $('#form_phone').val();
            form['email'] = $('#form_email').val();
            form['topic'] = $('#form_topic').val();
            form['country'] = $('#form_country').val();
            form['professional_type'] = $('#form_professional_type').val();
            form['profession'] = $('#form_profession').val();
            form['position'] = $('#form_position').val();
            form['dedication'] = $('#form_dedication').val();
            form['scientific_category'] = $('#form_scientific_category').val();
            form['teaching_category'] = $('#form_teaching_category').val();
            form['investigative_category'] = $('#form_investigative_category').val();
            form['occupational_category'] = $('#form_occupational_category').val();
            form['attended_by'] = $('#form_attended_by').val();
            form['experience'] = $('#form_experience').val();
            form['customer_type'] = $('#form_customer_type').val();
            form['specialty'] = $('#form_specialty').val();
            form['institution'] = $('#form_institution').val();
            form['comments'] = $('#form_comments').val();
            form['from_inscription_date'] = $startDate != undefined ? $startDate : '';//$('#form_created_at').val() != '' ? $('.daterangepicker_start_input input').val() : '';
            form['to_inscription_date'] = $endDate != undefined ? $endDate : '';//$('#form_created_at').val() != '' ? $('.daterangepicker_end_input input').val() : '';
            form['tipo_form'] = $('#form_tipo_form').val();
            form['student'] = $('#form_student').is(":checked");
            form['inactive'] = $('#form_inactive').is(":checked");
            form['currently_in'] = $('#form_currently_in').is(":checked");
            form['currently_in_internet_browsing_service'] = $('#form_currently_in_internet_browsing_service').is(":checked");
            form['currently_in_reading_service'] = $('#form_currently_in_reading_service').is(":checked");
            form['banned'] = $('#form_banned').is(":checked");
            form['id'] = $('#form_id').val();
            form['module'] = $('#form_module').val();
            form['_token'] = $('#form__token').val();
            $.ajax({
                url: laroute.route('customers.filter'),
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
                url: laroute.route('customers.clean'),
                type: 'POST',
                data: {_token: CSRF_TOKEN},
                success: function (data) {
                    $('#form_name').val('');
                    $('#form_last_name').val('');
                    $('#form_id_card').val('');
                    $('#form_email').val('');
                    $('#form_topic').val('');
                    $('#form_comments').val('');
                    $('#form_phone').val('');
                    $('#form_country').val('');
                    $('#form_professional_type').val('');
                    $('#form_institution').val('');
                    $('#form_profession').val('');
                    $('#form_position').val('');
                    $('#form_dedication').val('');
                    $('#form_scientific_category').val('');
                    $('#form_teaching_category').val('');
                    $('#form_investigative_category').val('');
                    $('#form_occupational_category').val('');
                    $('#form_attended_by').val('');
                    $('#form_experiencia').val('');
                    $('#form_customer_type').val('');
                    $('#form_specialty').val('');
                    $('#form_created_at').val('');
                    $('#form_tipoForm').val('');
                    $('#form_id').val('');
                    $('#form_created_at').val('');
                    $('#form_student').prop("checked", false);
                    $('#form_student').parent().removeClass("checked");
                    $('#form_inactive').prop("checked", false);
                    $('#form_inactive').parent().removeClass("checked");
                    $('#form_currently_in').prop("checked", false);
                    $('#form_currently_in').parent().removeClass("checked");
                    $('#form_currently_in_internet_browsing_service').prop("checked", false);
                    $('#form_currently_in_internet_browsing_service').parent().removeClass("checked");
                    $('#form_currently_in_reading_service').prop("checked", false);
                    $('#form_currently_in_reading_service').parent().removeClass("checked");
                    $('#form_banned').prop("checked", false);
                    $('#form_banned').parent().removeClass("checked");
                    $('#usersListDatatable').DataTable().search('').columns().search('');
                    _initSpecificSelects();
                    _switchSelectsByCheck();
                    _initDateRangePicker();
                    $('#usersListDatatable').DataTable().ajax.reload();
                }
            });
        });
    };

    var _initLastNumberSuggestionButton = function () {
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        $('#number_suggestion').on('click', function (e) {
            var customer_type = $('#form_customer_type').val();
            if (customer_type === '') {
                var info =
                    $('<div class="alert alert-danger alert-dismissable"><button aria-hidden="true" data-dismiss="alert" class="close" type="button"></button> Verifique que ha escogido un tipo de usuario.</div>');
                $('#info').append(info);
            }
            else {
                e.preventDefault();
                $.ajax({
                    url: laroute.route('customers.library_card'),
                    type: 'POST',
                    data: {_token: CSRF_TOKEN, customer_type: customer_type},
                    success: function (data) {
                        $('#form_library_card').val(data);
                    },
                    error: function (data) {
                        var info =
                            $('<div class="alert alert-danger alert-dismissable"><button aria-hidden="true" data-dismiss="alert" class="close" type="button"></button> Ha ocurrido un error inesperado. Verifique que ha escogido un tipo de usuario.</div>');
                        $('#info').append(info);
                    }
                });
            }
        });
    };

    var $startDate;
    var $endDate;
    var _initDateRangePicker = function (startDate, endDate) {
        $startDate = startDate;
        $endDate = endDate;
        $('#created_at_range').daterangepicker({
                opens: (Metronic.isRTL() ? 'left' : 'right'),
                format: 'DD/MM/YYYY',
                separator: ' a ',
                startDate: startDate != undefined && startDate != '' ? startDate : moment().subtract('days', 29),
                endDate: endDate != undefined && startDate != '' ? endDate : moment(),
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
                    firstDay: moment.localeData()._week.dow,
                }
            },
            function (start, end) {
                $('#created_at_range input').val(start.format('DD/MM/YYYY') + ' - ' + end.format('DD/MM/YYYY'));
                $startDate = start.format('DD/MM/YYYY');
                $endDate = end.format('DD/MM/YYYY');
            }
        );
    };

    return {
        initExcel: function () {
            _initExcel()
        },

        initSpecificSelects: function (show_placeholder, extra_field) {
            _initSpecificSelects(show_placeholder, extra_field)
        },

        initDetailsSpecificSelects: function () {
            _initDetailsSpecificSelects()
        },

        switchSelectsByCheck: function () {
            _switchSelectsByCheck()
        },

        switchEditSelectsByCheck: function () {
            _switchEditSelectsByCheck()
        },

        noCIConfirm: function () {
            _noCIConfirm()
        },

        initFilter: function () {
            _initFilter()
        },

        initBanButton: function (id, route) {
            _initBanButton(id, route)
        },

        initActivateButton: function (id, route) {
            _initActivateButton(id, route)
        },

        initRefreshFilter: function () {
            _initRefreshFilter()
        },

        initDateRangePicker: function (startDate, endDate) {
            _initDateRangePicker(startDate, endDate)
        },

        select2Initialization: function (element_id, placeholder, nomenclator_type_id, route, defaultValue, extra_field, minimum_input_length) {
            _select2Initialization(element_id, placeholder, nomenclator_type_id, route, defaultValue, extra_field, minimum_input_length);
        },

        initLastNumberSuggestion: function () {
            _initLastNumberSuggestionButton();
        }
    }
}();