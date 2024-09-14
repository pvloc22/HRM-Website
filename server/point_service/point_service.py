from flask import Flask, jsonify, request
from flask_cors import CORS
import requests


app = Flask(__name__)
CORS(app)





_port = 8004
_url = 'http://localhost:' + str(_port)


mylist = {}


mock_employees = [
	{'id':1,'point':161000},
	{'id':2,'point':174000},
	{'id':3,'point':335000}
]


mock_products = [
	{'id':1,'name':'Voucher Haidilao 50%','price':199000},
	{'id':2,'name':'Voucher Katinat 20%','price':54000},
]





mylist.update({'D_mypoint': _url + '/api/urbox/mypoint'})
@app.route('/api/urbox/mypoint', methods = ['POST'])
def mypoint():
	myid = int(request.form.get('myid'))
	pt = 0
	for item in mock_employees:
		if item['id'] == myid:
			pt = item['point']
			break
	return jsonify(str(pt))



mylist.update({'D_list_products': _url + '/api/urbox/list_products'})
@app.route('/api/urbox/list_products', methods=['POST'])
def list_products():
	return jsonify(mock_products)



mylist.update({'D_list_employees': _url + '/api/urbox/list_employees'})
@app.route('/api/urbox/list_employees', methods=['POST'])
def list_employees():
	myid = int(request.form.get('myid'))
	data = []
	for i in mock_employees:
		if i['id'] != myid:
			data.append(i['id'])
	return jsonify(data)



mylist.update({'D_give_pt': _url + '/api/urbox/give_pt'})
@app.route('/api/urbox/give_pt', methods=['POST'])
def give_pt():
	myid		= int(request.form.get('myid'))
	inputid		= int(request.form.get('inputid'))
	inputpoint	= int(request.form.get('inputpoint'))
	data = 0
	for i in mock_employees:
		if i['id'] == inputid:
			i['point'] += inputpoint
			for j in mock_employees:
				if j['id'] == myid:
					j['point'] -= inputpoint
					data = j['point']
					break
			break
	return jsonify(str(data))




service_data = {
    "name": "point-service",
    "url" : "http://localhost:8004"
}
response = requests.post("http://127.0.0.1:5000/register", json=service_data)


if __name__ == '__main__':
	app.run(port=_port, debug=True)

