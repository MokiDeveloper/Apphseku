<?php
function sweetalert($data = []){
    return [
        'sweet_title' => $data[0],
        'sweet_text' => $data[1],
        'sweet_type' => $data[2]
    ];
}