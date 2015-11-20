<?php

class Debugger extends CVarDumper {
    /**
     * Displays a variable.
     * This method achieves the similar functionality as var_dump and print_r
     * but is more robust when handling complex objects such as Yii controllers.
     * @param mixed variable to be dumped
     * @param integer maximum depth that the dumper should go into the variable. Defaults to 10.
     * @param boolean whether the result should be syntax-highlighted
     */
    public static function dump($var, $depth=10, $highlight=true)
    {     
        echo self::dumpAsString($var,$depth,$highlight);
    }
    
    public static function pr($var, $title='', $depth=10, $highlight=true)
    {
        if ($empty($title))        
            echo $title.' = ';
        
        echo self::dumpAsString($var,$depth,$highlight);
    }
}