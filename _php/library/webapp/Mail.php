<?php

class AppMail
{
    public static function sendMail($email,$subject,$html,$from,$uselayout=true)
    {
                $hlavicka="From:".$from."\n";
                $hlavicka.="Content-Type: text/html; charset=UTF-8\n";

                if($uselayout)
                $html = self::getLayout($html);
                                                
                return mail($email,$subject,$html,$hlavicka);            
    }
    
    public static function getLayout($message)
    {
        ob_start();
        
        require 'layouts/mail/layout.php';
        
        $html = ob_get_clean();
        
        return $html;        
    }
}