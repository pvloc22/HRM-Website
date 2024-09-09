# controllers/employee_controller.py
from flask import Blueprint, request, jsonify
from models.employee import db, EmployeeProfile

employee_blueprint = Blueprint('employee', __name__)

@employee_blueprint.route('/employees', methods=['POST'])
def add_employee():
    data = request.json
    new_employee = EmployeeProfile(
        full_name=data['full_name'],
        identification_number=data['identification_number'],
        tax_code=data.get('tax_code'),
        address=data.get('address'),
        phone_number=data.get('phone_number'),
        bank_account_number=data.get('bank_account_number')
    )
    db.session.add(new_employee)
    db.session.commit()
    return jsonify({'message': 'Employee added successfully'}), 201

@employee_blueprint.route('/employees/<int:id>', methods=['PUT'])
def update_employee(id):
    employee = EmployeeProfile.query.get_or_404(id)
    data = request.json
    employee.full_name = data['full_name']
    employee.identification_number = data['identification_number']
    employee.tax_code = data.get('tax_code')
    employee.address = data.get('address')
    employee.phone_number = data.get('phone_number')
    employee.bank_account_number = data.get('bank_account_number')
    
    db.session.commit()
    return jsonify({'message': 'Employee updated successfully'})

@employee_blueprint.route('/employees/<int:id>', methods=['DELETE'])
def delete_employee(id):
    employee = EmployeeProfile.query.get_or_404(id)
    db.session.delete(employee)
    db.session.commit()
    return jsonify({'message': 'Employee deleted successfully'})

@employee_blueprint.route('/employees', methods=['GET'])
def get_employees():
    employees = EmployeeProfile.query.all()
    return jsonify([{
        'id': e.id,
        'full_name': e.full_name,
        'identification_number': e.identification_number,
        'tax_code': e.tax_code,
        'address': e.address,
        'phone_number': e.phone_number,
        'bank_account_number': e.bank_account_number,
        'created_at': e.created_at,
        'updated_at': e.updated_at
    } for e in employees])
