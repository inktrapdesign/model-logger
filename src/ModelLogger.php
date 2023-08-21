<?php


namespace InktrapDesign\ModelLogger;

trait ModelLogger
{
    public static function bootModelLogger()
    {
        self::observe(new ModelObserver());
    }
}
