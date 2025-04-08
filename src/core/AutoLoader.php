<?php

namespace ShuffleLunchService;

class AutoLoader
{
  // 複数のディレクトリの情報を保持する$dirsを定義
  private $dirs = [];

  public function registerDir($dir)
  {
    $this->dirs[] = $dir;
  }

  //$this->dirsに格納されているディレクトリ配下のクラスをオートロードする
  public function register()
  {
    spl_autoload_register([$this, 'loadClass']);
  }

  private function loadClass($className)
  {
    $className = ltrim($className, '\\');
    if ($lastNsPos = strrpos($className, '\\')) {
      $className = substr($className, $lastNsPos + 1);
    }
    foreach ($this->dirs as $dir) {
      $file = $dir . DIRECTORY_SEPARATOR . $className . '.php';
      if (is_readable($file)) {
        require $file;
        return;
      }
    }
  }
}
