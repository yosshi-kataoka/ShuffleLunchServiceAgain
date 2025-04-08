<?php

namespace ShuffleLunchService;

class Response
{
  private $statusCode;
  private $statusText;
  private $content;

  public function send()
  {
    header('HTTP/1.1 ' . $this->statusCode  . ' ' .  $this->statusText);
    echo $this->content;
  }

  public function setContent($content)
  {
    $this->content = $content;
  }

  public function setStatusCode($statusCode, $statusText)
  {
    $this->statusCode = $statusCode;
    $this->statusText = $statusText;
  }
}
