<?php

declare(strict_types=1);

namespace App\Presentation\Service;

use JMS\Serializer\SerializerInterface;

class JmsSerializer implements DeserializesJson, SerializesToJson
{
    public function __construct(
        private SerializerInterface $jms,
    ) {
    }

    public function deserialize(string $json, string $type): mixed
    {
        return $this->jms->deserialize($json, $type, 'json');
    }

    public function serialize(mixed $data): string
    {
        return $this->jms->serialize($data, 'json');
    }
}
