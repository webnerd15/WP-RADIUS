<?php
//ini_set('display_errors' 1);
//error_reporting(E_ALL);
define('RADCHECK','radcheck');
define('RADREPLY', 'radreply');
define('RADGROUPCHECK', 'radgroupcheck');
define('RADGROUPREPLY', 'radgroupreply');
define('NAS', 'nas');
define('RADACCT', 'radacct');
define('RADUSERGROUP', 'radusergroup');
define('RADPOSTAUTH', 'radpostauth');

function s2h($ss) {
    $s = $ss%60;
    $m = floor(($ss%3600)/60);
    $h = floor(($ss%86400)/3600);
    $d = floor(($ss%2592000)/86400);
    $M = floor($ss/2592000);
    if($M > 0){
       return "$M months, $d days, $h hours, $m minutes, $s seconds"; 
    }elseif ($d > 0) {
       return "$d days, $h hours, $m minutes, $s seconds"; 
    }elseif($h > 0){
        return "$h hours, $m minutes, $s seconds"; 
    }elseif($m > 0){
        return "$m minutes, $s seconds"; 
    }else{
        return "$s seconds"; 
    }
}

function b2h($bytes, $precision = 2) { 
    $units = array('B', 'KB', 'MB', 'GB', 'TB'); 

    $bytes = max($bytes, 0); 
    $pow = floor(($bytes ? log($bytes) : 0) / log(1024)); 
    $pow = min($pow, count($units) - 1); 

    // Uncomment one of the following alternatives
     $bytes /= pow(1024, $pow);
    // $bytes /= (1 << (10 * $pow)); 

    return round($bytes, $precision) . ' ' . $units[$pow]; 
} 

// results paginations
function pagination($count, $per_page = 10,$page = 1, $url = '?'){        
		    	//$query = "SELECT COUNT(*) as `num` FROM {$query}";
		    	//$row = mysql_fetch_array(mysql_query($query));
		    	$total = $count; //$row['num'];
		        $adjacents = "2"; 
		
		    	$page = ($page == 0 ? 1 : $page);  
		    	$start = ($page - 1) * $per_page;								
				
		    	$prev = $page - 1;							
		    	$next = $page + 1;
		        $lastpage = ceil($total/$per_page);
		    	$lpm1 = $lastpage - 1;
		    	
		    	$pagination = "";
		    	if($lastpage > 1)
		    	{	
		    		$pagination .= "<ul class='pagination'>";
		                    $pagination .= "<li class='details'>Page $page of $lastpage</li>";
		    		if ($lastpage < 7 + ($adjacents * 2))
		    		{	
		    			for ($counter = 1; $counter <= $lastpage; $counter++)
		    			{
		    				if ($counter == $page)
		    					$pagination.= "<li><a class='current'>$counter</a></li>";
		    				else
		    					$pagination.= "<li><a href='{$url}show_page=$counter'>$counter</a></li>";					
		    			}
		    		}
		    		elseif($lastpage > 5 + ($adjacents * 2))
		    		{
		    			if($page < 1 + ($adjacents * 2))		
		    			{
		    				for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++)
		    				{
		    					if ($counter == $page)
		    						$pagination.= "<li><a class='current'>$counter</a></li>";
		    					else
		    						$pagination.= "<li><a href='{$url}show_page=$counter'>$counter</a></li>";					
		    				}
		    				$pagination.= "<li class='dot'>...</li>";
		    				$pagination.= "<li><a href='{$url}show_page=$lpm1'>$lpm1</a></li>";
		    				$pagination.= "<li><a href='{$url}show_page=$lastpage'>$lastpage</a></li>";		
		    			}
		    			elseif($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2))
		    			{
		    				$pagination.= "<li><a href='{$url}show_page=1'>1</a></li>";
		    				$pagination.= "<li><a href='{$url}show_page=2'>2</a></li>";
		    				$pagination.= "<li class='dot'>...</li>";
		    				for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++)
		    				{
		    					if ($counter == $page)
		    						$pagination.= "<li><a class='current'>$counter</a></li>";
		    					else
		    						$pagination.= "<li><a href='{$url}show_page=$counter'>$counter</a></li>";					
		    				}
		    				$pagination.= "<li class='dot'>..</li>";
		    				$pagination.= "<li><a href='{$url}show_page=$lpm1'>$lpm1</a></li>";
		    				$pagination.= "<li><a href='{$url}show_page=$lastpage'>$lastpage</a></li>";		
		    			}
		    			else
		    			{
		    				$pagination.= "<li><a href='{$url}show_page=1'>1</a></li>";
		    				$pagination.= "<li><a href='{$url}show_page=2'>2</a></li>";
		    				$pagination.= "<li class='dot'>..</li>";
		    				for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++)
		    				{
		    					if ($counter == $page)
		    						$pagination.= "<li><a class='current'>$counter</a></li>";
		    					else
		    						$pagination.= "<li><a href='{$url}show_page=$counter'>$counter</a></li>";					
		    				}
		    			}
		    		}
		    		
		    		if ($page < $counter - 1){ 
		    			$pagination.= "<li><a href='{$url}show_page=$next'>Next</a></li>";
		                $pagination.= "<li><a href='{$url}show_page=$lastpage'>Last</a></li>";
		    		}else{
		    			$pagination.= "<li><a class='current'>Next</a></li>";
		                $pagination.= "<li><a class='current'>Last</a></li>";
		            }
		    		$pagination.= "</ul>\n";		
		    	}
		    
		    
		        return $pagination;
}