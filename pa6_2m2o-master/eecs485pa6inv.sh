#!/bin/bash

export JAVA_HOME=/usr

rm -rf invoutput
make -C hadoop-example/mysrc

hadoop-example/bin/hadoop jar hadoop-example/mysrc/LinkCount.jar edu.umich.cse.eecs485.LinkCount hadoop-example/dataset/mining.articles.small.xml hadoop-example/mysrc/output1

hadoop-example/bin/hadoop jar hadoop-example/mysrc/Step1.jar edu.umich.cse.eecs485.Step1 hadoop-example/dataset/mining.articles.small.xml hadoop-example/mysrc/output2

hadoop-example/bin/hadoop jar hadoop-example/mysrc/Step2.jar edu.umich.cse.eecs485.Step2 hadoop-example/mysrc/output2/part-r-00000 hadoop-example/mysrc/output3

hadoop-example/bin/hadoop jar hadoop-example/mysrc/Step3.jar edu.umich.cse.eecs485.Step3 hadoop-example/mysrc/output3/part-r-00000 invoutput
