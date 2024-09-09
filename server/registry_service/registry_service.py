from flask import Flask, request, jsonify
from flask_cors import CORS

app = Flask(__name__)
CORS(app) 

# List service to be store key-value(name-url).
services = {}

@app.route('/services', methods=['GET'])
def view_services_register():
    return services, 200


@app.route('/register', methods=['POST'])
def register_service():

    service_data = request.json
    service_name = service_data['name']
    service_url = service_data['url']

    services[service_name] = service_url
    return jsonify({"message": "Service registered successfully"}), 200

@app.route('/discover/<service_name>', methods=['GET'])
def discover_service(service_name):
    service_url = services.get(service_name)
    if not service_url:
        return jsonify({"message": "Service not found"}), 404
    return jsonify({"url": service_url}), 200

if __name__ == '__main__':
    app.run(port=5000)
