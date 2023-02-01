<?php


   class App{
       protected $controller='homeController';
       protected $method='index';
       protected $params=[];
       public function __construct()
       {
           $this->getUrl();
           $this->render();
       }
       public function getUrl(){
           $url=$_SERVER['REQUEST_URI'];
           if(!empty($url)){
               $url=trim($url,'/');
                $url=explode('/',$url);
                $this->controller=!empty($url[0]) ? $url[0].'Controller' : 'homeController';
                $this->method=!empty($url[1]) ? $url[1] : 'index';
                unset($url[0],$url[1]);
                $this->params=!empty($url) ? array_values($url) : [];
           }
       }
       public function render(){
           if(class_exists($this->controller)){
               $controller=new $this->controller;
               if(method_exists($controller,$this->method)){
                   call_user_func_array([$controller,$this->method],$this->params);
               }else{
                   echo 'this method not exist';
               }
           }else{
               echo 'this class not exist';
           }
       }
   }