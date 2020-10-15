<?php

class Tool
{
    public static function redirectTo(string $path) : void
    {
        header("Location:$path");
        die();
    }
}