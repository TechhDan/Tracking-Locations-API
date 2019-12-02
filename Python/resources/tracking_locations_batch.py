import json
import requests
from requests.auth import HTTPBasicAuth

# Credentials
credentials = {
    'username'      : '',
    'password'      : ''
}

# Location to be sent
content = {
    'locations': [
        # Add up to 50 locations to this array
        
        {
            'shipper'       : '',  # An internal code to identify the shipper
            'billOfLading'  : '',  # Load/shipment Number
            'tractorNumber' : '',  # Truck plate
            'trailerNumber' : '',  # Trailer plate
            'latitude'      : 0,   # Latitude (decimal) e.g.: 60.16952
            'longitude'     : 0,   # Longitude (decimal) e.g.: 24.93545
            'locatedAt'     : ''   # Date and time ("%Y-%m-%d %H:%M:%S")
        },
        
        {
            'shipper'       : '',  # An internal code to identify the shipper
            'billOfLading'  : '',  # Load/shipment Number
            'tractorNumber' : '',  # Truck plate
            'trailerNumber' : '',  # Trailer plate
            'latitude'      : 0,   # Latitude (decimal) e.g.: 60.16952
            'longitude'     : 0,   # Longitude (decimal) e.g.: 24.93545
            'locatedAt'     : ''   # Date and time ("%Y-%m-%d %H:%M:%S")
        }
        
    ]
}

# Generating the Payload
payload = json.dumps(content)

# Send the request
request = requests.post(
    'https://tracking-api.fourkites.com/api/v1/tracking/batch_locations',
    data = payload,
    auth = HTTPBasicAuth(credentials['username'], credentials['password']),
    headers = {'Content-Type': 'application/json'}
)

# Do whatever you need at this point
response = request
if response.status_code != 200:
    # Unsuccessful Response
    print(response.text)
else:
    # Successful Response
    print 'Location successfuly sent!'