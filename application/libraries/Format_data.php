<?php if(!defined('BASEPATH'))exit('No direct script access allowed');

class Format_data {
	function string($data)
	{
     	$filter = trim(strip_tags(htmlentities(htmlspecialchars($data,ENT_QUOTES))));
    	return $filter;
	}

	function paginate($url, $page, $tpages, $adjacents) {
	    $firstPage = 1;
		$prev = $page - 1;							
		$next = $page + 1;
		$lastpage = $tpages;
		$lpm1 = $lastpage - 1;
		$out = '<div class="pagin">';
		
		
			$prev = ($page == 1)?1:$page - 1;
			if ($page == 1){
				$out.= "<span>First</span>";
				$out.= "<span>Prev</span>";
			} else {
				$out.= "<a href=\"$url/$firstPage\">First</a>";
				$out.= "<a href=\"$url/$prev\">Prev</a>";
			}

			if ($lastpage < 6 + ($adjacents * 2))
			{	
				for ($counter = 1; $counter <= $lastpage; $counter++)
				{
					if ($counter == $page)
						$out.= "<span>$counter</span>";
					else
						$out.= "<a href=\"$url/$counter\">$counter</a>";				
				}
			} 
			elseif($lastpage > 5 + ($adjacents * 2)) 
			{
				if($page < 1 + ($adjacents * 2))
				{
					for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++)
					{
						if ($counter == $page)
							$out.= "<span>$counter</span>";
						else
							$out.= "<a href=\"$url/$counter\">$counter</a>";						
					}
					$out.= "<label>...</label>";
					$out.= "<a href=\"$url/$lpm1\">$lpm1</a>";
					$out.= "<a href=\"$url/$lastpage\">$lastpage</a>";
				}
				elseif($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2))
				{
					$out.= "<a href=\"$url/1\">1</a>";
					$out.= "<a href=\"$url/2\">2</a>";
					$out.= "<label>...</label>";
					for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++)
					{
						if ($counter == $page)
							$out.= "<span>$counter</span>";
						else
							$out.= "<a href=\"$url/$counter\">$counter</a>";					
					}
					$out.= "<label>...</label>";
					$out.= "<a href=\"$url/$lpm1\">$lpm1</a>";
					$out.= "<a href=\"$url/$lastpage\">$lastpage</a>";
				}
				else
				{
					$out.= "<a href=\"$url/1\">1</a>";
					$out.= "<a href=\"$url/2\">2</a>";
					$out.= "<label>...</label>";
					for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++)
					{
						if ($counter == $page)
							$out.= "<span>$counter</span>";
						else
							$out.= "<a href=\"$url/$counter\">$counter</a>";						
					}
				}
			}
			
			if ($page < $counter - 1){ 
				$out.= "<a href=\"$url/$next\">Next</a>";
				$out.= "<a href=\"$url/$lastpage\">Last</a>";
			}else{
				$out.= "<span>Next</span>";
				$out.= "<span>Last</span>";
			}
		
		
	    $out.= "</div>";
	    return $out;
	}
	
	   
} 