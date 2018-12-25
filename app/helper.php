<?php

function editAlert($pm){
    session()->flash('editAlert', ['title' => $pm]);
}

function createAlert($pm){
    session()->flash('createAlert', ['title' => $pm]);
}