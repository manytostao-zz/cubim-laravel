(function () {

    var laroute = (function () {

        var routes = {

            absolute: false,
            rootUrl: 'http://localhost',
            routes : [{"host":null,"methods":["GET","HEAD"],"uri":"\/","name":"home","action":"CUBiM\Http\Controllers\MainController@home"},{"host":null,"methods":["GET","HEAD"],"uri":"503","name":"error.503","action":"Closure"},{"host":null,"methods":["POST"],"uri":"customers\/datatable","name":"customers.datatable","action":"CUBiM\Http\Controllers\CustomerController@datatable"},{"host":null,"methods":["POST"],"uri":"customers\/filter","name":"customers.filter","action":"CUBiM\Http\Controllers\CustomerController@filter"},{"host":null,"methods":["POST"],"uri":"customers\/clean","name":"customers.clean","action":"CUBiM\Http\Controllers\CustomerController@clean"},{"host":null,"methods":["POST"],"uri":"customers\/ban","name":"customers.ban","action":"CUBiM\Http\Controllers\CustomerController@ban"},{"host":null,"methods":["POST"],"uri":"customers\/activate","name":"customers.activate","action":"CUBiM\Http\Controllers\CustomerController@activate"},{"host":null,"methods":["POST"],"uri":"customers\/library_card","name":"customers.library_card","action":"CUBiM\Http\Controllers\CustomerController@library_card"},{"host":null,"methods":["GET","HEAD"],"uri":"customers","name":"customers.index","action":"CUBiM\Http\Controllers\CustomerController@index"},{"host":null,"methods":["GET","HEAD"],"uri":"customers\/create","name":"customers.create","action":"CUBiM\Http\Controllers\CustomerController@create"},{"host":null,"methods":["POST"],"uri":"customers","name":"customers.store","action":"CUBiM\Http\Controllers\CustomerController@store"},{"host":null,"methods":["GET","HEAD"],"uri":"customers\/{customers}","name":"customers.show","action":"CUBiM\Http\Controllers\CustomerController@show"},{"host":null,"methods":["GET","HEAD"],"uri":"customers\/{customers}\/edit","name":"customers.edit","action":"CUBiM\Http\Controllers\CustomerController@edit"},{"host":null,"methods":["PUT"],"uri":"customers\/{customers}","name":"customers.update","action":"CUBiM\Http\Controllers\CustomerController@update"},{"host":null,"methods":["PATCH"],"uri":"customers\/{customers}","name":null,"action":"CUBiM\Http\Controllers\CustomerController@update"},{"host":null,"methods":["DELETE"],"uri":"customers\/{customers}","name":"customers.destroy","action":"CUBiM\Http\Controllers\CustomerController@destroy"},{"host":null,"methods":["POST"],"uri":"nomenclators\/json","name":"nomenclators.json","action":"CUBiM\Http\Controllers\NomenclatorController@json"},{"host":null,"methods":["POST"],"uri":"nomenclators\/datatable","name":"nomenclators.datatable","action":"CUBiM\Http\Controllers\NomenclatorController@datatable"},{"host":null,"methods":["GET","HEAD"],"uri":"nomenclators","name":"nomenclators.index","action":"CUBiM\Http\Controllers\NomenclatorController@index"},{"host":null,"methods":["GET","HEAD"],"uri":"nomenclators\/create","name":"nomenclators.create","action":"CUBiM\Http\Controllers\NomenclatorController@create"},{"host":null,"methods":["POST"],"uri":"nomenclators","name":"nomenclators.store","action":"CUBiM\Http\Controllers\NomenclatorController@store"},{"host":null,"methods":["GET","HEAD"],"uri":"nomenclators\/{nomenclators}","name":"nomenclators.show","action":"CUBiM\Http\Controllers\NomenclatorController@show"},{"host":null,"methods":["GET","HEAD"],"uri":"nomenclators\/{nomenclators}\/edit","name":"nomenclators.edit","action":"CUBiM\Http\Controllers\NomenclatorController@edit"},{"host":null,"methods":["PUT"],"uri":"nomenclators\/{nomenclators}","name":"nomenclators.update","action":"CUBiM\Http\Controllers\NomenclatorController@update"},{"host":null,"methods":["PATCH"],"uri":"nomenclators\/{nomenclators}","name":null,"action":"CUBiM\Http\Controllers\NomenclatorController@update"},{"host":null,"methods":["DELETE"],"uri":"nomenclators\/{nomenclators}","name":"nomenclators.destroy","action":"CUBiM\Http\Controllers\NomenclatorController@destroy"},{"host":null,"methods":["GET","HEAD"],"uri":"nomenclators\/type\/{nomenclator_type_id}","name":"nomenclators.index","action":"CUBiM\Http\Controllers\NomenclatorController@index"},{"host":null,"methods":["POST"],"uri":"users\/json","name":"users.json","action":"CUBiM\Http\Controllers\UserController@json"},{"host":null,"methods":["POST"],"uri":"users\/datatable","name":"users.datatable","action":"CUBiM\Http\Controllers\UserController@datatable"},{"host":null,"methods":["POST"],"uri":"users\/filter","name":"users.filter","action":"CUBiM\Http\Controllers\UserController@filter"},{"host":null,"methods":["POST"],"uri":"users\/clean","name":"users.clean","action":"CUBiM\Http\Controllers\UserController@clean"},{"host":null,"methods":["GET","HEAD"],"uri":"users","name":"users.index","action":"CUBiM\Http\Controllers\UserController@index"},{"host":null,"methods":["GET","HEAD"],"uri":"users\/create","name":"users.create","action":"CUBiM\Http\Controllers\UserController@create"},{"host":null,"methods":["POST"],"uri":"users","name":"users.store","action":"CUBiM\Http\Controllers\UserController@store"},{"host":null,"methods":["GET","HEAD"],"uri":"users\/{users}","name":"users.show","action":"CUBiM\Http\Controllers\UserController@show"},{"host":null,"methods":["GET","HEAD"],"uri":"users\/{users}\/edit","name":"users.edit","action":"CUBiM\Http\Controllers\UserController@edit"},{"host":null,"methods":["PUT"],"uri":"users\/{users}","name":"users.update","action":"CUBiM\Http\Controllers\UserController@update"},{"host":null,"methods":["PATCH"],"uri":"users\/{users}","name":null,"action":"CUBiM\Http\Controllers\UserController@update"},{"host":null,"methods":["DELETE"],"uri":"users\/{users}","name":"users.destroy","action":"CUBiM\Http\Controllers\UserController@destroy"},{"host":null,"methods":["POST"],"uri":"traces\/datatable","name":"traces.datatable","action":"CUBiM\Http\Controllers\TraceController@datatable"},{"host":null,"methods":["POST"],"uri":"traces\/filter","name":"traces.filter","action":"CUBiM\Http\Controllers\TracesController@filter"},{"host":null,"methods":["GET","HEAD"],"uri":"login","name":"auth.login","action":"CUBiM\Http\Controllers\Auth\AuthController@getLogin"},{"host":null,"methods":["POST"],"uri":"login","name":"auth.login","action":"CUBiM\Http\Controllers\Auth\AuthController@postLogin"},{"host":null,"methods":["GET","HEAD"],"uri":"logout","name":"auth.logout","action":"CUBiM\Http\Controllers\Auth\AuthController@getLogout"}],
            prefix: '',

            route : function (name, parameters, route) {
                route = route || this.getByName(name);

                if ( ! route ) {
                    return undefined;
                }

                return this.toRoute(route, parameters);
            },

            url: function (url, parameters) {
                parameters = parameters || [];

                var uri = url + '/' + parameters.join('/');

                return this.getCorrectUrl(uri);
            },

            toRoute : function (route, parameters) {
                var uri = this.replaceNamedParameters(route.uri, parameters);
                var qs  = this.getRouteQueryString(parameters);

                return this.getCorrectUrl(uri + qs);
            },

            replaceNamedParameters : function (uri, parameters) {
                uri = uri.replace(/\{(.*?)\??\}/g, function(match, key) {
                    if (parameters.hasOwnProperty(key)) {
                        var value = parameters[key];
                        delete parameters[key];
                        return value;
                    } else {
                        return match;
                    }
                });

                // Strip out any optional parameters that were not given
                uri = uri.replace(/\/\{.*?\?\}/g, '');

                return uri;
            },

            getRouteQueryString : function (parameters) {
                var qs = [];
                for (var key in parameters) {
                    if (parameters.hasOwnProperty(key)) {
                        qs.push(key + '=' + parameters[key]);
                    }
                }

                if (qs.length < 1) {
                    return '';
                }

                return '?' + qs.join('&');
            },

            getByName : function (name) {
                for (var key in this.routes) {
                    if (this.routes.hasOwnProperty(key) && this.routes[key].name === name) {
                        return this.routes[key];
                    }
                }
            },

            getByAction : function(action) {
                for (var key in this.routes) {
                    if (this.routes.hasOwnProperty(key) && this.routes[key].action === action) {
                        return this.routes[key];
                    }
                }
            },

            getCorrectUrl: function (uri) {
                var url = this.prefix + '/' + uri.replace(/^\/?/, '');

                if(!this.absolute)
                    return url;

                return this.rootUrl.replace('/\/?$/', '') + url;
            }
        };

        var getLinkAttributes = function(attributes) {
            if ( ! attributes) {
                return '';
            }

            var attrs = [];
            for (var key in attributes) {
                if (attributes.hasOwnProperty(key)) {
                    attrs.push(key + '="' + attributes[key] + '"');
                }
            }

            return attrs.join(' ');
        };

        var getHtmlLink = function (url, title, attributes) {
            title      = title || url;
            attributes = getLinkAttributes(attributes);

            return '<a href="' + url + '" ' + attributes + '>' + title + '</a>';
        };

        return {
            // Generate a url for a given controller action.
            // laroute.action('HomeController@getIndex', [params = {}])
            action : function (name, parameters) {
                parameters = parameters || {};

                return routes.route(name, parameters, routes.getByAction(name));
            },

            // Generate a url for a given named route.
            // laroute.route('routeName', [params = {}])
            route : function (route, parameters) {
                parameters = parameters || {};

                return routes.route(route, parameters);
            },

            // Generate a fully qualified URL to the given path.
            // laroute.route('url', [params = {}])
            url : function (route, parameters) {
                parameters = parameters || {};

                return routes.url(route, parameters);
            },

            // Generate a html link to the given url.
            // laroute.link_to('foo/bar', [title = url], [attributes = {}])
            link_to : function (url, title, attributes) {
                url = this.url(url);

                return getHtmlLink(url, title, attributes);
            },

            // Generate a html link to the given route.
            // laroute.link_to_route('route.name', [title=url], [parameters = {}], [attributes = {}])
            link_to_route : function (route, title, parameters, attributes) {
                var url = this.route(route, parameters);

                return getHtmlLink(url, title, attributes);
            },

            // Generate a html link to the given controller action.
            // laroute.link_to_action('HomeController@getIndex', [title=url], [parameters = {}], [attributes = {}])
            link_to_action : function(action, title, parameters, attributes) {
                var url = this.action(action, parameters);

                return getHtmlLink(url, title, attributes);
            }

        };

    }).call(this);

    /**
     * Expose the class either via AMD, CommonJS or the global object
     */
    if (typeof define === 'function' && define.amd) {
        define(function () {
            return laroute;
        });
    }
    else if (typeof module === 'object' && module.exports){
        module.exports = laroute;
    }
    else {
        window.laroute = laroute;
    }

}).call(this);

