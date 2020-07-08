<?php 

if(!function_exists("view"))
{
    function view (string $view)
    {
        print $view;
    }

}

if(!function_exists("route"))
{
    function route (string $url)
    {
        print $route;
    }
}
if(!function_exists("redirectTo"))
{
    function redirectTo (string $url)
    {
        print $url;
    }
}
