import shutil
import sys
import os
import time
import mysql.connector
from datetime import datetime

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

UPDATE_FREQ = 3
UPDATE_TIME = 3
cursor = connection.cursor()
result = get_session_data(cursor)
dateFormat = '%Y-%m-%d %H:%M:%S'

print('Currently Logged In:', len(result), ' active\n')
k = 0

while True:
	print('Iteration: ', k)
	time.sleep(UPDATE_TIME)

	if (k % UPDATE_FREQ) == 0:
		result = get_session_data(cursor)

	for row in result:
		userID = row[0]
		sessionID = row[1]
		profile_image_name = str(row[2])
		loggedInTime = str(row[3])
		expirationTime = str(row[4])

	
		now = time.localtime()
		formattedCurrentTimestamp = get_current_time(now)		
		formattedLoggedInTime = datetime.strptime(loggedInTime, dateFormat)
		formattedExpirationTime = datetime.strptime(expirationTime, dateFormat)		
	
		if formattedCurrentTimestamp > formattedExpirationTime:
			print('their session has expired:', expirationTime)
			deleteRow = "DELETE FROM session_data WHERE session_data_id = " + str(userID) + ";"
			cursor.execute(deleteRow)
			connection.commit()

			try:
				parts = profile_image_name.split('/')
				directory_name = parts[0]
				shutil.rmtree('Cache/' + directory_name)
				print('session folder successfully deleted')
			except:
				print('failed deleting:', profile_image_name)
		else:
			print('user: ', userID, ' active')

	k += 1

if result == []:
	print('no user currently signed in')

