<!DOCTYPE html>
<html lang="de">
<head>
    <?php include('head.php') ?>
</head>
<body>
<div id="app" class="container-fluid">
    <div class="row">
        <div class="col-sm-4 col-lg-3">
            <nav class="navbar navbar-default navbar-fixed-side">
                <div class="container">
                    <div class="navbar-header">

                        <!-- Collapsed Hamburger -->
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse" aria-expanded="false">
                            <span class="sr-only">Toggle Navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>

                        <!-- Branding Image -->

                        <div class="navbar-brand">
                            Eingeloggt als:<br>
                            <?php echo htmlentities($_SESSION['username']) ?>
                        </div>
                    </div>

                    <div class="collapse navbar-collapse" id="app-navbar-collapse">
                        <ul class="nav navbar-nav">
                            <!-- Authentication Links -->
                            <li>

                                <ul>
                                    <li>
                                        <a href="<?php echo $this->base_url?>/user/show">
                                            Profil
                                        </a>
                                    </li>

                                    <li>
                                        <a href="<?php echo $this->base_url?>/offer/add">
                                            Neu
                                        </a>
                                    </li>

                                    <li>
                                        <a href="<?php echo $this->base_url?>/offer/listAll">
                                            Bearbeiten
                                        </a>
                                    </li>

                                    <li>
                                        <div id="logout-confirm" title="Logout">
                                            <p>Möchten Sie sich wirklich abmelden?</p>
                                        </div>
                                        <a id="logout-opener" href="#">
                                            Logout
                                        </a>
                                        <script>

                                            $("#logout-confirm").dialog({
                                                autoOpen: false,
                                                resizable: false,
                                                height: "auto",
                                                width: 400,
                                                modal: true,
                                                buttons: {
                                                    "Abmelden": function () {
                                                        document.getElementById('logout-form').submit();
                                                    },
                                                    Cancel: function () {
                                                        $(this).dialog("close");
                                                    }
                                                }
                                            });

                                            $("#logout-opener").on("click", function () {

                                                $("#logout-confirm").dialog("open");
                                            });
                                        </script>
                                        <form id="logout-form" action="<?php echo $this->base_url?>/user/logout" method="POST" style="display: none;">
                                        </form>

                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </div>
        <div class="col-sm-8 col-lg-9">
            <?php $this->content() ?>
        </div>
    </div>
</div>

<!-- Scripts -->

</body>
</html>
