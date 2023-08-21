<?php

namespace InktrapDesign\ModelLogger;
use Logtail\Monolog\LogtailHandler;
use Monolog\Logger;

class ModelObserver
{
    public function __construct()
    {
        $logtailLogger = new Logger("bs_demo");
        $logtailLogger->pushHandler(
            new LogtailHandler(env("LOGTAIL_SOURCE_TOKEN"))
        );

        $this->logger = $logtailLogger;
    }

    public function getClassName($model) {
        $class = get_class($model);
        $parts = explode('\\', $class);
        return end($parts);
    }

    public function updated($model)
    {
        $class = $this->getClassName($model);
        $this->logger->info("", [
            'action' => 'Updated',
            'type' => "$class::$model->id",
            'original' => $model->getOriginal(),
            'model' => $model->getAttributes()
        ]);
    }

    public function created($model)
    {
        $class = $this->getClassName($model);
        $this->logger->info("", [
            'action' => 'Created',
            'type' => "$class::$model->id",
            'model' => $model
        ]);
    }

    public function deleted($model)
    {
        $class = $this->getClassName($model);
        $this->logger->info("", [
            'action' => 'Deleted',
            'type' => "$class::$model->id",
            'model' => $model
        ]);
    }
}
