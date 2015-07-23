# `<overview />` #

Gagawa is an HTML Generator library written in Java and PHP.

It allows developers to easily and dynamically build well-formed HTML in web or non-web applications.  In Java, Gagawa is especially useful when traditional HTML generation engines such as Java Server Pages (JSP's) are unavailable.  In PHP, Gagawa frees developers from hand-writing HTML in PHP web applications.  Although you can build an entire site using Gagawa, most developers use Gagawa in conjunction with other libraries to build relatively small blocks or pieces of HTML.  For example, Gagawa is perfect when a developer needs to return a small chunk of well-formed HTML in an AJAX response.

Under the hood, Gagawa uses Objects to represent each HTML element, or tag. For example, a `<div>` element is represented using a Div object. Similarly, developers can set attributes on these nodes using a setAttribute() method, or function, for each object. An HTML page, or DOM tree, is built by creating a set of element objects and appending them to each other in the correct order. To convert a Gagawa object hierarchy into a String which can be sent to a web-browser, the developer should call the write() method, or function, on the top-level element. The resulting String is well-formed HTML.  **Gagawa virtually eliminates missed closing tags and other mundane HTML typos that often haunt web-developers.**

Gagawa, formerly the HTML Generator, was **created by Chris Friedrich and [Mark Kolich](http://mark.kolich.com) at HP**.  It is **licensed by HP** to the Open Source community under the MIT License.  Anyone is free to use Gagawa per the terms set forth by the [MIT License](http://en.wikipedia.org/wiki/MIT_License).

<br />
# `<using />` #

If you're **using Java**, download the Gagawa JAR (Java archive) under Featured Downloads.  To use Gagawa in your Java project, add the Gagawa JAR to your Classpath.  In Eclipse, this involves importing the JAR file into your Java Project, and then adding the JAR to your Build Path (right-click on the JAR file, select Build Path->Add to Build Path).

If you're **using PHP**, download the Gagawa PHP library under Featured Downloads.  To use Gagawa in your PHP web-application, simply include **([require\_once](http://us2.php.net/require_once) preferred)** the Gagawa PHP file at the top of your PHP application:  **require\_once("gagawa.php");**

<br />
# `<examples />` #

Here are a few primitive examples that illustrate how to use Gagawa.  In both examples, we are using Gagawa to create a `<div>` that contains an `<a>` (an anchor/link) with an `<img>` inside of it.

_Java:_

```
Div div = new Div();
div.setId("mydiv").setCSSClass("myclass");

A link = new A();
link.setHref("http://www.example.com").setTarget("_blank");
		
div.appendChild( link );
		
Img image = new Img( "some alt", "some-image.png" );
image.setCSSClass( "frame" ).setId( "myimageid" );
link.appendChild( image );
		
System.out.print( div.write() );
```

This Java code produces the following HTML:

```
<div id="mydiv" class="myclass">
  <a href="http://www.example.com" target="_blank">
   <img alt="some alt" src="some-image.png" class="frame" id="myimageid">
  </a>
</div>
```

For more Java examples, see the [Gagawa Java examples package](http://code.google.com/p/gagawa/source/browse/trunk/gagawa/examples/com/hp/gagawa/examples/).

<br />

_PHP:_

```
<?php

require_once("gagawa.php");

$d = new Document( Doctype::HTMLStrict );

$div = new Div();
$div->setId("mydiv")->setCSSClass("myclass");

$link = new A();
$link->setHref("http://www.example.com")->setTarget("_blank");

$div->appendChild( $link );

$image = new Img("some alt","some-image.png");
$image->setCSSClass("frame")->setId("myimageid");

$link->appendChild( $image );

$title = new Title();
$title->appendChild( new Text("Page title!") );

$d->head_->appendChild( $title );
$d->body_->appendChild( $div );

echo $d->write();

?>
```

This PHP code produces the following HTML:

```
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
  <head>
    <title>Page title!</title>
  </head>
  <body>
    <div id="mydiv" class="myclass">
      <a href="http://www.example.com" target="_blank">
        <img alt="some alt" src="some-image.png" class="frame" id="myimageid">
      </a>
    </div>
  </body>
</html>
```

For more PHP examples, see the [Example.php Gagawa demo](http://code.google.com/p/gagawa/source/browse/trunk/gagawa/src/com/hp/gagawa/php/Example.php).