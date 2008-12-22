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

package com.hp.gagawa.builder;

import java.io.BufferedReader;
import java.io.FileReader;
import java.io.FileWriter;
import java.io.PrintWriter;
import java.util.StringTokenizer;

import org.jdom.Document;
import org.jdom.Element;
import org.jdom.output.Format;
import org.jdom.output.XMLOutputter;

/**
 * Reads in tags.txt and produces an XML document that specs all
 * of the tags and attributes defined in tags.txt.  Uses JDom to
 * produce the XML.
 * @author friedrch
 * @author kolichko
 *
 */
public class XMLBuilder {
	
	private static final String OPEN_ANGLE_BRACKET = "[";
	private static final String CLOSE_ANGLE_BRACKET = "]";
	
	private static final String SEP = System.getProperty("file.separator");
	private static final String WORKING = System.getProperty("user.dir");
	
	private static final String TAGS_TXT = WORKING + SEP + "builder" + SEP +
											"com" + SEP + "hp" + SEP + "gagawa" +
											SEP + "builder" + SEP + "tags.txt";
	
	private static final String TAGS_XML = WORKING + SEP + "builder" + SEP +
											"com" + SEP + "hp" + SEP + "gagawa" +
											SEP + "builder" + SEP + "tags.xml";
	
	private static BufferedReader in;
	private static PrintWriter out;
	
	private static XMLOutputter outputter;
	private static Document doc = new Document();
	private static Element root = new Element( "document" );	

	
	public static void main ( String [] args ) {
		
		String line;
		
		System.out.println( "User's current working directory is " + WORKING );
		System.out.println( "Using tags.txt at " + TAGS_TXT );
		System.out.println( "Using tags.xml at " + TAGS_XML );
	
		try {
			
			in = new BufferedReader( new FileReader( TAGS_TXT ) );
			out = new PrintWriter( new FileWriter( TAGS_XML ) );
			
			while ( ( line = in.readLine() ) != null ) {
				
				// We skip lines in tags.txt that start with a #
				// since # indicates a comment.
				if ( line.startsWith("#") ) {
					continue;
				}
				
				StringTokenizer token = new StringTokenizer(line);
				String tagToken = token.nextToken();
				
				Element tag = new Element( "tag" );
				
				// See if our tags have any special needs.
				if ( tagToken.startsWith( OPEN_ANGLE_BRACKET ) ) {
					
					tag = processSpecialNeeds( tagToken, tag );
					
					// Remove the special needs list from this token.
					tagToken = stripSpecialNeeds( tagToken );
					
				}
				
				// Set the tag name.
				tag.setAttribute( "name", tagToken );
				
				// Loop through the remaining children.
				if ( token.hasMoreTokens() ) {
					
					Element attributes = new Element( "attributes" );
					
					while ( token.hasMoreTokens() ) {
						
						Element attribute = new Element( "attribute" );
						String attributeToken = token.nextToken();
						
						// See if our attributes have any special needs.
						if ( attributeToken.startsWith( OPEN_ANGLE_BRACKET ) ) {
							
							attribute = processSpecialNeeds( attributeToken, attribute );
							
							// Remove the special needs list from this token.
							attributeToken = stripSpecialNeeds( attributeToken );
							
						} /* if */
						
						attribute.setText( attributeToken );
						attributes.addContent( attribute );
						
					} /* while */
					
					tag.addContent( attributes );
										
				} /* if */
				
				root.addContent( tag );
				
			} /* while */
			
			outputter = new XMLOutputter(
							Format.getPrettyFormat()
							);
			
			doc = new Document( root );
			outputter.output( doc, out );
			
			// Close the streams, get 'er done.
			out.close();
			in.close();
			
		} catch ( Throwable t ) {
			t.printStackTrace( System.err );
		}
		
		System.out.println( "Complete!" );
		
	} /* main */
	
	
	/**
	 * Reads the list of special needs from the start of an attribute
	 * or tag, and processes them by adding each special need to the
	 * element as an attribute.  Multiple special needs are separated
	 * by a comma:  [required=true,isAwesome=true]src.
	 * @param token a raw token with special needs
	 * @param attribute the element to add the special needs attributes to
	 * @return a hashmap that maps each special need key to a value
	 * @author kolichko
	 */
	private static Element processSpecialNeeds ( String token, Element attribute ) {
		
		int closeBracket = token.lastIndexOf( CLOSE_ANGLE_BRACKET ) + 1;
		String specialNeed = token.substring( 0, closeBracket );
		
		specialNeed = specialNeed.replace( OPEN_ANGLE_BRACKET, "" );
		specialNeed = specialNeed.replace( CLOSE_ANGLE_BRACKET, "" );
		
		// Multiple special needs are separeated with a comma.
		String [] needs = specialNeed.split(",");
		
		// Adds all of the special needs attributes to the element.
		for ( String need : needs ) {			
			String [] singleNeed = need.split("=");
			attribute.setAttribute( singleNeed[0], singleNeed[1] );
		}
		
		return attribute;
		
	}
	
	/**
	 * Removes the special needs list from the start of a tag
	 * or attribute declaration.  For example, an input of
	 * "[required=true]src" would yield "src".
	 * @param token a tag or attribute token
	 * @return a string with no special needs declarations
	 * @author kolichko
	 */
	private static String stripSpecialNeeds ( String token ) {
		return token.substring( token.lastIndexOf( CLOSE_ANGLE_BRACKET ) + 1 );
	}
	
}
