from flask import Flask, jsonify, request
from flask_cors import CORS
from datetime import datetime
import random
import requests


app = Flask(__name__)
CORS(app)


_port = 8003
_url = 'http://localhost:' + str(_port)


mylist = {}


mock_events = [
	{'id':1 , 'date':'2024-07-27' , 'start':'08:00' , 'end':'09:00' , 'status':'Closed'},
	{'id':2 , 'date':'2024-07-28' , 'start':'08:00' , 'end':'08:30' , 'status':'Closed'},
	{'id':3 , 'date':'2024-07-29' , 'start':'16:00' , 'end':'17:00' , 'status':'Closed'},
	{'id':4 , 'date':'2024-07-30' , 'start':'15:00' , 'end':'16:30' , 'status':'Opening'}
]


mock_participants = [
	{'eid':1 , 'pid':1 , 'meter':210 , 'rank':1},
	{'eid':1 , 'pid':2 , 'meter':170 , 'rank':2},
	{'eid':1 , 'pid':3 , 'meter':160 , 'rank':3},
	{'eid':1 , 'pid':5 , 'meter':154 , 'rank':4},
	{'eid':1 , 'pid':6 , 'meter':87 , 'rank':5},
	{'eid':2 , 'pid':1 , 'meter':344 , 'rank':1},
	{'eid':2 , 'pid':4 , 'meter':255 , 'rank':2},
	{'eid':2 , 'pid':2 , 'meter':210 , 'rank':3},
	{'eid':2 , 'pid':5 , 'meter':111 , 'rank':4},
	{'eid':3 , 'pid':3 , 'meter':236 , 'rank':1},
	{'eid':3 , 'pid':4 , 'meter':214 , 'rank':2},
	{'eid':3 , 'pid':7 , 'meter':185 , 'rank':3},
	{'eid':3 , 'pid':6 , 'meter':123 , 'rank':4},
	{'eid':4 , 'pid':4 , 'meter':200 , 'rank':None},
	{'eid':4 , 'pid':3 , 'meter':210 , 'rank':None},
]






mylist.update({'C_get_all_events':_url + '/api/strava/get_all_events'})
@app.route('/api/strava/get_all_events', methods=['POST'])
def get_all_events():
	for i in mock_events:
		if i['status'] == 'Opening':
			flag = False
			if datetime.strptime(i['date'],'%Y-%m-%d').date() < datetime.now().date():
				flag = True
			else:
				if datetime.strptime(i['end'],'%H:%M').time() < datetime.now().time():
					flag = True
			if flag == True:
				i['status'] = 'Closed'
				theid = i['id']
				leng = len(mock_participants)
				for j in range(leng):
					if mock_participants[j]['eid'] == theid:
						for ii in range(j,leng):
							if mock_participants[ii]['eid'] != theid:
								break
							if mock_participants[ii]['eid'] == theid:
								for jj in range(ii+1, leng):
									if mock_participants[jj]['eid'] == theid and mock_participants[ii]['meter'] < mock_participants[jj]['meter']:
										mock_participants[ii], mock_participants[jj] = mock_participants[jj], mock_participants[ii]
						autoinc = 1
						for ii in range(j, leng):
							if mock_participants[ii]['eid'] != theid:
								break
							if mock_participants[ii]['eid'] == theid:
								if mock_participants[ii]['rank'] != None: break	
								mock_participants[ii]['rank'] = autoinc
								autoinc += 1
						break
	data = mock_events
	data = reversed(data)
	data = list(data)
	return jsonify(data)



mylist.update({'C_create_event':_url + '/api/strava/create_event'})
@app.route('/api/strava/create_event', methods=['POST'])
def create_event():
	date = request.form.get('date')
	start = request.form.get('start')
	end = request.form.get('end')
	id = mock_events[-1]['id'] + 1
	mock_events.append({'id': id , 'date': date , 'start': start , 'end': end , 'status':'Opening'})
	data = 'true'
	return jsonify(data)



mylist.update({'C_get_detail_event':_url + '/api/strava/get_detail_event'})
@app.route('/api/strava/get_detail_event', methods=['POST'])
def get_detail_event():
	eid = int(request.form.get('eid'))
	myid = int(request.form.get('myid'))
	data=[]
	flag = 'false'

	for i in mock_events:
		if i['id'] == eid:
			data.append(i)
			break

	par_arr = []
	for i in mock_participants:
		if i['eid'] == eid:
			if i['pid'] == myid: flag = 'true'
			par_arr.append(i)
	data.append(par_arr)
	
	data.append({'exist':flag})
	
	return jsonify(data)



mylist.update({'C_add_participant':_url + '/api/strava/add_participant'})
@app.route('/api/strava/add_participant', methods=['POST'])
def add_participant():
	eid = int(request.form.get('eid'))
	myid = int(request.form.get('myid'))
	mock_participants.append({'eid':eid , 'pid':myid , 'meter':random.randint(1,600) , 'rank':None})
	data = []
	for i in mock_participants:
		if i['eid'] == eid:
			data.append(i)
	return jsonify(data)






service_data = {
    "name": "activities-service",
    "url" : "http://localhost:8003"
}
response = requests.post("http://127.0.0.1:5000/register", json=service_data)

if __name__ == '__main__':
	app.run(debug=True, port=_port)
