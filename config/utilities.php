<?php 
/**
 * Get URI path.
 * @return string $uri  Sanitized URI
 */
function getUri() : string
{
  $uri = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');
  $uri = explode('/', $uri);
  array_shift($uri);
  $uri = implode('/', $uri);
  
  return $uri;
}

/**
 * Loads a view file
 * @param string $view Example: 'index', 'about', 'contact'
 * @param array $data Associative array with named keys for data
 * @return void
 */
function view(string $view, array $data = []) : void
{
  $file = APPROOT . '/src/views/' . $view . '.php';
  // Check for view file
  if (is_readable($file))
  {
    // Extract the data array into separate variables for the view
    extract($data);
    require_once $file;
  }
  else
  {
    // View does not exist
    die('<h1> 404 Page not found </h1>');
  }
}
