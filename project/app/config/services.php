<?php

use Phalcon\Mvc\View;
use Phalcon\Mvc\Url as UrlResolver;
use Phalcon\Mvc\Collection\Manager;
use Phalcon\Db\Adapter\MongoDB\Client;
use Phalcon\Mvc\Dispatcher;
use Phalcon\Events\Manager as EventsManager;

/**
 * Shared configuration service
 */
$di->setShared('config', function () {
    return include BASE_PATH . "/app/config/config.php";
});

/**
 * The URL component is used to generate all kind of urls in the application
 */
$di->setShared('url', function () {
    $config = $this->getConfig();

    $url = new UrlResolver();
    $url->setBaseUri($config->application->baseUri);

    return $url;
});

/**
 * Setting up the view component
 */
$di->setShared('view', function () {
    $view = new View();
    $view->setDI($this);
    $view->setViewsDir(BASE_PATH . '/app/views/');
    return $view;
});

$di->setShared('mongo', function () {
    /** @var \Phalcon\DiInterface $this */
    $config = $this->getShared('config');

    if (!$config->mongodb->username || !$config->mongodb->password) {
        $dsn = 'mongodb://' . $config->mongodb->host;
    } else {
        $dsn = sprintf(
            'mongodb://%s:%s@%s',
            $config->mongodb->username,
            $config->mongodb->password,
            $config->mongodb->host
        );
    }

    $mongo = new Client($dsn);

    return $mongo->selectDatabase($config->mongodb->dbname);
});

$di->set('collectionManager', function(){
    return new Manager();
}, true);

use Phalcon\Logger\Adapter\File as FileAdapter;

$di->setShared('logger', function(){
    $config = $this->getConfig();
    return new FileAdapter(
        $config->application->logDir.'app.log'
    );
});

$di->setShared('logger_op', function(){
    $config = $this->getConfig();
    return new FileAdapter(
        $config->application->logDir.'op.log'
    );
});

$di->set(
    'dispatcher',
    function () {
        // Create an events manager
        $eventsManager = new EventsManager();

        $dispatcher = new Dispatcher();

        // Assign the events manager to the dispatcher
        $dispatcher->setEventsManager($eventsManager);

        return $dispatcher;
    }
);

$di->setShared(
    'session',
    function () {
        $session = new \Phalcon\Session\Adapter\Files();
        $session->start();
        return $session;
    }
);

$di->setShared('mongo', function () {
    /** @var \Phalcon\DiInterface $this */
    $config = $this->getShared('config');

    if (!$config->mongodb->username || !$config->mongodb->password) {
        $dsn = 'mongodb://' . $config->mongodb->host . ':' . $config->mongodb->port;
    } else {
        $dsn = sprintf(
            'mongodb://%s:%s@%s',
            $config->mongodb->username,
            $config->mongodb->password,
            $config->mongodb->host
        );
    }

    $mongo = new Client($dsn);

    return $mongo->selectDatabase($config->mongodb->dbname);
});

$di->set('collectionManager', function(){
    return new Manager();
}, true);
