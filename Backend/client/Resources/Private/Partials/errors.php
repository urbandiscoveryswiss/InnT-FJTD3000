<?php

if(isset($data['error']) && isset($data['error']['message'])){
    echo '<div class="alert alert-dismissable alert-danger">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    ';
    $errors = $data['error']['message'];
    if(is_array($errors)){
        foreach($errors as $error){
            echo '<li><strong>'.$error.'</strong></li>';
        }
    }else{
        echo '<li><strong>'.$errors.'</strong></li>';
    }

    echo '</div>';
};

