Create a simple document builder in pure PHP, adhering to OOP principles. You must not use any external libraries (e.g., DOMDocument, SimpleXML, or XMLWriter). Your task is to design classes that allow the creation of structured documents programmatically.

Design your code with future extensibility in mind — for example, supporting additional output formats (e.g., JSON), writing to different storage backends, or integrating features like logging and benchmarking in later versions.

For this task, only XML output to the console is required.

Here is an example of how your class should be used:

$doc = new Document();
$root = $doc->createNode('root');

$head = $root->createNode('head');
$head->createNode('title', 'Items List');
$head->createNode('meta')->addAttribute('description', 'This is a List of Items');

$list = $root->createNode('list');
...

$xmlBuilder = new DocumentXmlBuilder();
$xmlBuilder->setIndentation(4); // number of spaces per indentation level
$xmlBuilder->setInlineMode(false);

echo $doc->build($xmlBuilder);

Expected Output:

<root>
<head>
    		<title>Items List</title>
    	<meta description="This is a List of Items"/>
	</head>
	<list>
    		<item>
        	<title>Item 1</title>
        	<rates is-taxable="true">
            			<regular-rate value="10.3" />
            	<member-rate value="5.0" />
        	</rates>
        	<description />
    	</item>
    		<item>
        	<title>Item 2</title>
        	<description>This is a second Item without rates.</description>
    	</item>
	</list>
</root>
