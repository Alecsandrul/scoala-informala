<?php
// start session

session_start();
// echo "<pre>";
// print_r($_SERVER);

// Include helpers functions
require "app/helpers/functions.php";

$routes["/articles"] = array("controller" => "Articles",
                                "method" => "index");
$routes["/articles/add"] = array("controller" => "Articles",
                                "method" => "addArticle");
$routes["/articles/delete"] = array("controller" => "Articles",
                                "method" => "deleteArticle");
$routes["/articles/get"] = array("controller" => "Articles",
                                "method" => "getArticle");
$routes["/articles/update"] = array("controller" => "Articles",
                                "method" => "updateArticle");
                                
                                
$routes["/login"]= array("controller"=>"Login",
                          "method"=>"index");
$routes["/logout"]= array("controller"=>"Login",
                          "method"=>"logout");
                          
$routes["/comments"] = array("controller" => "Comments",
                                "method" => "index"); 
$routes["/comments/add"] = array("controller" => "Comments",
                                "method" => "addComment");
                                
$routes["/session"] = array("controller" => "Login",
                                "method" => "checkSession");
 
 
                                
if (isset($_SERVER["PATH_INFO"])) {
    $key = rtrim($_SERVER['PATH_INFO'], '/');
    //$key = $_SERVER["PATH_INFO"];
    if (array_key_exists($key, $routes)) {
        require "app/controllers/" . $routes[$key]["controller"] . ".php"; 
        $controller = new $routes[$key]["controller"]();
        $response = $controller->$routes[$key]["method"]();
        // Print response for XHR|AJAX JS
        api_response($response,http_response_code());
        // header("Content-Type: application/json");
        // echo json_encode($response);
    }
    
else {
        api_response(array("error"=>"Page not found"), 404);
        // header("Content-Type: application/json");
        // header("HTTP/1.1 404 Page not found");
        // echo json_encode("Page not found");
    }
}
else {
    api_response(array("error"=>"Access Forbidden"), 403);
    // header("Content-Type: application/json");
    // header("HTTP/1.1 403 Access Forbidden");
    // echo json_encode("Access Forbidden");    
}
                                


