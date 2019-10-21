<?php
locked();
//include_once('models/dashboard.php');

//show users list


if (!isset($_GET['edit']) && !isset($_GET['del']) && !isset($_GET['add'])) {
    $countPerPage = 20;
    //$totalResultCount = count_users($conn);

	// The ceil function will round floats up.
    //$numberOfPages = ceil($totalResultCount / $countPerPage);

	// Check if we have a page number in the _GET parameters
    if (!empty($_GET) && isset($_GET['page'])) {
        $page = (int)$_GET['page'];
    } else {
        $page = 1;
    }

    // Check that the page is within our bounds
    /*
    if ($page < 0) {
        $page = 1;
    } elseif ($page > $numberOfPages) {
        $page = $numberOfPages;
    }
    */

    //$users = get_users_paging($conn, $page, $countPerPage);
    include('views/view_dashboard.php');
} 


		
	        //redirect to user list
		//header("Location: index.php?controller=users"); 
		//exit();

    


