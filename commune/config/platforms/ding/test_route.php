<?php

use Hyperf\HttpServer\Router\Router;


Router::get('/test', function() {
    return 'hello world';
});

