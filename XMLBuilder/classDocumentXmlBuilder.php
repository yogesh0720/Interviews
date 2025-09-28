<?php
include_once "interfaceDocumentBuilder.php";
//include_once "classNode.php";

class DocumentXmlBuilder implements DocumentBuilder
{
    private $indentation = 4;
    private $inlineMode = false;

    public function setIndentation(int $value)
    {
        $this->indentation = $value;
    }

    public function setInlineMode(bool $flag)
    {
        $this->inlineMode = $flag;
    }

    public function build($build)
    {
        return $build;
        return $this->generateXmlString($build, 0);
    }

    public function generateXmlString(Node $node, $level) {}
}
