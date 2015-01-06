#!/bin/bash

make -C pageRank

pageRank/pageRank 0.85 50 pageRank/mining.edges.xml proutput/pageRank.txt
