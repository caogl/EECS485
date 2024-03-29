package edu.umich.cse.eecs485;

import java.io.IOException;

import org.apache.hadoop.conf.Configuration;
import org.apache.hadoop.fs.Path;
import org.apache.hadoop.io.LongWritable;
import org.apache.hadoop.io.Text;
import org.apache.hadoop.mapreduce.Job;
import org.apache.hadoop.mapreduce.Mapper;
import org.apache.hadoop.mapreduce.Reducer;
import org.apache.hadoop.mapreduce.lib.input.FileInputFormat;
import org.apache.hadoop.mapreduce.lib.output.FileOutputFormat;
import org.apache.hadoop.mapreduce.lib.output.TextOutputFormat;
import org.apache.mahout.classifier.bayes.XmlInputFormat;
import java.util.Set;
import java.util.HashSet;
import java.util.HashMap;
import nu.xom.*;
import java.util.Iterator;
import java.util.Scanner;
import java.util.regex.Matcher;
import java.util.regex.Pattern;
import java.io.FileInputStream;
import java.io.FileNotFoundException;

public class Step1
{

	public static double totalDocNum;
	public static HashSet<String> stopWords=new HashSet<String>();
	
	public static class Map extends Mapper<LongWritable, Text, Text, LongWritable> {
		public void map(LongWritable key, Text value, Context context)
				throws IOException, InterruptedException {

			String strId = "";
			String strBody = "";

			// Parse the xml and read data (page id and article body)
			// Using XOM library
			Builder builder = new Builder();

			try {
//				System.out.println(value.toString());
				Document doc = builder.build(value.toString(), null);

				Nodes nodeId = doc.query("//eecs485_article_id");
				strId = nodeId.get(0).getChild(0).getValue();
				
				Nodes nodeBody = doc.query("//eecs485_article_body");
				strBody = nodeBody.get(0).getChild(0).getValue();
			}
			// indicates a well-formedness error
			catch (ParsingException ex) { 
				System.out.println("Not well-formed.");
				System.out.println(ex.getMessage());
			}  
			catch (IOException ex) {
				System.out.println("io exception");
			}
			
			// Tokenize document body
			Pattern pattern = Pattern.compile("\\w+");
			Matcher matcher = pattern.matcher(strBody);
			
			while (matcher.find()) 
			{
				// Write the parsed token if it is a non-stop word
				if(!stopWords.contains(matcher.group().toLowerCase()))
					context.write(new Text(matcher.group().toLowerCase()), new LongWritable(Integer.valueOf(strId)));
			}
		}
	}

	public static class Reduce extends Reducer<Text, LongWritable, Text, Text>
	{
		private final static Long one=new Long(1);	
		public void reduce(Text key, Iterable<LongWritable> values, Context context)
				throws IOException, InterruptedException {

			// in this hashmap, key is doc id, value is the tf in this doc
			HashMap<String, Long> hash1 = new HashMap<String, Long>();
			for (LongWritable value : values) 
			{
				String pagid = String.valueOf(value.get());
				if(!hash1.containsKey(pagid))
					hash1.put(pagid, one);
				else
					hash1.put(pagid, hash1.get(pagid)+1);
			}
			
			// Convert to the tf-idf list (denominator of real) 
			String doc_tfidf_list = "";
			
			Set<String> keySet=hash1.keySet();
			Iterator<String> keySetItr=keySet.iterator();
			while(keySetItr.hasNext())
			{
				String key1=keySetItr.next();
				double tfIdf=hash1.get(key1)*(Math.log(totalDocNum/hash1.size())/Math.log(10.0));	
				doc_tfidf_list = doc_tfidf_list+ " " + key1 + " " +  String.valueOf(tfIdf)+ ",";
			}
			
			context.write(key, new Text(doc_tfidf_list));
		}
	}

	public static void main(String[] args) throws Exception
	{
		Scanner inputStream=null;
			
		try
		{
			inputStream=new Scanner(new FileInputStream("./output1/part-r-00000"));
		}
		catch(FileNotFoundException e)
		{
			System.out.println("Input file not found or cannot open");
			System.exit(1);	
		}

		String line=inputStream.nextLine();
		String delimiter="[	]+";
		String[] tokens=line.split(delimiter);
		totalDocNum=Double.parseDouble(tokens[1]);		
		
		// read the stop word list txt and update the corresponding data structure
		try
                {
                        inputStream=new Scanner(new FileInputStream("/home/caogl/hadoop-example/dataset/stopWords.txt"));
                }
                catch(FileNotFoundException e)
                {
                        System.out.println("Input file not found or cannot open");
                        System.exit(1);
                }
		
		Pattern pattern = Pattern.compile("\\w+");
		while(inputStream.hasNextLine())
		{       
			line=inputStream.nextLine();
                        Matcher matcher = pattern.matcher(line.trim());
                        while (matcher.find())
                        {
				stopWords.add(matcher.group());
			}
		}		

		inputStream.close();
		
		Configuration conf = new Configuration();

		conf.set("xmlinput.start", "<eecs485_article>");
		conf.set("xmlinput.end", "</eecs485_article>");

		Job job = new Job(conf, "XmlParser");

		job.setOutputKeyClass(Text.class);
		job.setOutputValueClass(LongWritable.class);

		job.setMapperClass(Map.class);
		job.setReducerClass(Reduce.class);

		job.setInputFormatClass(XmlInputFormat.class);
		job.setOutputFormatClass(TextOutputFormat.class);

		FileInputFormat.addInputPath(job, new Path(args[0]));
		FileOutputFormat.setOutputPath(job, new Path(args[1]));

		job.waitForCompletion(true);
	}
}
