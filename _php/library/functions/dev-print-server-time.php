<?php

function devprintservertime() {
                        $timeEnd = microtime(true);
                        $timeRun = $timeEnd - $_SERVER["REQUEST_TIME_FLOAT"];    

                        $mess = "<br style='clear:both'><div>[Gen time: ".$timeRun
                        . " | last: ".(isset($_SESSION['lastRun'])?$_SESSION['lastRun']:"none")."]</div>";
                        $_SESSION['lastRun'] = $timeRun;
                        return $mess;
}
