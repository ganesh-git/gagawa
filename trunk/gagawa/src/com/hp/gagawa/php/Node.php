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

require_once("attributes/Attribute.php");

/*
 * Gagawa Node PHP
 * @author kolichko Mark Kolich
 */
class Node {

	protected $tag_;
	protected $attributes_;
	protected $parent_;

	protected function __construct ( $tag = NULL ) {

		if(empty($tag)){
			throw new Exception( "Node's must have a tag " .
						"type!" );
		}

		$this->tag_ = $tag;
		$this->attributes_ = array();

	}

	public function getParent ( ) {
		return $this->parent_;
	}

	protected function setParent ( $parent ) {
		$this->parent_ = $parent;
	}

	public function setAttribute ( $name = NULL, $value = NULL ) {

		if(empty($name) || empty($value)){
			throw new Exception("Attributes must have " .
						"a name and a value!");

		}

		foreach ( $this->attributes_ as $attribute ) {
			if($attribute->getName()===$name){
				$attribute->setValue( $value );
				return;
			}
		}

		$this->attributes_[] = new Attribute( $name, $value );
		return $this;

	}

	public function getAttribute ( $name = NULL ) {

		$returnAttr = NULL;

		if(empty($name)){
			throw new Exception("Attribute name cannot " .
						"be empty!");
		}

		foreach ( $this->attributes_ as $attribute ) {
			if($attribute->getName()===$name){
				$returnAttr = $attribute->getValue();
				break;
			}
		}

		return $returnAttr;

	}

	public function removeAttribute ( $name = NULL ) {

		if(empty($name)){
			throw new Exception("Attribute name cannot " .
						"be empty!");
		}

		for ( $i = 0; $i < count($this->attributes_); $i++ ) {
			$attribute = $this->attributes_[$i];
			if($attribute->getName()===$name){
				unset( $this->attributes_[$i] );
				return true;
			}
		}

		// Couldn't find the attribute, so
		// it wasn't removed.
		return false;

	}

	public function write ( ) {
		$buffer = $this->writeOpen();
		$buffer .= $this->writeClose();
		return $buffer;
	}

	protected function writeOpen ( ) {
		$buffer = "<";
		$buffer .= $this->tag_;
		foreach ( $this->attributes_ as $attribute ) {
			$buffer .= $attribute->write(); 
		}
		$buffer .= ">";
		return $buffer;
	}

	protected function writeClose ( ) {
		return "</" . $this->tag_ . ">";
	}

}

?>
