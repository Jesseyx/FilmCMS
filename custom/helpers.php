<?php

function jsAsset($path, $secure = false)
{
    return ($secure ? 'https' : 'http').'://assets.mj.kankan.com/'.$path;
}

function cssAsset($path, $secure = false)
{
    return ($secure ? 'https' : 'http').'://assets.mj.kankan.com/'.$path;
}

function imgAsset($path, $secure = false) {
    return ($secure ? 'https' : 'http').'://images.mj.kankan.com/'.$path;
}