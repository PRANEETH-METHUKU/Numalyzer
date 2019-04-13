# -*- coding: utf-8 -*-
"""
Created on Mon Mar 11 13:48:12 2019

@author: praneeth
"""
import csv
import pandas as pd

#Read files:

with open("C:\\xampp\\htdocs\\BigData\\uploads\\train.csv","r") as f:
    reader=csv.reader(f)
    i=next(reader)
print(i)

with open("C:\\xampp\\htdocs\\BigData\\atr.txt", "w") as text_file:
    text_file.write(("%s"%",".join(i)).replace(",","\n"))