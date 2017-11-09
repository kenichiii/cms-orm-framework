<?php

class Model_TemplateFactory
{        
    
    public static function translatePHP($template)
    {
        $template = str_replace('[[', '<?php',$template);
        $template = str_replace(']]', '?>',$template);
        $template = preg_replace("/(^[\r\n]*|[\r\n]+)[\s\t]*[\r\n]+/", "\n\n", $template);
        
        return $template;
    }
    
}
