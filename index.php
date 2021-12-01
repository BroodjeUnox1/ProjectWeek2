<?php
//start session for every page
session_start();
// setting the session values
$loggedin = $_SESSION['loggedin'] ?? NULL;
$username = $_SESSION['username'] ?? NULL;
$admin = $_SESSION['admin'] ?? NULL;
//forbidden pages list when not logged in
$forbidden = array("inschrijven", "inschrijvingen");
//to bypass the logout bugg and check for forbidden pages when nog logged in
if($_GET["content"] == "logout") {
    header("Refresh: 1, ./index.php?content=home");
} elseif(in_array($_GET['content'], $forbidden) && $loggedin == null) {
    header("Location: ./index.php?content=home");
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css"/>
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/default.min.css"/>
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/semantic.min.css"/>
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/bootstrap.min.css"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
          integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css">
    <link href="https://bootswatch.com/4/darkly/bootstrap.min.css" rel="stylesheet">
    <link type="text/css" href="css/index.css" rel="stylesheet">
    <link rel="shortcut icon" href="TemplateData/favicon.ico">
    <link rel="stylesheet" href="TemplateData/style.css">
    
    <title>Space opleiding</title>
</head>

<body>

<!-- if session error is set alert error -->
<?php if(!$loggedin && isset($_SESSION['err'])): ?>
<script type="text/javascript">
    alertify.error(<?= $_SESSION['err']?>);
</script>
<?php endif; ?>

<!-- if user is logged in give him a welkom message -->
<?php if($loggedin): ?>
<script type="text/javascript">
    alertify.success("Welkom");
</script>
<?php endif; ?>

    <!-- modal admin -->
    <div id="edit_modal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Edit data</h4>
                    <button type="button" class="close" onclick="toggle()">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <input type="hidden" id="edit_id">
                        <div class="col-md-6">
                            <label>bsn</label>
                            <input type="number" class="form-control" id="edit_bsn">
                        </div>
                        <div class="col-md-6">
                            <label>Email</label>
                            <input type="email" class="form-control" id="edit_email">
                        </div>
                        <div class="col-md-6">
                            <label>datum</label>
                            <input type="date" class="form-control" id="edit_datum">
                        </div>
                        <div class="col-md-6">
                            <label>tel</label>
                            <input type="number" class="form-control" id="edit_tel">
                        </div>
                        <div class="col-md-6">
                            <label>madeby</label>
                            <input type="text" class="form-control" id="edit_madeby">
                        </div>
                        <div class="col-md-6">
                            <label>approved</label>
                            <!-- <input type="select" class="form-control" id="edit_approved"> -->
                            <select class="form-control" id="edit_approved">
                                <option>ja</option>
                                <option>nee</option>
                                <option>nog niet</option>
                            </select>
                        </div>
                        <div class="col-md-12">
                            <button class="btn btn-success" style="float: right;margin-top: 7px" onclick="update()"><i class="fas fa-check"></i> Save data</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- modal user -->
    <div id="edit_modaluser" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Edit data</h4>
                    <button type="button" class="close" onclick="toggle2()">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <input type="hidden" id="edit_id_user">
                        <div class="col-md-6">
                            <label>bsn</label>
                            <input type="number" class="form-control" id="edit_bsn_user">
                        </div>
                        <div class="col-md-6">
                            <label>Email</label>
                            <input type="email" class="form-control" id="edit_email_user">
                        </div>
                        <div class="col-md-6">
                            <label>datum</label>
                            <input type="date" class="form-control" id="edit_datum_user">
                        </div>
                        <div class="col-md-6">
                            <label>tel</label>
                            <input type="number" class="form-control" id="edit_tel_user">
                        </div>
                        <div class="col-md-12">
                            <button class="btn btn-success" style="float: right;margin-top: 7px" onclick="updateuser()"><i class="fas fa-check"></i> Save data</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- content manager system -->
    <div class="wrapper" id="particles-js">
        <section class="container-fluid px-0 sticky-top">
            <div class="row">
                <div class="col-md-12"><?php include("./resources/contents/navbar.php"); ?></div>
            </div>
        </section>
        <section class="container-fluid px-0" style="min-height: 90vh;">
            <div class="row">
                <div class="col-12">
                    <?php include("resources/contents/content.php") ?>
                </div>
            </div>
        </section>
        <section class="container-fluid">
            <div class="row">
                <div class="col-12"><?php include("./resources/contents/footer.php"); ?></div>
            </div>
        </section>
    </div>
    <script src="./js/test.js"></script>
    <script src="js/index.js"></script>
    <script src="js/scroll.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
        crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
    integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6"
    crossorigin="anonymous"></script>
    <script src="TemplateData/UnityProgress.js"></script>
    <script src="Build/UnityLoader.js"></script>
    <script>
      var unityInstance = UnityLoader.instantiate("unityContainer", "Build/Nieuwe map (2).json", {onProgress: UnityProgress});
    </script>
</body>
</html>