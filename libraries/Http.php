<?php

class Http {



   public static function redirect(string $url) :void
{
    header("Location: $url ");
    exit();
    
}
}