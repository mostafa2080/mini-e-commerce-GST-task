<?php

function generateImageLinks($directory, $items)
{
    return $items->map(function ($item) use ($directory) {
        $item->image = asset("upload/$directory/$item->image");
        return $item;
    });
}
