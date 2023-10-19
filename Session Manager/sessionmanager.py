import sys
from datetime import datetime
import time
import mysql.connector

def get_current_time(timeobj):
    hour = timeobj.tm_hour % 12
    hour = hour - 12 if hour >= 12 else hour
    currentTimestamp = f"{now.tm_year}-{now.tm_mon}-{now.tm_mday} {hour}:{now.tm_min}:{now.tm_sec}"
    return datetime.strptime(currentTimestamp, dateFormat)

def get_session_data(cursor):
    query = "SELECT * FROM session_data;"
    cursor.execute(query)
    return cursor.fetchall()

connection = mysql.connector.connect(
    host="10.0.0.139",
    user="linux",
    password="",
    database="thefacebook",
    autocommit=True
)

cursor = connection.cursor()
result = get_session_data(cursor)
dateFormat = '%Y-%m-%d %H:%M:%S'
if result == []:
    print('no user currently signed in')    

print('Currently Logged In:', len(result), ' active\n')
k = 0

while True:
    print('Iteration: ', k)
    time.sleep(1)

    if (k % 3) == 0:
        result = get_session_data(cursor)

    for row in result:
        userID = row[0]
        sessionID = row[1]
        loggedInTime = str(row[2])
        expirationTime = str(row[3])

        now = time.localtime()
        formattedCurrentTimestamp = get_current_time(now)
        formattedLoggedInTime = datetime.strptime(loggedInTime, dateFormat)
        formattedExpirationTime = datetime.strptime(expirationTime, dateFormat)
        
        if formattedCurrentTimestamp > formattedExpirationTime:
            print('their session has expired')
            deleteRow = "DELETE FROM session_data WHERE session_data_id = " + str(userID) + ";"
            cursor.execute(deleteRow)
            connection.commit()
        else:
            print('user: ', userID, ' active')
            
    k += 1
