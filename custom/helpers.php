<?php

function jsAsset($path, $secure = false)
{
    return ($secure ? 'https' : 'http').'://localhost:8000/assets/'.$path;
}

function cssAsset($path, $secure = false)
{
    return ($secure ? 'https' : 'http').'://localhost:8000/assets/'.$path;
}

function imgAsset($path, $secure = false)
{
    return ($secure ? 'https' : 'http').'://localhost:8000/assets/node_modules/admin-lte/dist'.$path;
}