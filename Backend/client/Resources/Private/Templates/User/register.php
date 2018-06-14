<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <?php require_once 'Resources/Private/Partials/errors.php'; ?>
            <div class="panel panel-default">
                <div class="panel-heading">Registrieren</div>

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="<?php echo $this->base_url?>/user/create">


                        <div class="form-group<?php echo isset($data['error']['username']) ? ' has-error' : '' ?>">
                            <label for="username" class="col-md-4 control-label">Benutzername *</label>

                            <div class="col-md-6">
                                <input id="username" type="text" class="form-control" name="username" value="<?php echo htmlentities((isset($data['input_data']['username'])?$data['input_data']['username']:'')); ?>" required autofocus>

                                <?php if(isset($data['error']['username'])) {
                                    echo '<span class="help-block">
                                        <strong>' . (is_string($data['error']['username'])? $data['error']['username'] : $data['error']['username'][0]) . '</strong>
                                    </span>';
                                }?>
                            </div>
                        </div>

                        <div class="form-group<?php echo isset($data['error']['firstname']) ? ' has-error' : '' ?>">
                            <label for="firstname" class="col-md-4 control-label">Vorname *</label>

                            <div class="col-md-6">
                                <input id="firstname" type="text" class="form-control" name="firstname" value="<?php echo htmlentities((isset($data['input_data']['firstname'])?$data['input_data']['firstname']:'')); ?>" required>

                                <?php if(isset($data['error']['firstname'])) {
                                    echo '<span class="help-block">
                                        <strong>' . (is_string($data['error']['firstname'])? $data['error']['firstname'] : $data['error']['firstname'][0]) . '</strong>
                                    </span>';
                                }?>
                            </div>
                        </div>

                        <div class="form-group<?php echo isset($data['error']['name']) ? ' has-error' : '' ?>">
                            <label for="name" class="col-md-4 control-label">Nachname *</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="<?php echo htmlentities((isset($data['input_data']['name'])?$data['input_data']['name']:'')); ?>" required>

                                <?php if(isset($data['error']['name'])) {
                                    echo '<span class="help-block">
                                        <strong>' . (is_string($data['error']['name'])? $data['error']['name'] : $data['error']['name'][0]) . '</strong>
                                    </span>';
                                }?>
                            </div>
                        </div>

                        <div class="form-group<?php echo isset($data['error']['address']) ? ' has-error' : '' ?>">
                            <label for="address" class="col-md-4 control-label">Adresse</label>

                            <div class="col-md-6">
                                <input id="address" type="text" class="form-control" name="address" value="<?php echo htmlentities((isset($data['input_data']['address'])?$data['input_data']['address']:'')); ?>">

                                <?php if(isset($data['error']['address'])) {
                                    echo '<span class="help-block">
                                        <strong>' . (is_string($data['error']['address'])? $data['error']['address'] : $data['error']['address'][0]) . '</strong>
                                    </span>';
                                }?>
                            </div>
                        </div>
                        <div class="form-group<?php echo isset($data['error']['zip']) ? ' has-error' : '' ?>">
                            <label for="zip" class="col-md-4 control-label">PLZ</label>

                            <div class="col-md-2">
                                <input id="zip" type="text" class="form-control" name="zip" value="<?php echo htmlentities((isset($data['input_data']['zip'])?$data['input_data']['zip']:'')); ?>" >

                                <?php if(isset($data['error']['zip'])) {
                                    echo '<span class="help-block">
                                        <strong>' . (is_string($data['error']['zip'])? $data['error']['zip'] : $data['error']['zip'][0]) . '</strong>
                                    </span>';
                                }?>
                            </div>
                        </div>

                        <div class="form-group<?php echo isset($data['error']['city']) ? ' has-error' : '' ?>">
                            <label for="city" class="col-md-4 control-label">Ort</label>

                            <div class="col-md-6">
                                <input id="city" type="text" class="form-control" name="city" value="<?php echo htmlentities((isset($data['input_data']['city'])?$data['input_data']['city']:'')); ?>">

                                <?php if(isset($data['error']['city'])) {
                                    echo '<span class="help-block">
                                        <strong>' . (is_string($data['error']['city'])? $data['error']['city'] : $data['error']['city'][0]) . '</strong>
                                    </span>';
                                }?>
                            </div>
                        </div>

                        <div class="form-group<?php echo isset($data['error']['phone']) ? ' has-error' : '' ?>">
                            <label for="phone" class="col-md-4 control-label">Telefon</label>

                            <div class="col-md-6">
                                <input id="phone" type="text" class="form-control" name="phone" value="<?php echo htmlentities((isset($data['input_data']['phone'])?$data['input_data']['phone']:'')); ?>">

                                <?php if(isset($data['error']['phone'])) {
                                    echo '<span class="help-block">
                                        <strong>' . (is_string($data['error']['phone'])? $data['error']['phone'] : $data['error']['phone'][0]) . '</strong>
                                    </span>';
                                }?>
                            </div>
                        </div>

                        <div class="form-group<?php echo isset($data['error']['email']) ? ' has-error' : '' ?>">
                            <label for="email" class="col-md-4 control-label">E-Mail *</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="<?php echo htmlentities((isset($data['input_data']['email'])?$data['input_data']['email']:'')); ?>" required>

                                <?php if(isset($data['error']['email'])) {
                                    echo '<span class="help-block">
                                        <strong>' . (is_string($data['error']['email'])? $data['error']['email'] : $data['error']['email'][0]) . '</strong>
                                    </span>';
                                }?>
                            </div>
                        </div>

                        <div class="form-group<?php echo isset($data['error']['email']) ? ' has-error' : '' ?>">
                            <label for="coordinates" class="col-md-4 control-label">Koordinaten</label>

                            <div class="col-md-6">
                                <input id="coordinates" type="text" class="form-control" name="coordinates" value="<?php echo (isset($data['input_data']['coordinates'])?$data['input_data']['coordinates']:''); ?>">
                                <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB1CgOyUKBCsTG5-zuf08cPXbY5kD9aiEk"></script>



                                <a onclick="generateCoords(event)" href="#">Aus Adresse generieren</a> oder durch klicken auf Karte.



                                <div id="map-canvas" style="height: 400px; width: 100%; position: relative; overflow: hidden;"></div>

                                <script>
                                    var geocoder;
                                    var map;
                                    var marker;
                                    function initialize() {
                                        geocoder = new google.maps.Geocoder();

                                        // Zentrum (wird mit bounds ueberschrieben)
                                        var latlng = new google.maps.LatLng(46.802282, 8.084804);

                                        var mapOptions = {
                                            zoom: 7,
                                            disableDefaultUI:true,
                                            center: latlng,
                                            scrollwheel: false,
                                            streetViewControl: true,
                                            streetViewControlOptions: {
                                                position: google.maps.ControlPosition.LEFT_BOTTOM
                                            },
                                            zoomControl: true,
                                            zoomControlOptions: {
                                                position: google.maps.ControlPosition.LEFT_BOTTOM
                                            },
                                        }
                                        map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);

                                        var styles = "";
                                        var styledMap = new google.maps.StyledMapType(styles,{name: "Styled Map"});
                                        map.mapTypes.set('map_style', styledMap);
                                        map.setMapTypeId('map_style');

                                        if($("#coordinates").val() != ''){
                                            var latLng = $("#coordinates").val().split(",");
                                            var latitude = parseFloat(latLng[0]);
                                            var longitude = parseFloat(latLng[1]);
                                            var location = new google.maps.LatLng(latitude, longitude)
                                            placeMarker(location);
                                            map.setCenter(location);
                                            map.setZoom(14);
                                        }
                                        google.maps.event.addListener(map, 'click', function(event) {
                                            placeMarker(event.latLng);
                                        });
                                    }

                                    google.maps.event.addDomListener(window, 'load', initialize);



                                    function placeMarker(location) {
                                        if (marker == undefined){
                                            marker = new google.maps.Marker({
                                                position: location,
                                                map: map,
                                                animation: google.maps.Animation.DROP,
                                            });
                                        }
                                        else{
                                            marker.setPosition(location);
                                        }

                                        $("#coordinates").val(location.toString().replace(/^\((.+)\)$/,"$1"))
                                        //map.setCenter(location);
                                    }

                                    function generateCoords(e) {
                                        e.preventDefault();

                                        var address = document.getElementById('address').value + ", "+ document.getElementById('zip').value + " " + document.getElementById('city').value;
                                        geocoder.geocode( { 'address': address}, function(results, status) {
                                            if (status == google.maps.GeocoderStatus.OK) {
                                                map.setCenter(results[0].geometry.location);
                                                if (marker == undefined){
                                                    marker = new google.maps.Marker({
                                                        map: map,
                                                        position: results[0].geometry.location
                                                    });
                                                }
                                                else{
                                                    marker.setPosition(results[0].geometry.location);
                                                }
                                                $("#coordinates").val(results[0].geometry.location.toString().replace(/^\((.+)\)$/,"$1"))
                                            } else {
                                                alert('Geocode was not successful for the following reason: ' + status);
                                            }
                                        });
                                    }
                                </script>


                                <?php if(isset($data['error']['coordinates'])) {
                                    echo '<span class="help-block">
                                        <strong>' . (is_string($data['error']['coordinates'])? $data['error']['coordinates'] : $data['error']['coordinates'][0]) . '</strong>
                                    </span>';
                                }?>
                            </div>
                        </div>


                        <div class="form-group<?php echo isset($data['error']['password']) ? ' has-error' : '' ?>">
                            <label for="password" class="col-md-4 control-label">Passwort *</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" value="<?php echo htmlentities((isset($data['input_data']['password'])?$data['input_data']['password']:'')); ?>" required>

                                <?php if(isset($data['error']['password'])) {
                                    echo '<span class="help-block">
                                        <strong>' . (is_string($data['error']['password'])? $data['error']['password'] : $data['error']['password'][0]) . '</strong>
                                    </span>';
                                }?>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password_confirm" class="col-md-4 control-label">Passwort wiederholen *</label>

                            <div class="col-md-6">
                                <input id="password_confirm" type="password" class="form-control" name="password_confirm" value="<?php echo htmlentities((isset($data['input_data']['password_confirm'])?$data['input_data']['password_confirm']:'')); ?>" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Registrieren
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
