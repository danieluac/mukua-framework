<?php

require_once __DIR__.DIRECTORY_SEPARATOR."../vendor/autoload.php";

use MukuaKernel\Route\RouteModule;

 RouteModule::get("/Mucua-index","App\HttpRequest\Controller\ControllerMucua@index");
 RouteModule::get("/Mucua-index","App\HttpRequest\Controller\ControllerMucua@index");
 RouteModule::post("/Mucua-index","App\HttpRequest\Controller\ControllerMucua@index")->name("post.store");
 RouteModule::get("/Mucua-index","App\HttpRequest\Controller\ControllerMucua@index");
 
 // use App\HttpRequest\kernel\kernel;
 print " <pre>";
 RouteModule::showAllRoute();
// print_r($_SERVER);
print "</pre>";
//print_r(  kernel::class);
//return new kernel();
