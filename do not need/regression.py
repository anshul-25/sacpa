#! /usr/bin/env python3.7

import numpy as np 
import matplotlib.pyplot as plt 
  
def estimate_coef(x, y): 
    # number of observations/points 
    n = np.size(x) 
  
    # mean of x and y vector 
    m_x, m_y = np.mean(x), np.mean(y) 
  
    # calculating cross-deviation and deviation about x 
    SS_xy = np.sum(y*x) - n*m_y*m_x 
    SS_xx = np.sum(x*x) - n*m_x*m_x 
  
    # calculating regression coefficients 
    b_1 = SS_xy / SS_xx 
    b_0 = m_y - b_1*m_x 
  
    return(b_0, b_1) 
  
def plot_regression_line(x, y, b): 
    # plotting the actual points as scatter plot 
    plt.scatter(x, y, color = "m", 
               marker = "o", s = 30) 
  
    # predicted response vector 
    y_pred = b[0] + b[1]*x 
  
    # plotting the regression line 
    plt.plot(x, y_pred, color = "g") 
  
    # putting labels 
    plt.xlabel('Attendance Percentage') 
    plt.ylabel('Aggregate Marks Percentage') 
    plt.title('Linear Regression - Attendance v Marks')
    # function to show plot 
    plt.show() 
  
def main(): 
    # observations 
    import csv

    data = csv.reader(open('studentdata_att_aca.csv', 'rt'), delimiter=",")
    column1, column2 = [], []

    for row in data:
        column1.append(row[0])
        column2.append(row[1])

    #print (column1)
    #print (column2)

    x = np.array(column1).astype(np.float)
    y = np.array(column2).astype(np.float)
  
    # estimating coefficients 
    b = estimate_coef(x, y) 
    print("Estimated coefficients:\nb_0 = {}  \nb_1 = {}".format(b[0], b[1])) 
  
    # plotting regression line 
    plot_regression_line(x, y, b) 
  
if __name__ == "__main__": 
    main() 
