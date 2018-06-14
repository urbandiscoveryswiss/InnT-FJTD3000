<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Angebot</h1>
            <?php require_once 'Resources/Private/Partials/errors.php'; ?>
            <?php require_once 'Resources/Private/Partials/success.php'; ?>

            <form class="form-horizontal" method="POST" action="<?php echo $this->base_url?>/offer/create">

                <div class="form-group<?php echo isset($data['error']['title']) ? ' has-error' : '' ?>">
                    <label for="title" class="col-md-2 control-label">Titel *</label>

                    <div class="col-md-4">
                        <input id="title" type="text" class="form-control" name="title" value="<?php echo htmlentities((isset($data['input_data']['title'])?$data['input_data']['title']:'')); ?>" required autofocus>

                        <?php if(isset($data['error']['title'])) {
                            echo '<span class="help-block">
                                        <strong>' . (is_string($data['error']['title'])? $data['error']['title'] : $data['error']['title'][0]) . '</strong>
                                    </span>';
                        }?>
                    </div>
                </div>

                <div class="form-group<?php echo isset($data['error']['description']) ? ' has-error' : '' ?>">
                    <label for="description" class="col-md-2 control-label">Beschreibung</label>

                    <div class="col-md-4">
                        <textarea id="description" name="description"><?php echo (isset($data['input_data']['description'])?$data['input_data']['description']:''); ?></textarea>
                        <?php if(isset($data['error']['description'])) {
                            echo '<span class="help-block">
                                        <strong>' . (is_string($data['error']['description'])? $data['error']['description'] : $data['error']['description'][0]) . '</strong>
                                    </span>';
                        }?>
                    </div>
                </div>

                <div class="form-group<?php echo isset($data['error']['condition']) ? ' has-error' : '' ?>">
                    <label for="condition" class="col-md-2 control-label">Bedingungen</label>

                    <div class="col-md-4">
                        <textarea id="condition" name="condition"><?php echo (isset($data['input_data']['condition'])?$data['input_data']['condition']:''); ?></textarea>
                        <?php if(isset($data['error']['condition'])) {
                            echo '<span class="help-block">
                                        <strong>' . (is_string($data['error']['condition'])? $data['error']['condition'] : $data['error']['condition'][0]) . '</strong>
                                    </span>';
                        }?>
                    </div>
                </div>


                <div class="form-group<?php echo isset($data['error']['start']) ? ' has-error' : '' ?>">
                    <label for="start" class="col-md-2 control-label">Start</label>

                    <div class="col-md-4">
                        <input id="start" type="datetime-local" step="3600" class="form-control" name="start" value="<?php echo (isset($data['input_data']['start'])?$data['input_data']['start']:''); ?>">

                        <?php if(isset($data['error']['start'])) {
                            echo '<span class="help-block">
                                        <strong>' . (is_string($data['error']['start'])? $data['error']['start'] : $data['error']['start'][0]) . '</strong>
                                    </span>';
                        }?>
                    </div>
                </div>

                <div class="form-group<?php echo isset($data['error']['end']) ? ' has-error' : '' ?>">
                    <label for="end" class="col-md-2 control-label">Ende</label>

                    <div class="col-md-4">
                        <input id="end" type="datetime-local"  step="3600" class="form-control" name="end" value="<?php echo (isset($data['input_data']['end'])?$data['input_data']['end']:''); ?>" >

                        <?php if(isset($data['error']['end'])) {
                            echo '<span class="help-block">
                                        <strong>' . (is_string($data['error']['end'])? $data['error']['end'] : $data['error']['end'][0]) . '</strong>
                                    </span>';
                        }?>
                    </div>
                </div>




                <div class="form-group">
                    <div class="col-md-4 col-md-offset-2">
                        <button type="submit" class="btn btn-primary">
                            Speichern
                        </button>
                    </div>
                </div>

            </form>

        </div>
    </div>

</div>