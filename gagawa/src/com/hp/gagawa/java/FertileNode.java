/**
(c) Copyright 2008 Hewlett-Packard Development Company, L.P.

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in
all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
THE SOFTWARE.*/

package com.hp.gagawa.java;

import java.util.ArrayList;
import java.util.List;

import com.hp.gagawa.java.elements.Text;

/**
 * Represents a node that can have children
 * @author friedrch
 *
 */
public class FertileNode extends Node {
	public ArrayList<Node> children;
	
	protected FertileNode(String tag){
		super(tag);
		this.children = new ArrayList<Node>();
	}

	/**
	 * Appends a child node.
	 * A node cannot be appended to itself
	 * @param child the node to be appended
	 * @return the node
	 */
	public FertileNode appendChild(Node child){
		if(this == child){
			throw new Error("Cannot append a node to itself.");
		}
		child.setParent(this);
		children.add(child);
		return this;
	}
	
	/**
	 * Appends a child node at the given index
	 * @param index insert point
	 * @param child node to be appended
	 * @return the node
	 */
	public FertileNode appendChild(int index, Node child){
		if(this == child){
			throw new Error("Cannot append a node to itself.");
		}
		child.setParent(this);
		children.add(index, child);
		return this;
	}
	
	/**
	 * Appends a list of children in the order given in the list
	 * @param children nodes to be appended
	 * @return the node
	 */
	public FertileNode appendChild(List<Node> children){
		for(Node child: children){
			appendChild(child);
		}
		return this;
	}
	
	/**
	 * Convenience method which appends a text node to this element
	 * @param text the text to be appended
	 * @return the node
	 */
	public FertileNode appendText(String text){
		return appendChild(new Text(text));
	}
	
	/**
	 * Removes the child node
	 * @param child node to be removed
	 * @return the node
	 */
	public FertileNode removeChild(Node child){
		children.remove(child);
		return this;
	}
	
	/**
	 * Removes all child nodes
	 * @return the node
	 */
	public FertileNode removeChildren(){
		children.clear();
		return this;
	}
	
	/**
	 * Gets the list of child nodes
	 * @return a list of children
	 */
	public ArrayList<Node> getChildren(){
		return children;
	}
	
	/**
	 * Gets the child node at the given index
	 * @param index child node index
	 * @return the child node
	 */
	public Node getChild(int index){
		return children.get(index);
	}
	
	/**
	 * Writes the node's tag and all of its children's tags
	 */
	@Override
	public String write(){
		StringBuffer b = new StringBuffer(writeOpen());
		
		if(children != null && children.size() > 0){
			for(Node child: children){
				b.append(child.write());
			}
		}
		b.append(writeClose());
		return b.toString();
	}
}
