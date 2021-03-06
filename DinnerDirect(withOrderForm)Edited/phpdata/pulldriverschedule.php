<?php

require_once('databasephp.php');
$connection = connectToDb();
session_start();

//$srch_term = $_GET['srch-term'] ?? '1'; //PHP 7.0
//$srch= $_GET['srch-term'] ?? '1'; //dataphp 7.0
//echo "$srch";

$driverIDpullorderdatainstance=$_SESSION['driverID'];//$y is any declared variable
//echo $driverIDpullorderdatainstance; //for debugging


$query = "SELECT driv.first_name, driv.last_name, sch.schoolname, ord.orderitemID, ord.DateOrdered, ordspec.time_date, ord.amountPaid FROM orders ord
JOIN drivers driv /*alias of cus for customer*/
    on ord.driverID = driv.driverID
JOIN ordersthis ordspec /*alias of cus for customer*/
    on ord.orderID = ordspec.order_ID
JOIN customers cus /*alias of cus for customer*/
    on ord.customerID = cus.customerID
JOIN schools sch /*alias of cus for customer*/
    on cus.schoolID = sch.schoolID
WHERE ord.driverID = '" . $driverIDpullorderdatainstance."'
";


//search database
//check if the variable has not been initalized
$result = mysqli_query($connection, $query);
$result2 = mysqli_query($connection, $query);

if (empty($result)){
    exit("databasePhp query failed, the result does not exist.");
}

// Close the connection
mysqli_close($connection);
?>



<html>
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Welcome to Dinners Direct</title>

    <!-- Bootstrap core CSS -->
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="../css/shop-homepage.css" rel="stylesheet">

</head>

<body>

<!-- Navigation -->
<!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
        <a class="navbar-brand" href="../index.html">Dinners Direct</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="index.html" collapse="navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="../index.html">Home
                        <span class="sr-only">(current)</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../about.html">About</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="pullorderdata.php">MyAccount</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="../createnewaccount.html">Create Account</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="../order.php">Order</a>
                    <!--<a class="nav-link text-uppercase text-expanded" href="products.html">Products</a>!-->
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="logOut.php">Log Out</a>
                    <!--<a class="nav-link text-uppercase text-expanded" href="products.html">Products</a>!-->
                </li>
            </ul>
        </div>
    </div>
</nav>


<!-- Page Content -->
<div class="container">
    <h1> Driver information</h1>

    <table class="table" >
        <tr>
            <th>Name</th>
        </tr>
        <tr>
            <td><?php
            $names=($result2->fetch_assoc()); //instance var to just get the first and last name
                    echo $names['first_name']. " ".$names['last_name'] ?></td>

        </tr>


        <tr>
            <th>School name</th>
            <th>Date ordered</th>
            <th>Delivery date</th>
            <th>Amount paid</th>
        </tr>
        <?php  while( $user=mysqli_fetch_assoc($result)){ ?>
        <tr>
            <td><?php print_r($user['schoolname']) ?> </td>
            <td><?php echo $user['DateOrdered'] ?></td>
            <td><?php echo $user['time_date'] ?></td>
            <td><?php echo $user['amountPaid'] ?></td>
        </tr>

<? }?>
    </table>
    <div class="row">

    </div>
    <?php
    // Free the results from memory
    //unset all variables
//at the start of every page runs that code
    mysqli_free_result($result);
    mysqli_free_result($result2);

    //session_destroy();

    ?>

</div>


<!-- /.container -->


<!-- Bootstrap core JavaScript -->
<script src="../vendor/jquery/jquery.min.js"></script>
<script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

</body>
</html>


