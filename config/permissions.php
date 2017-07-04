<?php

/**
 * Created by PhpStorm.
 * User: osmany.torres
 * Date: 5/16/2016
 * Time: 4:00 PM
 */

$other_routes = [
    "home" => true,
    "error.503" => true
];

$nomenclator_routes = [
    "nomenclators.json" => true,
    "nomenclators.index" => true,
    "nomenclators.create" => true,
    "nomenclators.store" => true,
    "nomenclators.show" => true,
    "nomenclators.edit" => true,
    "nomenclators.update" => true,
    "nomenclators.destroy" => true,
    "nomenclators.activate" => true,
    "nomenclators.datatable" => true
];

$user_routes = [
    "users.json" => true,
    "users.datatable" => true,
    "users.filter" => true,
    "users.clean" => true,
    "users.index" => true,
    "users.create" => true,
    "users.store" => true,
    "users.show" => true,
    "users.edit" => true,
    "users.update" => true,
    "users.destroy" => true
];

$auth_routes = [
    "auth.login" => true,
    "auth.logout" => true
];

$debugbar_routes = [
    'debugbar.assets.css' => true,
    'debugbar.assets.js' => true,
    'debugbar.openhandler' => true,
    'debugbar.clockwork' => true
];

$customer_routes = [
    "customers.datatable" => true,
    "customers.filter" => true,
    "customers.clean" => true,
    "customers.ban" => true,
    "customers.activate" => true,
    "customers.index" => true,
    "customers.create" => true,
    "customers.store" => true,
    "customers.show" => true,
    "customers.edit" => true,
    "customers.update" => true,
    "customers.destroy" => true,
    "customers.library_card" => true
];

$traces_routes = [
    "traces.datatable" => true,
    "traces.filter" => true,
];

return [
    'ROLE_SUPER_ADMINISTRATOR' => array_merge(
        $other_routes,
        $nomenclator_routes,
        $user_routes,
        $auth_routes,
        $customer_routes,
        $traces_routes,
        $debugbar_routes),

    'ROLE_REGISTRY' => $user_routes
];