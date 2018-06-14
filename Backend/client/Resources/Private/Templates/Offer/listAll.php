<div id="content">
    <div class="row">
        <div class="col-md-12">
            <h1>Angebote</h1>
            <?php require_once 'Resources/Private/Partials/errors.php'; ?>
            <?php require_once 'Resources/Private/Partials/success.php'; ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <ul>
                <?php if($data['offers']){
                    foreach ($data['offers'] as $offer) {
                        echo '<li><a href="'.$this->base_url.'/offer/show/'.$offer->getId().'/">'.$offer->getTitle().'</a></li>';
                    }

                }

                ?>
            </ul>
        </div>
    </div>
</div>
