<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Angebot</h1>
            <?php require_once 'Resources/Private/Partials/errors.php'; ?>
            <?php require_once 'Resources/Private/Partials/success.php'; ?>

            <div id="delete-confirm" title="Angebot löschen">
                <p>Möchten Sie das Angebot wirklich löschen?</p>
            </div>
            <a id="delete-opener" href="#">
                Angebot löschen
            </a>
            <script>

                $("#delete-confirm").dialog({
                    autoOpen: false,
                    resizable: false,
                    height: "auto",
                    width: 400,
                    modal: true,
                    buttons: {
                        "Bestätigen": function () {
                            document.getElementById('delete-form').submit();
                        },
                        Cancel: function () {
                            $(this).dialog("close");
                        }
                    }
                });

                $("#delete-opener").on("click", function () {

                    $("#delete-confirm").dialog("open");
                });
            </script>
            <form id="delete-form" action="<?php echo $this->base_url?>/offer/destroy/<?php echo $data['offer']->getId() ?>" method="POST" style="display: none;">
            </form>

            <div class="row">
                <label for="title" class="col-md-2 text-right">Titel</label>

                <div class="col-md-4 ">
                    <?php echo (isset($data['offer'])?$data['offer']->getTitle():''); ?>
                </div>
            </div>
            <div class="row">
                <label for="title" class="col-md-2 text-right">Beschreibung</label>

                <div class="col-md-4 ">
                    <?php echo (isset($data['offer'])?$data['offer']->getDescription():''); ?>
                </div>
            </div>
            <div class="row">
                <label for="title" class="col-md-2 text-right">Bedingungen</label>

                <div class="col-md-4 ">
                    <?php echo (isset($data['offer'])?$data['offer']->getCondition():''); ?>
                </div>
            </div>
            <div class="row">
                <label for="title" class="col-md-2 text-right">Start</label>

                <div class="col-md-4 ">
                    <?php echo (isset($data['offer'])?$data['offer']->getStart():''); ?>
                </div>
            </div>
            <div class="row">
                <label for="title" class="col-md-2 text-right">Ende</label>

                <div class="col-md-4 ">
                    <?php echo (isset($data['offer'])?$data['offer']->getEnd():''); ?>
                </div>
            </div>
        </div>
    </div>
</div>