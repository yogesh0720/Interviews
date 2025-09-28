<?php
include_once "classNode.php";

class Document
{

    private $root = null;

    public function __construct()
    {
        return "Document created";
    }

    public function createNode(string $key, ?string $value = null)
    {
        if ($this->root === null) {
            $this->root = new Node($key, $value);
            return $this->root;
        }
        throw new Exception("Root node already exists. Use root->createNode() for children.");
    }

    public function build($build)
    {
        if (!$this->root) {
            throw new Exception("No root node defined for the document.");
        }
        return $build->build($this->root);
    }
}
