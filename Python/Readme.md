<div align="center">
	<img src="../assets/images/logos/languages/python.svg" width="180" alt="Python">
</div>

# Python Integration
Python code for integration with FourKites API.

## Credentials
Please, add your credentials to the array in order to be able to use the API.

```python
# Credentials
credentials = {
    'username'      : '',
    'password'      : ''
}
```

> If you don't have credentials, please, contact FourKites Support Team at `support@fourkites.com`.

---

## Tracking Locations
Use this option to send a single location update per request.

```python
# Location to be sent
content = {
    'shipper'       : '',  # An internal code to identify the shipper
    'billOfLading'  : '',  # Load/shipment Number
    'tractorNumber' : '',  # Truck plate
    'trailerNumber' : '',  # Trailer plate
    'latitude'      : 0,   # Latitude (decimal) e.g.: 60.16952
    'longitude'     : 0,   # Longitude (decimal) e.g.: 24.93545
    'locatedAt'     : ''   # Date and time ("%Y-%m-%d %H:%M:%S")
}
```

### Resource
> [resources/tracking_locations.py](./resources/tracking_locations.py)

---

## Tracking Locations Batch
Use this option to send multiple locations updates at once. _(Limited to 50 locations per request)_

Please, add each location information to the `content['locations']` dict.
> Each location information can be added in this format:
```python
{
    'shipper'       : '',  # An internal code to identify the shipper
    'billOfLading'  : '',  # Load/shipment Number
    'tractorNumber' : '',  # Truck plate
    'trailerNumber' : '',  # Trailer plate
    'latitude'      : 0,   # Latitude (decimal) e.g.: 60.16952
    'longitude'     : 0,   # Longitude (decimal) e.g.: 24.93545
    'locatedAt'     : ''   # Date and time ("%Y-%m-%d %H:%M:%S")
}
```

### Resource
> [resources/tracking_locations_batch.py](./resources/tracking_locations_batch.py)

---

## Additional Information
Additional information can be sent. Please, check the FourKites API documentation for:
* [Tracking Locations](https://support.fourkites.com/hc/en-us/articles/115007622407-Tracking-Locations-Batch#TrackingLocations-Batch-REQUESTFORMAT "Request Format")
* [Tracking Locations Batch](https://support.fourkites.com/hc/en-us/articles/115007779288-Tracking-Locations#TrackingLocations-REQUESTFORMAT "Request Format")