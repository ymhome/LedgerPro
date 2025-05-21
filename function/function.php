<?php

function e($name){
    return htmlspecialchars($name ?? '', ENT_QUOTES, 'UTF-8');
}