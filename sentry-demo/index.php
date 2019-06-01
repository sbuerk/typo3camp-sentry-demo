<?php

chdir(dirname(__FILE__));
require "vendor/autoload.php";

// copied from project
$client = new Raven_Client('http://cf5dc3ae75c344258ee36aa517a63ce3:b9fe378ac3e3438c897c1e737108aad1@localhost:9001/2');

// automatic error and exception capturierng
$error_handler = new Raven_ErrorHandler($client);
$error_handler->registerExceptionHandler();
$error_handler->registerErrorHandler();
$error_handler->registerShutdownFunction();

// or
// $client->install();

// See SDK documentation for language specific usage.
class demo {

    /** Raven_Client */
    private $client;

    protected $errorHandler;

    public function __construct(string $dsn)
    {
        $this->client = new Raven_Client($dsn);
        
        $this->error_handler = new Raven_ErrorHandler($client);
        $this->error_handler->registerExceptionHandler();
        $this->error_handler->registerErrorHandler();
        $this->error_handler->registerShutdownFunction();
    }

    public function userContext()
    {
        $this->client->user_context(array(
            'email' => 'user@domain.tld',
            'id' => 12361,
        ));
    }

    public function tagContext()
    {
        $this->client->tags_context(
            [
                'locale'    => 'en_US',
            ]
        );
    }

    public function triggerNotice()
    {
        trigger_error("Warning: Something", E_USER_NOTICE);
    }

    public function unhandleException()
    {
        $this->demoStackTrace();
    }

    public function handledException()
    {
        try {
            $this->stack1("Handled Exception");
        } catch(\Exception $ex)
        {
            $event_id = $this->client->captureException($ex);
            echo "Sorry, there was an error!";
            echo "Your reference ID is " . $event_id;
        }
        
    }

    public function demoStackTrace()
    {
        $this->stack1("demo stack trace");
    }

    protected function stack1($test=1)
    {
        $this->stack2($test, "inner stack 2 param");
    }

    protected function stack2($test, $test1=2)
    {
        throw new \Exception($test . " " , $test1);
    }
}

$demo = new Demo('');
//$demo->userContext();
//$demo->tagContext();
//$demo->triggerNotice();
//$demo->unhandleException();
//$demo->handledException();

echo "demo1" . PHP_EOL;