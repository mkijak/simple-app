<?php

declare(strict_types=1);

namespace App\Presentation\Service;

class ApiModelsProvider implements ProvidesApiModels
{
    public function __construct(
        private DeserializesJson $jsonDeserializer,
        private ValidatesApiDto $validator,
    ) {
    }

    public function load(string $body, string $class): ?object
    {
        if (!$model = $this->jsonDeserializer->deserialize($body, $class)) {
            return null;
        }

        $this->validator->validate($model);

        return $model;
    }
}
