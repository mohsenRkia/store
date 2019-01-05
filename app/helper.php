<?php

function editAlert($pm){
    session()->flash('editAlert', ['title' => $pm]);
}

function createAlert($pm){
    session()->flash('createAlert', ['title' => $pm]);
}

function warningAlert($pm){
    session()->flash('warningAlert', ['title' => $pm]);
}