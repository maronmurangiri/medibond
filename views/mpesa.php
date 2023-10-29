// URL
[POST] https://sandbox.safaricom.co.ke/mpesa/stkpush/v1/processrequest

// HEADERS
Host: sandbox.safaricom.co.ke
Authorization: Bearer [access token]
Content-Type: application/json

// BODY
{
    "BusinessShortCode": "174379",
    "Password": "MTc0Mzc5YmZiMjc5ZjlhYTliZGJjZjE1OGU5N2RkNzFhNDY3Y2QyZTBjODkzMDU5YjEwZjc4ZTZiNzJhZGExZWQyYzkxOTIwMTgwNDA5MDkzMDAy",
    "Timestamp": "20180409093002",
    "TransactionType": "[Transaction Type]",
    "Amount": "1000",
    "PartyA": "254708374149",
    "PartyB": "174379",
    "PhoneNumber": "254708374149",
    "CallBackURL": "https://ip:port/"
    "AccountReference": "account",
    "TransactionDesc": "test" ,
}