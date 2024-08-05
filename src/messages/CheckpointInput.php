<?php

namespace Hsingh124\AmazonKinesisClientPhp\messages;

class CheckpointInput
{
    public ?string $sequenceNumber;
    public ?string $subSequenceNumber;
    public ?string $error;
}