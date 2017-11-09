<?php

function perex($string,$perexMax = 100)
{
      
                        $perex = strip_tags($string);
                        if( mb_strlen($perex) > $perexMax )
                        {
                           $pies = explode(" ",$perex);
                           $count = 0;
                           $perex = "";
                           for($i=0;$i<count($pies);$i++)
                           {
                               $count = mb_strlen($perex.' '.$pies[$i]);
                               if($count > $perexMax) {
                                   $perex .= '...';
                                   break;
                               }
                               else $perex .= ' '.$pies[$i];
                           }
                        }
                      return $perex;
}
