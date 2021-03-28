<?php 

namespace Mubangizi\Core;

class Response
{
    
    public function __construct()
    {
        
    }
    
    public function set_status_code(int $code){
        http_response_code($code);
    }
}


?>