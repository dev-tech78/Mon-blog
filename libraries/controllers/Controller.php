<?php

namespace Controllers;


require_once('libraries/models/Article.php');
require_once('libraries/models/User.php');
require_once('libraries/models/Comment.php');

 abstract class Controller 
  {
   
    protected $model;
    protected $modelName;
  
 
    public function __construct()
    {
   
     $this->model =  new $this->modelName();
    }
    
  } 