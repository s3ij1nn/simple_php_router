<?php

class Router
{
  private $uri;
  private $raw_method;
  public $method;
  public $argv;

  public function __construct()
  {
    $this->uri = $_SERVER['REQUEST_URI'];
    $this->raw_method = $_SERVER['REQUEST_METHOD'];
      }

  public function match_uri($pattern)
  {
    if($pattern === '/'){
        $pattern = '|^'.$pattern.'|';
    }else{
        $pattern = '|^/'.$pattern.'|';
    }
    if(preg_match($pattern, $this->uri, $m)){
      $this->argv = $m;
      return true;
    }
    return false;
  }
  public function method($method = 'GET')
  {
    if(!is_array($method)){
      if($this->raw_method === $method){
        $this->method = 'GET';
        return true;
      }
      return false;
    }else{
      $methods = $method;
      foreach($methods as $method){
        if($this->raw_method === $method){
          $this->method = method;
          return true;
        }
      }
      return false;
    }
  }

  public function router($method, $pattern, $function = false)
  {
    if($this->router_check($method, $pattern)){

      if($function){

        // \Namesapce\Object@func
        // [
        //  "\Namespace\Object',
        //  "func"
        // ]
        $functions = explode('@', $function, 2);

        if(count($functions) == 1){
          $functions[0]();
        }else{
          (new $functions[0])->{$functions[1]}();
        }

      }else{
        return true;
      }
    }
  }

  private router_check($method, $pattern)
  {
    if($this->match_uri($pattern)){
      if($this->raw_method($method)){
        return true;
      }
    }
    return false;
  }
}


