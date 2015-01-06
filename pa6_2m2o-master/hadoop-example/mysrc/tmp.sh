#!/bin/bash	

export JAVA_HOME=/usr

../bin/hadoop jar LinkCount.jar edu.umich.cse.eecs485.LinkCount ../dataset/test output1

../bin/hadoop jar Step1.jar edu.umich.cse.eecs485.Step1 ../dataset/test output2

../bin/hadoop jar Step2.jar edu.umich.cse.eecs485.Step2 ../mysrc/output2/part-r-00000 output3

../bin/hadoop jar Step2.jar edu.umich.cse.eecs485.Step3 ../mysrc/output3/part-r-00000 output4

