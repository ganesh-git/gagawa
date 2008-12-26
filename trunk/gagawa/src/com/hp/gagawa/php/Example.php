<?php

/**
(c) Copyright 2008 Hewlett-Packard Development Company, L.P.

Permission is hereby granted, free of charge, to any person
obtaining a copy of this software and associated documentation
files (the "Software"), to deal in the Software without
restriction, including without limitation the rights to use,
copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the
Software is furnished to do so, subject to the following
conditions:

The above copyright notice and this permission notice shall be
included in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND,
EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES
OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND
NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT
HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY,
WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING
FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR
OTHER DEALINGS IN THE SOFTWARE.
*/

require_once("Node.php");
require_once("FertileNode.php");

require_once("elements/A.php");
require_once("elements/Br.php");
require_once("elements/Text.php");

$a = new A();
$a->setHref( "http://kolich.com" );

// Note you can daisy chain attribute setters.
$a->setAttribute("class","linkclass")
	->setAttribute("target","_blank")
	/*->setAttribute("","") <-- will generate an expected exception */
	->setAttribute("id","linkid");

$text = new Text("random text");

// Note you can daisy chain children setters.
$a->appendChild( $text )->appendChild( new Br() )
	->appendChild( new Text("more text") )->appendChild( new Br() )
	/*->appendChild() <-- will generate an expected exception */
	->appendChild( new Text("gagawa!" ) );

echo $a->write() . "\n";

// Example of creating a new FertileNode without the helper classes
$tag = new FertileNode("div");
$tag->setAttribute("class","dog")->setAttribute("id","mydiv");
echo $tag->write() . "\n";

?>
