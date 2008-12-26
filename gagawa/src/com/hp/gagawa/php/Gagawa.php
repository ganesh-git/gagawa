<?php

/*
 * (c) Copyright 2008 Hewlett-Packard Development Company, L.P.
 * 
 * Permission is hereby granted, free of charge, to any person
 * obtaining a copy of this software and associated documentation
 * files (the "Software"), to deal in the Software without
 * restriction, including without limitation the rights to use,
 * copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the
 * Software is furnished to do so, subject to the following
 * conditions:
 * 
 * The above copyright notice and this permission notice shall be
 * included in all copies or substantial portions of the Software.
 * 
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND,
 * EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES
 * OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND
 * NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT
 * HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY,
 * WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING
 * FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR
 * OTHER DEALINGS IN THE SOFTWARE.
 * 
 * http://code.google.com/p/gagawa/
 * 
 * AUTHORS:
 *   Mark Kolich
 *   Chris Friedrich
 * 
 */

class Attribute {

	private $name_;
	private $value_;

	public function __construct ( $name = NULL, $value = NULL ) {

		if(empty($name) || empty($value)){
			throw new Exception( "Attributes must have a name " .
						"and a value!" );
		}

		$this->name_ = $name;
		$this->value_ = $value;

	}

	public function write ( ) {
		return " " . $this->name_ .
			"=\"" . $this->value_ .
			"\"";
	}

	public function getName ( ) {
		return $this->name_;
	}

	public function setName ( $name = NULL ) {
		
		if(empty($name)){
			throw new Exception( "Attribute names cannot be " .
									"empty!" );
		}
		
		$this->name_ = $name;
		
	}

	public function getValue ( ) {
		return $this->value_;
	}

	public function setValue ( $value ) {
		
		if(empty($value)){
			throw new Exception( "Attribute values cannot be " .
									"empty!" );
		}
		
		$this->value_ = $value;
		
	}

} /* Attribute */


class Node {

	protected $tag_;
	protected $attributes_;
	protected $parent_;

	/**
	 * This Node constructor can only be called from
	 * classes that extend Node.
	 */
	protected function __construct ( $tag = NULL ) {

		if(empty($tag)){
			throw new Exception( "Node's must have a tag " .
						"type!" );
		}

		$this->parent_ = NULL;
		$this->tag_ = $tag;
		$this->attributes_ = array();

	}

	/**
	 * Returns the parent node of this node, if
	 * a parent exists.  If no parent exists,
	 * this function returns NULL.
	 */
	public function getParent ( ) {
		return $this->parent_;
	}

	/**
	 * Sets the parent of this Node.  Note that this
	 * function is protected and can only be called by
	 * classes that extend Node.  The parent cannot
	 * be NULL; this function will throw an Exception
	 * if the parent node is empty.
	 */
	protected function setParent ( $parent = NULL ) {

		if(empty($parent)){
			throw new Exception( "Parent cannot be NULL!" );
		}

		$this->parent_ = $parent;

	}

	/**
	 * Given a name and value pair, sets an attribute on this Node.
	 * The name and value cannot be empty; if so, this function
	 * will throw an Exception.  Note if the attribute already exists
	 * and the caller wants to set an attribute of the same name,
	 * this function will not create a new Attribute, but rather
	 * update the value of the existing named attribute.
	 */
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

	/**
	 * Fetch and attribute by name from this Node.  The attribute
	 * name cannot be NULL; if so, this function will throw an
	 * Exception.
	 */
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

	/**
	 * Removes an attribute from this Node, by name.  The name
	 * of the attribute to remove cannot be NULL; if so, this
	 * function will throw an Exception.
	 */
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

} /* Node */


class FertileNode extends Node {

	private $children_;

	/**
	 * Create a new FertileNode with the given tag.  The
	 * tag cannot be NULL.
	 */
	public function __construct ( $tag = NULL ) {

		if(empty($tag)){
			throw new Exception( "FertileNode's must have a tag " .
						"type!" );
		}

		parent::__construct( $tag );
		$this->children_ = array();

	}

	/**
	 * Add's a child to this FertileNode.  The child to
	 * add cannot be null.
	 */	
	public function appendChild ( $childNode = NULL ) {

		if(empty($childNode)){
			throw new Exception( "You cannot append an empty " .
						"child node!" );
		}

		$childNode->setParent( $this );
		$this->children_[] = $childNode;
		return $this;
		
	}

	/**
	 * Removes the first instance of child from this
	 * FertileNode.  Once the first instance of the child
	 * is removed, this function will return.  It returns
	 * true if a child was removed and false if no child
	 * was removed.
	 */
	public function removeChild ( $childNode = NULL ) {

		if(empty($childNode)){
			throw new Exception( "You cannot remove an empty " .
						"child node!" );
		}

		for ( $i = 0; $i < count($this->children_); $i++ ) {
			$child = $this->children_[$i];
			if($child===$childNode){
				unset( $this->children_[$i] );
				return true;
			}
		}

		return false;

	}

	/**
	 * Removes all children attached to this FertileNode.
	 */
	public function removeChildren ( ) {
		unset( $this->children_ );
		$this->children_ = array();
	}

	/**
	 * Returns an array of all children attached to
	 * this FertileNode.
	 */
	public function getChildren ( ) {
		return $this->children_;
	}

	/**
	 * Gets a child of this FertileNode at given
	 * index.  If no index is passed in, getChild()
	 * will return the child at index zero (0).
	 */
	public function getChild ( $index = 0 ) {
		return $this->children_[$index];
	}

	/* @Override */
	public function write ( ) {
		
		$buffer = $this->writeOpen();		
		foreach ( $this->children_ as $child ) {
			$buffer .= $child->write();
		
		}		
		$buffer .= $this->writeClose();
		
		return $buffer;
	
	}

} /* FertileNode */


/** ELEMENTS START HERE **/


?>
