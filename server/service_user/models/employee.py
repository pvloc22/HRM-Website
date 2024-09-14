# models/employee.py
from flask_sqlalchemy import SQLAlchemy
import requests

db = SQLAlchemy()

class EmployeeProfile(db.Model):
    __tablename__ = 'employee_profiles'
    
    id = db.Column(db.Integer, primary_key=True)
    full_name = db.Column(db.String(255), nullable=False)
    identification_number = db.Column(db.String(20), unique=True, nullable=False)
    tax_code = db.Column(db.String(20), unique=True)
    address = db.Column(db.Text)
    phone_number = db.Column(db.String(15))
    bank_account_number = db.Column(db.String(30))
    created_at = db.Column(db.DateTime, default=db.func.current_timestamp())
    updated_at = db.Column(db.DateTime, default=db.func.current_timestamp(), onupdate=db.func.current_timestamp())

