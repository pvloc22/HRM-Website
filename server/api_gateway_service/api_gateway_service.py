from flask import Flask, request, jsonify
import requests
from flask_cors import CORS
from urllib.parse import urlencode

app = Flask(__name__)
CORS(app) 
service_registry_url = 'http://127.0.0.1:5000/discover'

@app.route('/api/<service_name>/<path:endpoint>', methods=['GET', 'POST', 'PUT'])
def api_gateway(service_name, endpoint):
    
    # Gửi yêu cầu đến Service Registry để tìm địa chỉ của service
    resp = requests.get(f"{service_registry_url}/{service_name}")
    
    if resp.status_code == 404:
        return jsonify({"message": "Service not found"}), 404

    query_string = urlencode(request.args)
    service_url = resp.json().get('url')
    full_url = f"{service_url}/{endpoint}"

    if query_string:
        full_url += f"?{query_string}"

    # Chuyển tiếp yêu cầu đến service đã được tìm thấy
    service_resp = requests.request(
        method=request.method,
        url=full_url,
        headers={key: value for key, value in request.headers.items() if key != 'Host'},
        data=request.get_data(),
        cookies=request.cookies
    )
    return (service_resp.content, service_resp.status_code, service_resp.headers.items())

if __name__ == '__main__':
    app.run(port=5500, debug=True)
