<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <?php require_once 'Resources/Private/Partials/errors.php'; ?>
            <?php require_once 'Resources/Private/Partials/success.php'; ?>
            <div class="panel panel-default m-t-lg">
                <div class="panel-heading">Login</div>

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="<?php echo $this->base_url?>/user/login">

                        <div class="form-group <?php echo isset($data['error']['email']) ? ' has-error' : '' ?>">
                            <label for="email" class="col-md-4 control-label">Benutzername</label>

                            <div class="col-md-6">
                                <input id="email" type="text" class="form-control" name="email" value="<?php echo (isset($data['input_data']['email'])?$data['input_data']['email']:''); ?>" required autofocus>
                                <?php if(isset($data['error']['email'])) {
                                    echo '<span class="help-block">
                                        <strong>' . (is_string($data['error']['email'])? $data['error']['email'] : $data['error']['email'][0]) . '</strong>
                                    </span>';
                                }?>
                            </div>
                        </div>

                        <div class="form-group<?php echo isset($data['error']['password']) ? ' has-error' : '' ?>">
                            <label for="password" class="col-md-4 control-label">Passwort</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" value="" name="password" required>

                                <?php if(isset($data['error']['password'])) {
                                    echo '<span class="help-block">
                                        <strong>' . (is_string($data['error']['password'])? $data['error']['password'] : $data['error']['password'][0]) . '</strong>
                                    </span>';
                                }?>
                            </div>
                        </div>


                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Login
                                </button>
                            </div>
                        </div>
                        <hr>
                        <div class="form-group">
                            <div class="col-md-12">
                                <a class="btn btn-link" href="<?php echo $this->base_url?>/user/register">
                                    Registrieren
                                </a>
                            </div>
                        </div>


                    </form>

                </div>
            </div>
        </div>
    </div>
</div>