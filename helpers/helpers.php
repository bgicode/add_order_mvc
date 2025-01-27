<?php

function app(): \Core\Application
{
    return \Core\Application::$app;
}

function request(): \Core\Request
{
    return app()->request;
}

function response(): \Core\Response
{
    return app()->response;
}

function view($view = '', $data = [], $layout = ''): string|\Core\Request
{
    if ($view) {
        return app()->view->render($view, $data, $layout);
    }
    return app()->view;
}

function abort($error = '', $code = 404)
{
    response()->setResponseCode($code);
    echo view("errors/{$code}", ['error' => $error], false);
    die;
}

function base_url($path = ''): string
{
    return PATH . $path;
}

function db(): \Core\Database
{
    return app()->db;
}