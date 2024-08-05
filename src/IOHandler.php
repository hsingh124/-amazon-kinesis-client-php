<?php

namespace Hsingh124\AmazonKinesisClientPhp;

class IOHandler
{
    private mixed $inputStream;
    private mixed $outputStream;
    private mixed $errorStream;

    public function __construct(mixed $inputStream = STDIN, mixed $outputStream = STDOUT, mixed $errorStream = STDERR)
    {
        $this->inputStream = $inputStream;
        $this->outputStream = $outputStream;
        $this->errorStream = $errorStream;
    }

    public function readLine()
    {
        return fgets($this->inputStream);
    }

    public function writeLine(string $line)
    {
        fwrite($this->outputStream, $line . PHP_EOL);
    }

    public function writeError(string $error)
    {
        fwrite($this->errorStream, $error . PHP_EOL);
        // should we flush here?
    }

    public function loadAction(string $line)
    {
        return json_decode($line);
    }

    public function writeAction(object $action)
    {
        $this->writeLine(json_encode($action));
    }
}