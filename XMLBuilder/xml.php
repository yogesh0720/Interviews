<?php
include_once "classDocument.php";
include_once "classDocumentXmlBuilder.php";

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

$xml =  $doc->build($xmlBuilder);
//echo "<pre>";
print_r($xml);
//echo "</pre>";
