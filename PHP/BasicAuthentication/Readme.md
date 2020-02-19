<div align="center">
	<img src="../../assets/images/logos/languages/php.svg" width="180" alt="PHP">
</div>

# PHP Integration
PHP code for integration with FourKites API.

## Credentials
Please, add your credentials to use the API.

```php
// Credentials
$credentials = [
    'username'      => '',
    'password'      => ''
];
```

> If you don't have credentials, please, contact FourKites Support Team at `support@fourkites.com`.

---

## Tracking Locations
Use this option to send a single location update per request.

```php
// Location to be sent
$content = [
    'shipper'       => '',  // An internal code to identify the shipper
    'billOfLading'  => '',  // Load/shipment number
    'tractorNumber' => '',  // Truck plate
    'trailerNumber' => '',  // Trailer plate
    'latitude'      => 0,   // Latitude (decimal) e.g.: 60.16952
    'longitude'     => 0,   // Longitude (decimal) e.g.: 24.93545
    'locatedAt'     => ''   // Date and time ("Y-m-d H:i:s")
];
```

### Resource
> [resources/tracking_locations.php](./resources/tracking_locations.php)

---

## Tracking Locations Batch
Use this option to send multiple location updates at once. _(Limited to 50 locations per request)_

Please, add each new location information to the `$content['locations']` array.
> Each location information can be added in this format:
```php
[
    'shipper'       => '',  // Internal code to identify the shipper
    'billOfLading'  => '',  // Load/shipment Number
    'tractorNumber' => '',  // Truck plate
    'trailerNumber' => '',  // Trailer plate
    'latitude'      => 0,   // Latitude (decimal) e.g.: 60.16952
    'longitude'     => 0,   // Longitude (decimal) e.g.: 24.93545
    'locatedAt'     => ''   // Date and time ("Y-m-d H:i:s")
]
```

### Resource
> [resources/tracking_locations_batch.php](./resources/tracking_locations_batch.php)

---

## Additional Information
Additional information can be sent. Please, check the FourKites API documentation for:
* [Tracking Locations](https://support.fourkites.com/hc/en-us/articles/115007622407-Tracking-Locations-Batch#TrackingLocations-Batch-REQUESTFORMAT "Request Format")
* [Tracking Locations Batch](https://support.fourkites.com/hc/en-us/articles/115007779288-Tracking-Locations#TrackingLocations-REQUESTFORMAT "Request Format")