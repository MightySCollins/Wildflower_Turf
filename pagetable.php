<?php
$limit = 3;
$adjacent = 3;

require_once("config/db.php");
require_once("config/config.php");

$con = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
if (mysqli_connect_errno() && $_SESSION['admin']) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

if (isset($_REQUEST['actionfunction']) && $_REQUEST['actionfunction'] != '') {
    $actionfunction = $_REQUEST['actionfunction'];

    call_user_func($actionfunction, $_REQUEST, $con, $limit, $adjacent);
}
function showData($data, $con, $limit, $adjacent)
{
    $page = $data['page'];
    if ($page == 1) {
        $start = 0;
    } else {
        $start = ($page - 1) * $limit;
    }
    $sql = "SELECT * FROM plants WHERE bed = '" . $_GET['bid'] . "'";
    $rows = $con->query($sql);
    $rows = $rows->num_rows;

    $sql = "SELECT * FROM plants WHERE bed = '" . $_GET['bid'] . "' limit $start,$limit";

    $data = $con->query($sql);
    $str = '<table class="table table-bordered table-hover table-striped"><thead><tr>';
    if ($_SESSION['admin']) $str .= '<td>ID</td>';
    $str .= '<td>Bed</td>
    <td>Location</td>
    <td>Product</td>
    <td>Sown</td>
    <td>QTY</td>
    <td>Available</td>
    <td>Edit</td></tr></thead><tbody>';

    if ($data->num_rows > 0) {
        while ($row = $data->fetch_array(MYSQLI_ASSOC)) {
            if ($_SESSION['admin']) echo '<td>' . $row['id'] . '</td>';
            $str .= '<tr>';

            if ($_SESSION['admin']) $str .= '<td>' . $row['id'] . '</td>';
            $str .= '<td>' . $row['bed'] . '</td>
                <td>' . $row['location'] . '</td>
                <td>' . $row['product'] . '</td>
                <td>';
            if ($row['sown'] <> '0000-00-00') echo $row['sown'];

            $str .= '</td><td>' . $row['qty'] . '</td>
                <td>' . $row['available'] . '</td>
                <td><a href="edit.php?id=' . $row['id'] . '">
                Edit</a> | <a href="notes.php?id=' . $row['id'] . '">Notes</a></td>
                </tr>';
        }
    } else {
        $str .= "<td colspan='5'>No Data Available</td>";
    }
    $str .= '</tbody></table>';

    echo $str;
    pagination($limit, $adjacent, $rows, $page);
}

function pagination($limit, $adjacents, $rows, $page)
{
    $pagination = '';
    if ($page == 0) $page = 1;                    //if no page var is given, default to 1.
    $prev = $page - 1;                            //previous page is page - 1
    $next = $page + 1;                            //next page is page + 1
    $prev_ = '';
    $first = '';
    $lastpage = ceil($rows / $limit);
    $next_ = '';
    $last = '';
    if ($lastpage > 1) {

        //previous button
        if ($page > 1)
            $prev_ .= "<a class='page-numbers' href=\"?page=$prev\">previous</a>";
        else {
            //$pagination.= "<span class=\"disabled\">previous</span>";
        }

        //pages
        if ($lastpage < 5 + ($adjacents * 2))    //not enough pages to bother breaking it up
        {
            $first = '';
            for ($counter = 1; $counter <= $lastpage; $counter++) {
                if ($counter == $page)
                    $pagination .= "<span class=\"current\">$counter</span>";
                else
                    $pagination .= "<a class='page-numbers' href=\"?page=$counter\">$counter</a>";
            }
            $last = '';
        } elseif ($lastpage > 3 + ($adjacents * 2))    //enough pages to hide some
        {
            //close to beginning; only hide later pages
            $first = '';
            if ($page < 1 + ($adjacents * 2)) {
                for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++) {
                    if ($counter == $page)
                        $pagination .= "<span class=\"current\">$counter</span>";
                    else
                        $pagination .= "<a class='page-numbers' href=\"?page=$counter\">$counter</a>";
                }
                $last .= "<a class='page-numbers' href=\"?page=$lastpage\">Last</a>";
            } //in middle; hide some front and some back
            elseif ($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2)) {
                $first .= "<a class='page-numbers' href=\"?page=1\">First</a>";
                for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++) {
                    if ($counter == $page)
                        $pagination .= "<span class=\"current\">$counter</span>";
                    else
                        $pagination .= "<a class='page-numbers' href=\"?page=$counter\">$counter</a>";
                }
                $last .= "<a class='page-numbers' href=\"?page=$lastpage\">Last</a>";
            } //close to end; only hide early pages
            else {
                $first .= "<a class='page-numbers' href=\"?page=1\">First</a>";
                for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++) {
                    if ($counter == $page)
                        $pagination .= "<span class=\"current\">$counter</span>";
                    else
                        $pagination .= "<a class='page-numbers' href=\"?page=$counter\">$counter</a>";
                }
                $last = '';
            }

        }
        if ($page < $counter - 1)
            $next_ .= "<a class='page-numbers' href=\"?page=$next\">next</a>";
        else {
            //$pagination.= "<span class=\"disabled\">next</span>";
        }
        $pagination = "<div class=\"pagination\">" . $first . $prev_ . $pagination . $next_ . $last;
        //next button

        $pagination .= "</div>\n";
    }

    echo $pagination;
}