#!/usr/bin/env python3.7
import sys
import numpy as np 
import csv
import pandas as pd 
from sklearn.metrics import confusion_matrix 
from sklearn.model_selection import train_test_split 
from sklearn.tree import DecisionTreeClassifier 
from sklearn.metrics import accuracy_score 
from sklearn.metrics import classification_report 

# Function importing Dataset 
def importdata(): 
	balance_data = pd.read_csv('C:/xampp/htdocs/sacpa/studentdata_all.csv',sep= ',') 
	
	# Printing the dataswet shape 
	#print ("Dataset Lenght: ", len(balance_data)) 
	#print ("Dataset Shape: ", balance_data.shape) 
	
	# Printing the dataset obseravtions 
	#print ("Dataset: ",balance_data.head()) 
	#print(balance_data)
	return balance_data 

# Function to split the dataset 
def splitdataset(balance_data): 

	# Seperating the target variable 
	X = balance_data.values[:, 1:10] 
	Y = balance_data.values[:, 10] 

	# Spliting the dataset into train and test 
	X_train, X_test, y_train, y_test = train_test_split( 
	X, Y, test_size = 0.5, random_state = 100) 

	return X, Y, X_train, X_test, y_train, y_test 
	
# Function to perform training with giniIndex. 
def train_using_gini(X_train, X_test, y_train): 

	# Creating the classifier object 
	clf_gini = DecisionTreeClassifier(criterion = "gini", 
			random_state = 100, min_samples_leaf=1) 

	# Performing training 
	clf_gini.fit(X_train, y_train) 
	return clf_gini 

# Function to make predictions 
def prediction(X_test, clf_object): 

	# Predicton on test with giniIndex 
	y_pred = clf_object.predict(X_test) 
	#print("Predicted values:") 
	#print(y_pred) 
	return y_pred 
	
# Function to calculate accuracy 
#def cal_accuracy(y_test, y_pred): 
	
#	print("Confusion Matrix: ", confusion_matrix(y_test, y_pred)) 
	
#	print ("Accuracy : ", accuracy_score(y_test,y_pred)*100) 
	
#	print("Report : ", 
#	classification_report(y_test, y_pred)) 

# Driver code 


def student_values(register_no):
	with open('C:/xampp/htdocs/sacpa/studentdata_all.csv') as csvDataFile:
		csvReader = csv.reader(csvDataFile)
		for row in csvReader:
			if row[0]==register_no:
				X_one = [[row[1],row[2],row[3],row[4],row[5],row[6],row[7],row[8],row[9]]]
				break

	return X_one


def main(): 
	
	# Building Phase 
	data = importdata() 
	X, Y, X_train, X_test, y_train, y_test = splitdataset(data) 
	clf_gini = train_using_gini(X_train, X_test, y_train) 
	# Operational Phase 
	#print("Results Using Gini Index:") 
	
	# Prediction using gini 
	y_pred_gini = prediction(X_test, clf_gini) 
	#cal_accuracy(y_test, y_pred_gini)
	#print(sys.argv[1])
	X_one = student_values(sys.argv[1])
	y_one = prediction(X_one, clf_gini) 
	if y_one[0] == 3:
		print("First Class with Distinction")
	elif y_one[0] == 2:
		print("First Class")
	elif y_one[0] == 1:
		print("Second Class - Need minor attention")
	else:
		print("Need Attention")	


# Calling main function 
if __name__=="__main__": 
	main() 
