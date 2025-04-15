<?php

namespace ShuffleLunchService;

use Dotenv;
use HttpNotFoundException;

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
    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
    $dotenv->load();
    $this->databaseManager->dbConnect(
      [
        'hostname' => $_ENV['DB_HOST'],
        'username' => $_ENV['DB_USER'],
        'password' => $_ENV['DB_PASSWORD'],
        'database' => $_ENV['DB_DATABASE'],
      ]
    );
  }

  public function run()
  {

    $path = $this->request->getPathInfo();
    try {
      $params = $this->router->resolve($path);
      if (!$params) {
        throw new HttpNotFoundException('アクセスされたページが見つかりません。');
      }
      $controller = $params['controller'];
      $action = $params['action'];
    } catch (HttpNotFoundException $e) {
      error_log('Error' . $e->getMessage());
      $this->render404Page();
    }
    $this->response->send();
  }

  private function registerRouters()
  {
    return [
      '/' => ['controller' => 'shuffle', 'action' => 'index']
    ];
  }

  private function render404Page()
  {
    $this->response->setStatusCode('404', 'Page Not Found');
    ob_start();
    require __DIR__ . '/views/pageNotFound.php';
    $content = ob_get_clean();
    $this->response->setContent($content);
  }
}
