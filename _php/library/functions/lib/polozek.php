<?php

function polozek($count)
{
     if( $count == 0 ) $val = 'položek';
     elseif( $count == 1 ) $val = 'položka';
     elseif( $count > 1  ) $val = 'položek';
    return $val;
}
