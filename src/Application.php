<?php

namespace ShuffleLunchService;

use Dotenv;

class Application
{
  protected $router;
  protected $request;
  protected $response;
  protected $databaseManager;

  public function __construct()
  {
    $this->router = new Router($this->registerRouters());
    $this->request = new Request();
    $this->response = new Response();
    $this->databaseManager = new DatabaseManager();
    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__  . '/');
    $dotenv->load();
    $this->databaseManager->connect(
      [
        'hostname' => $_ENV['DB_HOST'],
        'username' => $_ENV['DB_USER'],
        'password' => $_ENV['DB_PASSWORD'],
        'database' => $_ENV['DB_DATABASE'],
      ]
    );
  }

  public function run() {}

  private function registerRouters()
  {
    return [
      '/' => ['controller' => 'shuffle', 'action' => 'index']
    ];
  }
}
