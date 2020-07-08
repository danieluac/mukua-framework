<?php
namespace MukuaKernel\Route;
class RouteModule {
    /**
     * route list mapper
     * @var $routeList
     */
    private static $routeList = [];
    private static $routeCounter = 0;   
    /**
     * route name
     * @param string $name
     * @return MukuaKernel\Route\RouteModule
     */
    public function name($name){
        self::$routeList[self::$routeCounter-1]['name'] = $name;
        return $this;
    }
    /**
     * set route to list
     * @param string $route
     * @param string $httpMethod
     * @param $controller
     */
    public static function setRouteList($route,$httpMethod,$controller){
        self::$routeList[self::$routeCounter]['route'] = $route; 
        self::$routeList[self::$routeCounter]['method'] = $httpMethod;
        self::$routeList[self::$routeCounter]['controller'] = $controller;
        self::$routeList[self::$routeCounter]['name'] = null;
        self::$routeCounter ++;
    }
    public static function showAllRoute(){
        print_r(self::$routeList);
    }
    /**
     * Http get method for request
     * @param string $url
     * @param string $controller
     * @return MukuaKernel\Route\RouteModule
     * 
     * 
     *@ $url : it will be route available into application
     * $controller : controller namespace has been executed
     */
    public static function get($url,$controller){
        self::setRouteList($url,"GET",$controller);
        return new RouteModule;
    }
    public static function post($url,$controller){
        self::setRouteList($url,"POST",$controller);
        return new RouteModule;
    }
    public static function put($url,$controller){
        self::setRouteList($url,"PUT",$controller);
        return new RouteModule;
    }
    public static function delete($url,$controller){       
        self::setRouteList($url,"DELETE",$controller);
        return new RouteModule;
    }
}