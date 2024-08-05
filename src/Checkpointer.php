<?php

namespace Hsingh124\AmazonKinesisClientPhp;

use Hsingh124\AmazonKinesisClientPhp\messages\CheckpointInput;

class Checkpointer
{
    private IOHandler $ioHandler;

    public function __construct(IOHandler $ioHandler)
    {
        $this->ioHandler = $ioHandler;
    }

    private function getAction()
    {
        $line = $this->ioHandler->readLine();
        return $this->ioHandler->loadAction($line);
    }

    public function checkpoint(?string $sequenceNumber = null, ?string $subSequenceNumber = null)
    {
        $this->ioHandler->writeAction((object) [
            "action" => "checkpoint",
            "sequenceNumber" => $sequenceNumber,
            "subSequenceNumber" => $subSequenceNumber
        ]);

        $action = $this->getAction();

        if ($action instanceof CheckpointInput) {
            if (!is_null($action->error)) {
                throw new \Exception($action->error);
            }
        } else {
            throw new \Exception("InvalidStateException");
        }
    }
}