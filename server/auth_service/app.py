from flask import Flask, request, jsonify
import requests
from flask_cors import CORS
from flask_jwt_extended import JWTManager, create_access_token
from flask_bcrypt import Bcrypt
from pymongo import MongoClient

app = Flask(__name__)
CORS(app) 

# connect mongodb
client =  MongoClient('localhost', 27017)
db = client.users
db_users = db.users


jwt = JWTManager(app)
bcrypt = Bcrypt(app)

app.config['JWT_SECRET_KEY'] = 'phamloc'

@app.route("/register", methods=["Post"])
def register():
    data = request.get_json()
    username = data.get("username")
    password = data.get("password")
    role = data.get("role")

    # Hash password  
    hash_password = bcrypt.generate_password_hash(password).decode('utf-8') 
    # Count document in database
    count = db_users.count_documents({})

    result =  db_users.insert_one({'user_id': count,'username': username, 'password': hash_password, 'role': role})

    if result.inserted_id:
        return jsonify({"message": "Document inserted successfully.", "inserted_id": str(result.inserted_id)}), 201
    else:
        return jsonify({"message": "Failed to insert document."}), 500

@app.route("/login", methods=["Post"])
def login():
    data = request.get_json()
    username = data.get("username")
    password = data.get("password")

    user = db_users.find_one({'username': username})
    if user:
        if bcrypt.check_password_hash(user['password'], password):
            access_token = create_access_token(identity=username)
            return jsonify({"message": "User login successfully", "access_token": access_token, "username": username, "user_id": user['user_id'], "role": user['role']}), 200
        else:
            return jsonify({"message": "Password is false"}), 500
    else:
        return jsonify({"message": "User not exist"}), 500



service_data = {
    "name": "auth-service",
    "url" : "http://localhost:8002"
}
response = requests.post("http://127.0.0.1:5000/register", json=service_data)
print(response.json()['message'])
if __name__ == "__main__":
    # register service

    app.run(port=8002, debug=True) 