require 'net/http'
require 'uri'
require 'json'

# Credentials
credentials = {
    'username'      => '',
    'password'      => ''
}

# Location to be sent
content = {
    'locations' => [
        # Add up to 50 locations to this array
        
        {
            'shipper'       => '',  # An internal code to identify the shipper
            'billOfLading'  => '',  # Load/shipment Number
            'tractorNumber' => '',  # Truck plate
            'trailerNumber' => '',  # Trailer plate
            'latitude'      => 0,   # Latitude (decimal) e.g.: 60.16952
            'longitude'     => 0,   # Longitude (decimal) e.g.: 24.93545
            'locatedAt'     => ''   # Date and time ("%Y-%m-%d %H:%M:%S")
        },
        
        {
            'shipper'       => '',  # An internal code to identify the shipper
            'billOfLading'  => '',  # Load/shipment Number
            'tractorNumber' => '',  # Truck plate
            'trailerNumber' => '',  # Trailer plate
            'latitude'      => 0,   # Latitude (decimal) e.g.: 60.16952
            'longitude'     => 0,   # Longitude (decimal) e.g.: 24.93545
            'locatedAt'     => ''   # Date and time ("%Y-%m-%d %H:%M:%S")
        }
        
    ]
}

# Generating the Payload
payload = content.to_json

# Send the request
uri = URI.parse('https://tracking-api.fourkites.com/api/v1/tracking/batch_locations')
request = Net::HTTP::Post.new(uri)
request.basic_auth(credentials['username'], credentials['password'])
request['Content-Type'] = 'application/json'
request.body = payload
request = Net::HTTP.start(uri.hostname, uri.port, use_ssl: uri.scheme == 'https') do |http|
  http.request(request)
end

response = JSON.parse(request.body)
if request.code != '200'
    # Unsuccessful Response
    puts response
else
    # Successful Response
    puts 'Location successfuly sent!'
end