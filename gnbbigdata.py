# -*- coding: utf-8 -*-
"""
Created on Mon Mar 11 22:24:59 2019

@author: praneeth
"""

# -*- coding: utf-8 -*-
"""
Created on Mon Mar 11 13:32:50 2019

@author: praneeth
"""


# -*- coding: utf-8 -*-
"""
Created on Sat Feb  3 08:15:10 2018

@author: praneeth
"""
from sklearn.naive_bayes import GaussianNB
from sklearn.naive_bayes import MultinomialNB
from sklearn.naive_bayes import BernoulliNB
from sklearn.neighbors import KNeighborsClassifier
from sklearn.ensemble import RandomForestClassifier
from sklearn.tree import DecisionTreeClassifier
from sklearn import svm
from sklearn.cluster import KMeans
from sklearn.metrics import confusion_matrix
from sklearn.feature_selection import RFE
from sklearn.linear_model import LogisticRegression
import pandas as pd
import numpy as np
from sklearn.decomposition import PCA
#Read files:
train = pd.read_csv("C:\\xampp\\htdocs\\BigData\\uploads\\train.csv")
test = pd.read_csv("C:\\xampp\\htdocs\\BigData\\uploads\\test.csv")

train=train.fillna(train.mode().iloc[0])
test=test.fillna(test.mode().iloc[0])

train['source']='train'
test['source']='test'

f = open('C:\\xampp\\htdocs\\BigData\\input.txt')
read=f.readline().split(",")
while '' in read:
    read.remove('')
print(read)

f = open('C:\\xampp\\htdocs\\BigData\\output.txt')
output=f.readline().split(",")
while '' in output:
    output.remove('')
print(output)

x=np.array(train[read])

y=np.array(train[output]).astype(int)

print(x)
print(y)
#Create a Gaussian Classifier
model = GaussianNB()
models=["GaussianNB","MultinomialNB","BernoulliNB","KNeighborsClassifier","RandomForestClassifier","DecisionTreeClassifier","SVM.SVC","KMeans"]
f = open('C:\\xampp\\htdocs\\BigData\\model.txt')
case=int(f.readline())
print(case)
if case==0:  model = GaussianNB();
elif case== 1:  model = MultinomialNB();
elif case== 2:  model = BernoulliNB();
elif case== 3:  model=KNeighborsClassifier(n_neighbors=3);
elif case== 4:  model=RandomForestClassifier(n_estimators=100, max_depth=2,random_state=0);
elif case== 5:  model=DecisionTreeClassifier(random_state=0);
elif case== 6:  model=svm.SVC(gamma='auto');
elif case== 7:  model=KMeans(n_clusters=2, random_state=0);
else: model = GaussianNB();
print(models[case])
# Train the model using the training sets 
model.fit(x, y.ravel())
z=np.array(test[read])


#Predict Output 
predicted= model.predict(z)
print("predicted")
print(predicted)

y_pred=predicted

df=np.column_stack([z, y_pred])
print("++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++")
print(df)
#export_csv = df.to_csv (r'C:\\xampp\\htdocs\\BigData\\nbpred.csv',  float_format='%d',index = True, header=True)

#np.savetxt("C:\\xampp\\htdocs\\BigData\\nbpred.csv", df, delimiter=",",format="%d")
df=np.asarray(df)
headers=np.concatenate((read,output), axis=0)
headrs=','.join(map(str, headers))
#dp=np.concatenate((headers,df), axis=0)

np.savetxt('C:\\xampp\\htdocs\\BigData\\outputdownload\\'+models[case]+'.csv',df,delimiter=',',fmt='%d',header=headrs,comments='' )

text='C:\\xampp\\htdocs\\BigData\\outputdownload\\'+models[case]+'.csv'
file = open("C:\\xampp\\htdocs\\BigData\\model.txt", "w")

file.write(text) 


file.close()
