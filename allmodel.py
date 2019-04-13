# -*- coding: utf-8 -*-
"""
Created on Thu Mar 14 19:58:47 2019

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
#test = pd.read_csv("/Users/praneeth/Desktop/datasets/test.csv")
df = pd.read_csv("C:\\xampp\\htdocs\\BigData\\uploads\\train.csv")
df['split'] = np.random.randn(df.shape[0], 1)
#d2=data
#data=d2.fillna(d2.mode().iloc[0])
#print(data)
train=train.fillna(train.mode().iloc[0])
df=df.fillna(df.mode().iloc[0])
#print(test)
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
#####################################################################################################################
x=(train[read])

y=train[output]

array = x.values
array1 = y.values
print(array.shape[1])
X = array[:,0:array.shape[1]]
Y = array1[:,0:array1.shape[1]]

# feature extraction
model = LogisticRegression()
text1="";
for j in range(array.shape[1]-1):
    rfe = RFE(model, j+1)
    fit = rfe.fit(X, Y.ravel())
    #print("Num Features: %d" % fit.n_features_)
    #print("Selected Features: %s"% fit.support_) 
    #print("Feature Ranking: %s"% fit.ranking_) 
    best_features = []
    i = 0
    names=read
    for is_best_feature in fit.support_:
        if is_best_feature:
            best_features.append(names[i])
        i += 1
    #print(best_features)
    text1=text1+"\n	For combination of "+str(j+1)+" Features\n"+str(best_features)+"\n";
#####################################################################################################################

msk = np.random.rand(len(df)) <= 0.7

train = df[msk]
test = df[~msk]
#train['source']='train'
#test['source']='test'
data = pd.concat([train, test],ignore_index=True)
print(train.shape, test.shape, data.shape)



x=np.array(train[read])
y=np.array(train[output]).astype(int)

print(x)
print(y)

model = GaussianNB()
#model = GaussianNB()
#model = MultinomialNB()
#model = BernoulliNB()
#model=KNeighborsClassifier(n_neighbors=3)
#model=RandomForestClassifier(n_estimators=100, max_depth=2,random_state=0)
#model=DecisionTreeClassifier(random_state=0)
#model=svm.SVC(gamma='auto')
#model=KMeans(n_clusters=2, random_state=0)
text="Training Data: "+str(train.shape[0])+" instances, Testing Data: "+str(test.shape[0])+"instances, Overall Data: "+str(data.shape[0])+" instances\n\nFeature Extraction\n"+text1+"\n"
models=["GaussianNB","MultinomialNB","BernoulliNB","KNeighborsClassifier","RandomForestClassifier","DecisionTreeClassifier","SVM.SVC","KMeans"]
for case in range(8):
    if case==0:  model = GaussianNB();
    elif case== 1:  model = MultinomialNB();
    elif case== 2:  model = BernoulliNB();
    elif case== 3:  model=KNeighborsClassifier(n_neighbors=3);
    elif case== 4:  model=RandomForestClassifier(n_estimators=100, max_depth=2,random_state=0);
    elif case== 5:  model=DecisionTreeClassifier(random_state=0);
    elif case==6:  model=svm.SVC(gamma='auto');
    elif case==7:  model=KMeans(n_clusters=2, random_state=0);
    else: model = GaussianNB();
    # Train the model using the training sets 
    model.fit(x, y.ravel())
    z=np.array(test[read])
    #Predict Output 
    predicted= model.predict(z)
    print("predicted")
    print(predicted)
    y_true=np.array(test[output]).astype(int)
    y_pred=predicted
    cm=confusion_matrix(y_true, y_pred)
    print(confusion_matrix(y_true, y_pred))
    TP = cm[0][0]
    FP = cm[0][1]
    FN = cm[1][0]
    TN = cm[1][1]
    # Overall accuracy
    ACC = (TP+TN)/(TP+FP+FN+TN)
    print("Accuracy percent:")
    print(ACC*100 )
    text=text+str(models[case])+"\nAccuracy: "+str(ACC*100)+"\n";
print(text)
file = open("C:\\xampp\\htdocs\\BigData\\RFE.txt", "w")

file.write(text) 


file.close()
