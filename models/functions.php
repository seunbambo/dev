<?php


function paging($controller, $model)
{
    $controller = $_GET['controller'];
    $model = $controller . '.php';
    $limit = 10;
    if (isset($_GET['count'])) {
        $page = $_GET["count"];
    } else {
        $page = 10;
    }
    $start_from = ($page - 1) * $limit;

    echo '<div class="paging">
    <div class="container">
        <div class="row">
            <div class="col-md-12">';

    $page = @$_GET['page'];
    if ($page == 0 || $page == 1) {
        @$page = 0;
    } else {
        $page1 = ($page * 4) - 4;
    }

    echo '</div>
            <ul class="pagination">';

    include 'models/' . $model;
    $links = 5;
    $last = round($rowcount / $limit);
    $start = (($page - $links) > 0) ? $page - $links : 1;
    $end = (($page + $links) < $last) ? $page + $links : $last;
    $class = ($page == 1) ? "disabled" : "";
    $previous_page = ($page > 1) ?
        '<li class="' . $class . '"><a class="page-link" href="index.php?controller=' . $controller . '&count=10&offset=' . (10 * ($page - 1)) . '&page=' . ($page - 1) . '">&laquo;</a></li>' : '<li class="page-link page-item disabled">&laquo;</li>';
    echo $previous_page;

    if ($start > 1) {
        echo '<li class="page-item"><a class="page-link" href="index.php?controller=' . $controller . '&count=' . 10 . '&page=' . 1 . '">' . 1 . '</a></li>';
        echo '<li class="disabled"><span>...</span></li>';
    }


    for ($i = $start; $i <= $end; $i++) {
        $class = ($page == $i) ? "active" : "";
        echo '<li class="page-item ' . $class . '"><a class="page-link" href="index.php?controller=' . $controller . '&count=10&offset=' . ($i * 10) . '&page=' . $i . '">' . $i . '</a></li>';
    }
    if ($end < $last) {
        echo '<li class="page-item disabled"><span>...</span></li>';
        echo '<li class="page-item"><a class="page-link" href="index.php?controller=' . $controller . '&count=10&offset=' . ($last * 10) . '&page=' . $last . '">' . $last . '</a></li>';
    }
    $next_page = ($page < $last) ? '<li class="' . $class . '"><a class="page-link" href="index.php?controller=' . $controller . '&count=10&offset=' . (10 * ($page + 1)) . '&page=' . ($page + 1) . ' ">&raquo;</a></li>' : '<li class=" page-link page-item disabled">&raquo;</li>';
    echo $next_page;
    echo '</ul>

        </div>
    </div>
</div>';
}
