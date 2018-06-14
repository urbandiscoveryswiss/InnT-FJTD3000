<?php

if(isset($data['success'])){
    echo '<div class="alert alert-dismissable alert-success">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    ';
    echo '<li><strong>'. $data['success'].'</strong></li>';


    echo '</div>';
};
