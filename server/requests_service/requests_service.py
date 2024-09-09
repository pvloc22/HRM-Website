from flask import Flask, render_template, request, g, jsonify
import requests
from mysql.connector import connection
from flask_cors import CORS


app = Flask(__name__)
CORS(app) 

app.config['MYSQL_HOST'] = 'localhost'
app.config['MYSQL_USER'] = 'root'
app.config['MYSQL_PASSWORD'] = 'Phamloc2002'
app.config['MYSQL_DB'] = 'timekeeping'

def getDB():
    if 'db' not in g or g.db.is_connected():
        g.db = connection.MySQLConnection(host=app.config['MYSQL_HOST'], user=app.config['MYSQL_USER'], password=app.config['MYSQL_PASSWORD'], database=app.config['MYSQL_DB'])
    return g.db

@app.teardown_appcontext
def teardown_db(exception):
    db = g.pop('db', None)

    if db is not None:
        db.close()


# User
@app.route("/user/request", methods=["post"])
def sendRequestWFH():
    data = request.form
    print(data)
    user_id = int(data.get('user_id'))
    email = data.get('email')
    fullname = data.get('fullname')
    phoneNumber = data.get('phone_number')
    id_card_number = data.get('id_card_number')

    title = data.get('title')
    content = data.get('content')
    type_request = data.get('type_request')
    start_date = data.get('start_date')
    end_date = data.get('end_date')

    # Connect database
    myDB = getDB()
    cursor = myDB.cursor()

    # cursor.callproc('check_user', [user_id, fullname, email, phoneNumber, id_card_number])

    cursor.callproc('add_request', [user_id, title, content, type_request, start_date, end_date])  # Truyền tham số nếu có

    # Lấy kết quả trả về nếu có
    for result in cursor.stored_results():
        data = result.fetchall()

    cursor.close()
    
    return jsonify(data), 200

# Manager
# Get all each type requests
@app.route("/manager/requests/work-from-home", methods=["Get"])
def getRequestWFH():
    # Connect database
    status_request = request.args.get('status')
    print(status_request)

    myDB = getDB()
    cursor = myDB.cursor()

    #Query 
    if status_request == "":
        cursor.execute(f'select *from requests where type_request=\'WFH\'')
    else:
        cursor.execute(f'select *from requests where type_request=\'WFH\' AND STATUS = \'{status_request}\'')
    # cursor.execute(f'select *from requests where type_request=\'WFH\' AND STATUS = \'\'')

    result = cursor.fetchall()

    cursor.close()
    return result

@app.route("/manager/requests/leave", methods=["Get"])
def getRequestL():

    status_request = request.args.get('status')

    # connect database
    myDB = getDB()
    cursor = myDB.cursor()

    # Query
    cursor.execute(f'select *from requests where type_request=\'Leave\' AND STATUS = \'{status_request}\'')
    result = cursor.fetchall()

    cursor.close()
    return result

@app.route("/manager/requests/update-time-sheet", methods=["Get"])
def getRequestUTS():
    status_request = request.args.get('status')

    # connect database
    myDB = getDB()
    cursor = myDB.cursor()

    # Query
    if status_request == "":
        cursor.execute(f'select * from requests where type_request=\'UTS\'')
    else:
        cursor.execute(f'select * from requests where type_request=\'UTS\ AND STATUS = \'{status_request}\'')
    result = cursor.fetchall()

    cursor.close()
    return result

# Get detail request
@app.route("/manager/request/deatail/<id_request>", methods=["Get"])
def getDetailRequest(id_request):
    # connect database
    myDB = getDB()
    cursor = myDB.cursor()

    # Query
    cursor.execute(f'select * from requests where request_id = {id_request}')
    result = cursor.fetchall()
    return result

# Update request
@app.route("/manager/request/conclusion", methods=["PUT"])
def conclusionRequest():
    data = request.form
    request_id = int(data.get('id'))
    handler = int(data.get('handler'))
    status = data.get('status')

    # Connect database
    myDB = getDB()
    cursor = myDB.cursor()

    cursor.callproc('update_status_request', [request_id, handler, status])
    return f"Manger put conclusion request"

service_data = {
    "name": "requests-service",
    "url" : "http://localhost:8000"
}
response = requests.post("http://127.0.0.1:5000/register", json=service_data)

if __name__ == "__main__":
    app.run(port=8000, debug=True)