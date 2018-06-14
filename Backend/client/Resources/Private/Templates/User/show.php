<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Konto</h1>
            <?php require_once 'Resources/Private/Partials/errors.php'; ?>
            <?php require_once 'Resources/Private/Partials/success.php'; ?>


            <div class="row">
                <label for="username" class="col-md-2 text-right">Benutzername</label>

                <div class="col-md-4 ">
                    <?php echo (isset($data['user'])?$data['user']->getUsername():''); ?>
                </div>
            </div>

            <div class="row">
                <label for="firstname" class="col-md-2 text-right">Vorname</label>

                <div class="col-md-4 ">
                    <?php echo (isset($data['user'])?$data['user']->getFirstname():''); ?>
                </div>
            </div>

            <div class="row">
                <label for="name" class="col-md-2 text-right">Nachname</label>

                <div class="col-md-4">
                    <?php echo (isset($data['user'])?$data['user']->getName():''); ?>
                </div>
            </div>

             <div class="row">
                <label for="address" class="col-md-2 text-right">Adresse</label>

                <div class="col-md-4">
                    <?php echo (isset($data['user'])?$data['user']->getAddress():''); ?>
                </div>
            </div>
            <div class="row">
                <label for="zip" class="col-md-2 text-right">PLZ</label>

                <div class="col-md-2">
                    <?php echo (isset($data['user'])?$data['user']->getZip():''); ?>
                </div>
            </div>

            <div class="row">
                <label for="city" class="col-md-2 text-right">Ort</label>

                <div class="col-md-4">
                    <?php echo (isset($data['user'])?$data['user']->getCity():''); ?>
                </div>
            </div>

            <div class="row">
                <label for="phone" class="col-md-2 text-right">Telefon</label>

                <div class="col-md-4">
                    <?php echo (isset($data['user'])?$data['user']->getPhone():''); ?>
                </div>
            </div>

            <div class="row">
                <label for="email" class="col-md-2 text-right">E-Mail</label>

                <div class="col-md-4">
                    <?php echo (isset($data['user'])?$data['user']->getEmail():''); ?>
                </div>
            </div>

            <div class="row">
                <label for="coordinates" class="col-md-2 text-right">Koordinaten</label>

                <div class="col-md-4">
                    <?php echo (isset($data['user'])?$data['user']->getCoordinates():''); ?>
                </div>
            </div>
            <br>

            <br>
            <?php if($data['editable']){
            echo '<div class="row">
                <div class="col-md-6 col-md-offset-2">
                    <a class="btn btn-primary" href="'.$this->base_url.'/user/edit">
    Bearbeiten
                    </a>
                </div>
            </div>';

                }?>

        </div>
    </div>

</div>
