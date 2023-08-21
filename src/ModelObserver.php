<?php

namespace InktrapDesign\ModelLogger;
use Logtail\Monolog\LogtailHandler;
use Monolog\Logger;

class ModelObserver
{
    public function __construct()
    {
        try {
            $logtailLogger = new Logger(env('LOGGER_CHANNEL', 'default'));
            $logtailLogger->pushHandler(
                new LogtailHandler(env("LOGGER_SOURCE"))
            );
        } catch (\Exception $e) {
            $logtailLogger = null;
        }

        $this->logger = $logtailLogger;
    }

    public function getClassName($model)
    {
        $class = get_class($model);
        $parts = explode('\\', $class);
        return end($parts);
    }

    public function createLog($payload, $message = "")
    {
        try {
            $this->logger->info($message, $payload);
        } catch (\Exception $e) {}
    }

    public function updated($model)
    {
        $class = $this->getClassName($model);
        $this->createLog([
            'action' => '[Updated]',
            'type' => "[$class::$model->id]",
            'original' => $model->getOriginal(),
            'model' => $model->getAttributes()
        ], "$class has been updated");
    }

    public function created($model)
    {
        $class = $this->getClassName($model);
        $this->createLog([
            'action' => '[Created]',
            'type' => "[$class::$model->id]",
            'model' => $model
        ], "$class has been created");
    }

    public function deleted($model)
    {
        $class = $this->getClassName($model);
        $this->createLog([
            'action' => '[Deleted]',
            'type' => "[$class::$model->id]",
            'model' => $model
        ], "$class has been deleted");
    }
}
