<?php

function mesic($i) {
    if($i==1) return 'leden';
    if($i==2) return 'únor';
    if($i==3) return 'březen';
    if($i==4) return 'duben';
    if($i==5) return 'květen';
    if($i==6) return 'červen';
    if($i==7) return 'červenec';
    if($i==8) return 'srpen';
    if($i==9) return 'září';
    if($i==10) return 'říjen';
    if($i==11) return 'listopad';
    if($i==12) return 'prosinec';
}

function cs_skoly($count)
{
    if( $count == 1 ) return "1 škola";
                        elseif($count > 1 && $count < 5) return "{$count} školy";    
                        elseif($count > 4 ) return "{$count} škol";      
    return $count;
}

function cs_roky($count)
{
    if( $count == 1 ) return "1 rok";
                        elseif($count > 1 && $count < 5) return "{$count} roky";    
                        elseif($count > 4 ) return "{$count} let";      
    return $count;
}

function cs_hodiny($count)
{
    if( $count == 1 ) return "1 hodina";
                        elseif($count > 1 && $count < 5) return "{$count} hodiny";    
                        elseif($count > 4 ) return "{$count} hodin";      
    return $count;
}


