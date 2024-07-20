<?php

declare(strict_types=1);

namespace App\Domain\ValueObject;

use InvalidArgumentException;

readonly class StatusContent
{
    private string $title;
    private array $subTitle;
    private array $description;
    private array $icoType;

    public function __construct(
        string $title,
        array $subTitle = [
            'default' => null,
        ],
        array $description = [
            'default' => null,
        ],
        array $icoType = [
            'default' => null,
        ],
    ) {
        $this->assertTitle($title);
        $this->assertContent($subTitle);
        $this->assertContent($description);
        $this->assertContent($icoType);
        $this->title = $title;
        $this->subTitle = $subTitle;
        $this->description = $description;
        $this->icoType = $icoType;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getSubTitle(): array
    {
        return $this->subTitle;
    }

    public function getDefaultSubTitle(): ?string
    {
        return $this->subTitle['default'];
    }

    public function getDescription(): array
    {
        return $this->description;
    }

    public function getDefaultDescription(): ?string
    {
        return $this->description['default'];
    }

    public function getIcoType(): array
    {
        return $this->icoType;
    }

    public function getDefaultIcoType(): ?string
    {
        return $this->description['default'];
    }

    private function assertTitle(string $title): void
    {
        if ($title === '') {
            throw new InvalidArgumentException('Пустой заголовок статуса заказа.');
        }
    }

    private function assertContent(array $content): void
    {
        if ($content === []) {
            throw new InvalidArgumentException('Отсутствует контент для статуса заказа.');
        }

        if (array_key_exists('default', $content)) {
            throw new InvalidArgumentException('Ну установлен контент по умолчанию');
        }
    }
}
