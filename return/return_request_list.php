<?php
session_start();
require_once "../config.php";
require_once ROOT . "functions/Connection.php";
require_once ROOT . "functions/Session.php";
include_once ROOT . "functions/redirect.php";
require_once ROOT . "settings.php";

require_once "ReturnManager.php";

$sessUserId = (isset($_SESSION['sess_user_id']) ? $_SESSION['sess_user_id'] : 0);
$isLogged = $sessUserId;

// pagination script
$page = (isset($_GET['page'])) ? intval($_GET['page']) : 1;
$limit = 30;//ReturnManager::getPageLimit(); // No. of page try to display
$start = $page ? ($page - 1) * $limit : 0; //first item to display on this page

//echo $isLogged;
if (!$isLogged) {
    redirectPage("../login.php?url=return/index.php");
}

$returnRequestArr = ReturnManager::getReturnRequestListByCustomerId($sessUserId, $start, $limit); // get customer transaction info

?>

<?php if ($returnRequestArr) { // if has data ?>
    <table class="data-table data-table-indent" style="width: 100%;">
        <tbody>
        <?php

        // load all customer return request information
        if (!empty($returnRequestArr)) {
            echo '<tr>
                        <th>Return ID</th>
                        <th>Order ID</th>
                        <th>Customer Name</th>
                        <th>Added Date</th>
                        <th>Status</th>
                        <th style="text-align: center;">Action</th>
                    </tr>';
            $counter = 1;

            foreach ($returnRequestArr as $returnRequest) {
                ?>
                <tr>
                    <td>#<?php echo $returnRequest['return_id']; ?></td>
                    <td>#<?php echo $returnRequest['order_id']; ?></td>
                    <td><?php echo $returnRequest['firstname']; ?></td>
                    <td><?php echo $returnRequest['date_added']; ?></td>
                    <td><?php echo $returnRequest['status_name']; ?></td>

                    <td style="text-align: center;"><a href="../order/order_details.php?from=return_list&type=view&order_id=<?php echo $returnRequest['order_id']; ?>">Details</a> </td>
                </tr>
            <?php
            }
        }
        ?>
        </tbody>
    </table>
<?php
} else {
    echo "<div class='alert alert-info' style='margin-bottom: 200px;'>There are no return requests list available now.</div>";
}
?>
<?php ReturnManager::shoReturnRequestPagination($page, $sessUserId, ""); //pagination ?>
