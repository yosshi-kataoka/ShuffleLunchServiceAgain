<?php

abstract class controller
{
  public function run($action)
  {
    $this->$action();
  }
}
