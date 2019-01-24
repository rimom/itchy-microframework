<?php
$this->group('App\Controllers', function($router) {
    $router->get('', 'PagesController::index');
    $router->get('notFound', 'PagesController::notFound');

    $router->post('save', 'OperationsController::save');
    $router->post('remove', 'OperationsController::remove');
});