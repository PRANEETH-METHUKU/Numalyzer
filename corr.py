# -*- coding: utf-8 -*-
"""
Created on Mon Mar 11 21:12:37 2019

@author: praneeth
"""

from sklearn.naive_bayes import GaussianNB
from sklearn.metrics import confusion_matrix
from sklearn.feature_selection import RFE
from sklearn.linear_model import LogisticRegression
import pandas as pd
import numpy as np
from sklearn.decomposition import PCA
import csv
#Read files:
train = pd.read_csv("C:\\xampp\\htdocs\\BigData\\uploads\\train.csv")
test = pd.read_csv("C:\\xampp\\htdocs\\BigData\\uploads\\test.csv")
train['source']='train'
test['source']='test'
data = train

#checking missing values, data description and unique values
print(data.apply(lambda x: sum(x.isnull())))
print(data.describe())
print(data.apply(lambda x: len(x.unique())))

df1=(data.apply(lambda x: sum(x.isnull())))
df2=(data.describe())
df3=(data.apply(lambda x: len(x.unique())))

export_csv = df1.to_csv (r'C:\\xampp\\htdocs\\BigData\\nullinfo.csv',  float_format='%.3f',index = True, header=True) #Don't forget to add '.csv' at the end of the path
export_csv = df2.to_csv (r'C:\\xampp\\htdocs\\BigData\\datainfo.csv',  float_format='%.3f',index = True, header=True) #Don't forget to add '.csv' at the end of the path
export_csv = df3.to_csv (r'C:\\xampp\\htdocs\\BigData\\uniqinfo.csv',  float_format='%.3f',index = True, header=True) #Don't forget to add '.csv' at the end of the path
"""
f = open('C:\\xampp\\htdocs\\BigData\\input.txt')
read=f.readline().split(",")
while '' in read:
    read.remove('')
print(read)
"""
with open("C:\\xampp\\htdocs\\BigData\\uploads\\train.csv","r") as f:
    reader=csv.reader(f)
    i=next(reader)
read=i
print("Correlation Matrix")
cor=train[read]
#print(cor.corr())
df=cor.corr()
export_csv = df.to_csv (r'C:\\xampp\\htdocs\\BigData\\corr.csv',  float_format='%.3f',index = True, header=True) #Don't forget to add '.csv' at the end of the path

print (df)