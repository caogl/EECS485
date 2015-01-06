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

public class Step3
{
	public static class Map extends Mapper<LongWritable, Text, Text, Text>
	{
		public void map(LongWritable key, Text value, Context context) throws IOException, InterruptedException 
		{
			String line=value.toString();
			String delimiter="[	]+";
			String[] tokens=line.split(delimiter);
			String docId=tokens[0];
			delimiter="[,]+";
			line=tokens[1];
			String[] tokens1=line.trim().split(delimiter);
			for(int i=0; i<tokens1.length; i++)
			{
				line=tokens1[i];
				String[] tokenTmp=line.trim().split("[ ]+");
				double tmp=Double.parseDouble(tokenTmp[1]);
				String outputValue=docId+":"+String.format("%.4e", tmp);
				context.write(new Text(tokenTmp[0]), new Text(outputValue));
			}
		}
	}

	public static class Reduce extends Reducer<Text, Text, Text, Text>
	{
		public void reduce(Text key, Iterable<Text> values, Context context)
				throws IOException, InterruptedException {
			
			String line=""; 
			long index=0;
			for (Text value : values) 
			{
				index++;
				line = line + value.toString()+" ";
			}
			line=line.trim();
			line=String.valueOf(index)+" "+line;
		
			context.write(key, new Text(line));
		}
	}

	public static void main(String[] args) throws Exception
	{	
		Configuration conf = new Configuration();

		Job job = new Job(conf, "step3");

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
