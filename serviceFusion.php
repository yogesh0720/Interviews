<?php

/**
 * Interface for document builders (e.g., XML, JSON in future)
 */
interface DocumentBuilder
{
    public function build(Node $root): string;
}

/**
 * Represents a document wrapper
 */
class Document
{
    private ?Node $root = null;

    public function createNode(string $name, ?string $value = null): Node
    {
        if ($this->root === null) {
            $this->root = new Node($name, $value);
            return $this->root;
        }
        throw new Exception("Root node already exists. Use root->createNode() for children.");
    }

    public function getRoot(): ?Node
    {
        return $this->root;
    }

    public function build(DocumentBuilder $builder): string
    {
        if (!$this->root) {
            throw new Exception("No root node defined for the document.");
        }
        return $builder->build($this->root);
    }
}

/**
 * Represents a single node in the document
 */
class Node
{
    private string $name;
    private ?string $value;
    private array $attributes = [];
    private array $children = [];

    public function __construct(string $name, ?string $value = null)
    {
        $this->name = $name;
        $this->value = $value;
    }

    public function createNode(string $name, ?string $value = null): Node
    {
        $child = new Node($name, $value);
        $this->children[] = $child;
        return $child;
    }

    public function addAttribute(string $name, string $value): self
    {
        $this->attributes[$name] = $value;
        return $this;
    }

    public function getName(): string
    {
        return $this->name;
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
        return $this->children;
    }

    public function hasChildren(): bool
    {
        return !empty($this->children);
    }
}

/**
 * XML implementation of DocumentBuilder
 */
class DocumentXmlBuilder implements DocumentBuilder
{
    private int $indentation = 2;
    private bool $inlineMode = false;

    public function setIndentation(int $spaces): void
    {
        $this->indentation = max(0, $spaces);
    }

    public function setInlineMode(bool $inline): void
    {
        $this->inlineMode = $inline;
    }

    public function build(Node $root): string
    {
        return $this->renderNode($root, 0);
    }

    private function renderNode(Node $node, int $level): string
    {
        $indent = $this->inlineMode ? '' : str_repeat(' ', $level * $this->indentation);
        $newline = $this->inlineMode ? '' : "\n";

        $attrs = '';
        foreach ($node->getAttributes() as $k => $v) {
            $attrs .= " {$k}=\"{$this->escape($v)}\"";
        }

        if (!$node->hasChildren() && $node->getValue() === null) {
            return "{$indent}<{$node->getName()}{$attrs} />{$newline}";
        }

        $opening = "{$indent}<{$node->getName()}{$attrs}>";
        $closing = "</{$node->getName()}>{$newline}";

        if ($node->hasChildren()) {
            $content = $newline;
            foreach ($node->getChildren() as $child) {
                $content .= $this->renderNode($child, $level + 1);
            }
            return $opening . $content . $indent . $closing;
        }

        $value = $this->escape($node->getValue() ?? '');
        return "{$opening}{$value}{$closing}";
    }

    private function escape(string $text): string
    {
        return htmlspecialchars($text, ENT_QUOTES | ENT_XML1, 'UTF-8');
    }
}

/**
 * Example usage
 */
$doc = new Document();
$root = $doc->createNode('root');

$head = $root->createNode('head');
$head->createNode('title', 'Items List');
$head->createNode('meta')->addAttribute('description', 'This is a List of Items');

$list = $root->createNode('list');

$item1 = $list->createNode('item');
$item1->createNode('title', 'Item 1');
$rates = $item1->createNode('rates')->addAttribute('is-taxable', 'true');
$rates->createNode('regular-rate')->addAttribute('value', '10.3');
$rates->createNode('member-rate')->addAttribute('value', '5.0');
$item1->createNode('description');

$item2 = $list->createNode('item');
$item2->createNode('title', 'Item 2');
$item2->createNode('description', 'This is a second Item without rates.');

$xmlBuilder = new DocumentXmlBuilder();
$xmlBuilder->setIndentation(4);
$xmlBuilder->setInlineMode(false);

echo $doc->build($xmlBuilder);
