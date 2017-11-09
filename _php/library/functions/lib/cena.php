<?php

function cena($val,$lang)
{
    if( $lang == 'cz' ) return "{$val} Kč";
    elseif( $lang == 'en' ) return "{$val} $";
}

function cenaDPH($bez,$dph)
{
          $koef = 1+intval($dph)/100;
          
          $sumDPH = $bez*$koef;
          $val = ceil($sumDPH);   
          
          return "{$val},- Kč";
}

function cenaRozdil($bezp,$bezs,$dph)
{
          $koef = 1+intval($dph)/100;
          
          $sumDPH = $bezp*$koef;
          $valp = ceil($sumDPH);    
          
          $sumDPH = $bezs*$koef;
          $vals = ceil($sumDPH);    
          
          $val = $valp - $vals;
          
          return "{$val},- Kč";
}