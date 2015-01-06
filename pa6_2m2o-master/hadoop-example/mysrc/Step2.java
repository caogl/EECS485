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
import org.apache.hadoop.mapreduce.lib.input.TextInputFormat;
import org.apache.hadoop.mapreduce.lib.output.FileOutputFormat;
import org.apache.hadoop.mapreduce.lib.output.TextOutputFormat;
import java.util.Set;
import java.util.HashMap;
import java.util.Iterator;

public class Step2
{
	public static class Map extends Mapper<LongWritable, Text, Text, Text>
	{
		public void map(LongWritable key, Text value, Context context) throws IOException, InterruptedException 
		{
			String line=value.toString();
			String delimiter="[	]+";
			String[] tokens=line.split(delimiter);
			String word=tokens[0];
			delimiter="[,]+";
			line=tokens[1];
			String[] tokens1=line.trim().split(delimiter);
			for(int i=0; i<tokens1.length; i++)
			{
				line=tokens1[i];
				String[] tokenTmp=line.trim().split("[ ]+");
				String outputValue=word+" "+tokenTmp[1];
				context.write(new Text(tokenTmp[0]), new Text(outputValue));
			}
		}
	}

	public static class Reduce extends Reducer<Text, Text, Text, Text>
	{
		public void reduce(Text key, Iterable<Text> values, Context context)
				throws IOException, InterruptedException {

			// calculate the normalization term
			double norm=0;
			HashMap<String, Double> hash1=new HashMap<String, Double>(); 
			for (Text value : values) 
			{
				String line = value.toString();
				String[] tokens=line.split("[ ]+");
				Double tfIdf = Double.parseDouble(tokens[1]);
				hash1.put(tokens[0], tfIdf);
				norm+=tfIdf*tfIdf;
			}
			
			//System.out.println("Here is the tf-idf before normalization: "+norm+"\n");
			norm=Math.sqrt(norm);
			
			/* output format: key---->doc id
 			                  value-->a list of word, tf-idf(after normalization) pairs */
			String doc_tfidf_list = "";
			
			Set<String> keySet=hash1.keySet();
			Iterator<String> keySetItr=keySet.iterator();
			while(keySetItr.hasNext())
			{
				String key1=keySetItr.next();
				double tfIdf=hash1.get(key1)/norm;	
				doc_tfidf_list = doc_tfidf_list+ " " + key1 + " " +  String.valueOf(tfIdf)+ ",";
			}
		
			context.write(key, new Text(doc_tfidf_list));
		}
	}

	public static void main(String[] args) throws Exception
	{	
		Configuration conf = new Configuration();

		Job job = new Job(conf, "step2");

		job.setOutputKeyClass(Text.class);
		job.setOutputValueClass(Text.class);

		job.setMapperClass(Map.class);
		job.setReducerClass(Reduce.class);

		job.setInputFormatClass(TextInputFormat.class);
		job.setOutputFormatClass(TextOutputFormat.class);

		FileInputFormat.addInputPath(job, new Path(args[0]));
		FileOutputFormat.setOutputPath(job, new Path(args[1]));

		job.waitForCompletion(true);
	}
}
