<?php
// Precess delete operation after confirmation
if (isset($_POST["id_pembelian"]) && !empty($_POST["id_pembelian"])) {
    // Include config file
    require_once "koneksi.php";

    // Prepare a delete statement
    $sql = "DELETE FROM fakhrudin WHERE id_pembelian = ?";

    if ($stmt = mysqli_prepare($conn, $sql)) {
        // Bind variables to the prepared statement as paramaters
        mysqli_stmt_bind_param($stmt, "i", $param_id);

        // Set parameters
        $param_id = trim($_POST["id_pembelian"]);

        // Attempt to execute the prepared statement
        if (mysqli_stmt_execute($stmt)) {
            // Records deleted successfully. Redirect to landing page
            header("location: index.php");
            exit();
        } else {
            echo "Oops! Something went wrong. Please try again later.";
        }
    }

    // Close statement
    mysqli_stmt_close($conn);

    // Close connection
    mysqli_close($conn);
} else {
    // Check existence of id parameter
    if (empty(trim($_GET["id_pembelian"]))) {
        // URL doesn't contain id parameter. Redirect to error page
        header("location: error.php");
        exit();
    }
}
?>
<!DOCTYPE html>
<meta charset="UTF-8">
<title>View Record</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/boostrap.css">
<!-- Favicon -->
<link rel="icon" type="image/x-icon" href="asset/img/logolur.svg">
<style type="text/css">
    .wrapper {
        width: 500px;
        margin: 0 auto;
    }
</style>
</head>

<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header">
                        <h1>Delete Data buku</h1>
                    </div>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="alert alert-danger fade in">
                            <input type="hidden" name="id_pembelian" value="<?php echo trim($_GET["id_pembelian"]); ?>" />
                            <h3>Are you sure you want to delete it?</h3><br>
                            <p>
                                <input style="font-size: 17px;color: whitesmoke; cursor: pointer; border-radius: 13px; height: 30px; width: 100px; background: red; border: none;" type="submit" value="Yes" class="btn btn-default">
                                <a style="margin-left: 30px;background: #C9BBCF; width: 100px;" href="index.php" class="btn btn-default">Cancel</a>
                            </p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>