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
import java.io.FileOutputStream;
import java.io.FileReader;
import java.io.PrintWriter;
import java.util.StringTokenizer;

public class XMLBuilder {
	private static String sep = System.getProperty("file.separator");
	
	private static BufferedReader in;
	private static PrintWriter out;

	public static void main(String[] args) {
		try {
			System.out.println("User's current working directory: " + System.getProperty("user.dir"));			
			in = new BufferedReader( new FileReader("builder" + sep + "tags.txt"));
			out = new PrintWriter(new FileOutputStream("builder" + sep  + "tags.xml"));

			out.print("<?xml version = \"1.0\" encoding=\"UTF-8\" standalone=\"yes\"?>");
			out.print("<document>");
			String line;
			while((line = in.readLine()) != null){
				StringTokenizer token = new StringTokenizer(line);
				out.print(String.format("<tag name=\"%s\">",token.nextToken()));
				while(token.hasMoreTokens()){
					out.print(String.format("<attribute>%s</attribute>",token.nextToken()));
				}
				out.print("</tag>");
			}
			out.print("</document>");
			out.close();
		} catch (Throwable t) {
			// TODO Auto-generated catch block
			t.printStackTrace();
		}
		System.out.println("Complete");
	}
}
