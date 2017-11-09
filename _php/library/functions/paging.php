<?php

function paging( $count, $params, $class = 'paging' ) {
 
      $return = ''; 
      $current = 0;
      $items_per_page = $params['limit_period'];
      $show_items = $params['paging_show'];
      $active = $params['limit'];
      $uri    = $params['uri'];
      $href = 1;
      $forward = 0;
      $backward = 0;
      
      
      $bonus = null;
  
	  
      $uri_params = isset($params['params']) ? '?'.$params['params'].'&amp;limit=' :'?limit=';
      
      //first
      //prev show_items
      if(($active-($show_items/2)*$items_per_page) < 0) {
 			$bonus = ($active-($show_items/2)*$items_per_page);
      }
      if(($active+($show_items/2)*$items_per_page) >= $count) {
 			$bonus = (($active+($show_items/2)*$items_per_page)-$count);
      }
      do {
 		if($current >= ($active-(($show_items/2)*$items_per_page)-$bonus) && $current <= ($active+(($show_items/2)*$items_per_page)-$bonus)) {
	       $return .= '<a href="'.$uri. $uri_params . $current .'"
	                      class="'. ( $current == $active
	                           ? $class . 'Active' 
	                           : $class ).
	                    '">&nbsp;'. $href .'&nbsp;</a> ';                       
		 }
		 if($current == $active) {
		  $forward = $current + ($items_per_page*5);
		  $backward = $current - ($items_per_page*5);
		 }
         $current += $items_per_page;
         $href++;     
       } while( $current < $count );
      
      $current -= $items_per_page;
      if($forward > $current) {
 		$forward = $current;
      }
      if($backward < 0) {
 		$backward = 0;
      }

$return = '<a href="'.$uri. $uri_params . 0 .'" class="'.$class.'"><span>|&lt;</span></a>
                 <a  rel="'.$backward .'" href="'.$uri. $uri_params . $backward .'" class="'.$class.'"><span>&lt;</span></a> '
                .$return;
      $return .= '<a href="'.$uri. $uri_params . $forward .'" class="'.$class.'"><span>&gt;</span></a> ';
      $return .= '<a href="'.$uri. $uri_params . $current .'" class="'.$class.'"><span>&gt;|</span></a> ';
      if( $current % $items_per_page > 0 )
              $return .= '&nbsp;&nbsp; <a href="'. $uri.'?'. $uri_params . $current .'"
                      class= '. ( $params['paging'] == $active
                           ? $class.'Active'
                           : $class ).
                    '">'. $href .'</a>';


      //next show_items
      //last                           
                           
      return $return;

	}
