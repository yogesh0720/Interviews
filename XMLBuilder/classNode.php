<?php

class Node
{

    private $key = null;
    private $value = null;
    private $attributes = [];
    private $arrData = [];

    public function __construct(string $key, ?string $value = null)
    {
        $this->key = $key;
        $this->value = $value;
    }

    public function createNode(string $key, ?string $value = null)
    {
        $data = new Node($key, $value);
        $this->arrData[] = $data;
        return $data;
    }

    public function addAttribute(string $key, ?string $value = null)
    {
        $this->attributes[$key] = $value;
        return ($this);
    }

    public function getName(): string
    {
        return $this->key;
    }

    public function getValue(): ?string
    {
        return $this->value;
    }

    public function getAttributes(): array
    {
        return $this->attributes;
    }

    public function getChildren(): array
    {
        return $this->arrData;
    }

    public function hasChildren(): bool
    {
        return !empty($this->arrData);
    }
}
