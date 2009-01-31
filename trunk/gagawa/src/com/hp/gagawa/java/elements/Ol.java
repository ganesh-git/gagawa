/**Generated by the Gagawa TagBuilder Fri Jan 30 21:29:45 PST 2009*/

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
THE SOFTWARE.
*/

package com.hp.gagawa.java.elements;

import com.hp.gagawa.java.FertileNode;

import com.hp.gagawa.java.Node;
import com.hp.gagawa.java.elements.Text;
import java.util.List;

public class Ol extends FertileNode {

	public Ol(){
		super("ol");
	}


	/**
	 * Appends a child node to the end of this element's DOM tree
	 * @param child node to be appended
	 * @return the node
	 */
	public Ol appendChild(Node child){
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
	public Ol appendChild(int index, Node child){
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
	public Ol appendChild(List<Node> children){
		if(children != null){;
			for(Node child: children){
				appendChild(child);
			}
		}
		return this;
	}
	/**
	 * Appends the given children in the order given
	 * @param children nodes to be appended
	 * @return the node
	 */
	public Ol appendChild(Node... children){
		for(int i = 0; i < children.length; i++){
			appendChild(children[i]);
		}
		return this;
	}
	/**
	 * Convenience method which appends a text node to this element
	 * @param text the text to be appended
	 * @return the node
	 */
	public Ol appendText(String text){
		return appendChild(new Text(text));
	}
	/**
	 * Removes the child node
	 * @param child node to be removed
	 * @return the node
	 */
	public Ol removeChild(Node child){
		children.remove(child);
		return this;
	}
	/**
	 * Removes all child nodes
	 * @return the node
	 */
	public Ol removeChildren(){
		children.clear();
		return this;
	}
	public Ol setCompact(String value){setAttribute("compact", value); return this;}
	public String getCompact(){return getAttribute("compact");}
	public boolean removeCompact(){return removeAttribute("compact");}

	public Ol setStart(String value){setAttribute("start", value); return this;}
	public String getStart(){return getAttribute("start");}
	public boolean removeStart(){return removeAttribute("start");}

	public Ol setType(String value){setAttribute("type", value); return this;}
	public String getType(){return getAttribute("type");}
	public boolean removeType(){return removeAttribute("type");}

	public Ol setId(String value){setAttribute("id", value); return this;}
	public String getId(){return getAttribute("id");}
	public boolean removeId(){return removeAttribute("id");}

	public Ol setCSSClass(String value){setAttribute("class", value); return this;}
	public String getCSSClass(){return getAttribute("class");}
	public boolean removeCSSClass(){return removeAttribute("class");}

	public Ol setTitle(String value){setAttribute("title", value); return this;}
	public String getTitle(){return getAttribute("title");}
	public boolean removeTitle(){return removeAttribute("title");}

	public Ol setStyle(String value){setAttribute("style", value); return this;}
	public String getStyle(){return getAttribute("style");}
	public boolean removeStyle(){return removeAttribute("style");}

	public Ol setDir(String value){setAttribute("dir", value); return this;}
	public String getDir(){return getAttribute("dir");}
	public boolean removeDir(){return removeAttribute("dir");}

	public Ol setLang(String value){setAttribute("lang", value); return this;}
	public String getLang(){return getAttribute("lang");}
	public boolean removeLang(){return removeAttribute("lang");}

	public Ol setXMLLang(String value){setAttribute("xml:lang", value); return this;}
	public String getXMLLang(){return getAttribute("xml:lang");}
	public boolean removeXMLLang(){return removeAttribute("xml:lang");}

}
