<?php
/*
    App Core Class
    Creates URL * Loads core controller
    URL FORMAT - /controller/method/params
    */
class Core
{
  protected $currentController = 'Pages';
  protected $currentMethod = 'index';
  protected $params = [];

  /**
   * The magic __construct method that breaks up the URL into controller, view, and parameters.
   */
  public function __construct()
  {
    $url = $this->getUrl();

    // look in controllers for first value
    if (isset($url[0]) && file_exists('../app/controllers/' . ucwords($url[0]) . '.php')) {
      // if exists, set as controller
      $this->currentController = ucwords($url[0]);

      // unset 0 index
      unset($url[0]);
    }

    // Require the controller
    require_once '../app/controllers/' . $this->currentController . '.php';

    // instantiate controller class
    $this->currentController = new $this->currentController;

    // Check for second part of url
    if (isset($url[1])) {
      // check to see if method exists in controller
      if (method_exists($this->currentController, $url[1])) {
        $this->currentMethod = $url[1];
        unset($url[1]);
      }
    }

    // get params
    $this->params = $url ? array_values($url) : [];

    // Call a callback with array of params
    call_user_func_array([$this->currentController, $this->currentMethod], $this->params);
  }

  /**
   * Get the current URL.
   *
   * @return String url - The current URL.
   */
  public function getUrl()
  {
    if (isset($_GET['url'])) {
      $url = rtrim($_GET['url'], '/');
      $url = filter_var($url, FILTER_SANITIZE_URL);
      $url = explode('/', $url);
      return $url;
    }
  }
}
