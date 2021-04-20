<?php

namespace App\BaseApp\Enums;

abstract class ProducerMessagesEnums
{
    const TOPIC_MISSING_ERROR_MESSAGE = 'Subject is not set';

    const FLUSH_ERROR_MESSAGE = 'librdkafka unable to perform flush, messages might be lost';
    const PUBLISH_ERROR_MESSAGE = 'Publish message to kafka failed';

}
