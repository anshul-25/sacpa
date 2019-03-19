import csv
import numpy as np

data = csv.reader(open('studentdata_att_aca.csv', 'rt'), delimiter=",")
column1, column2 = [], []

for row in data:
    column1.append(row[0])
    column2.append(row[1])

x = np.array(column1).astype(np.float)
y = np.array(column2).astype(np.float)


print (x)
print (y)
