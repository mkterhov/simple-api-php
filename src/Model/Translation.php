<?php

namespace App\Model;

class Translation
{

    private int $id;
    public string $english;
    public string $elvish;

    public function __construct(int $id, string $english, string $elvish)
    {
        $this->id = $id;
        $this->english = $english;
        $this->elvish = $elvish;
    }

    public function getId(): int
    {
        return $this->id;
    }
}