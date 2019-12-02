<div align="center">
	<img src="../assets/images/logos/languages/postman.svg" width="180" alt="Postman">
</div>

# Postman Integration
Postman collection for integration with FourKites API.

## Recomendations
It's recomended importing both '**collection**' and '**environment**' variables to your Postman.

## Collection
Within the collection, you will find [Tracking Locations](#Tracking-Locations) and [Tracking Locations Batch](#Tracking-Locations-Batch) endpoints available.
<div align="center">
	<img src="../assets/images/setup/postman/collections_list.jpg?e6f68099ddf3bef49080ff73987b54cc" width="400" alt="Tracking Locations API collection">
</div>

## Credentials
If you have imported the environment variables, please, fill your credentials in the environment popup box.
<div align="center">
	<img src="../assets/images/setup/postman/environments_variables.jpg?503e4b33fe7cf6d14296ea06710d3359" width="650" alt="Environment variables">
</div>

If you have not imported the variables, you can fill this information directly in the **Username** and **Password** fields under the **Auth** tab.
<div align="center">
	<img src="../assets/images/setup/postman/authentication_type.jpg?88d8ebdd87eaf7aaa509931a64cc7895" width="650" alt="Authentication tab">
</div>

> If you don't have credentials, please, contact FourKites Support Team at `support@fourkites.com`.

---

## Tracking Locations
Use this option to send a single location update per request.

```json
{
    "shipper": "",
    "billOfLading": "",
    "tractorNumber": "",
    "trailerNumber": "",
    "latitude": 0,
    "longitude": 0,
    "locatedAt": ""
}
```

---

## Tracking Locations Batch
Use this option to send multiple locations updates at once. _(Limited to 50 locations per request)_

Please, add each location information to the `content.locations` array.
> Each location information can be added in this format:
```json
{
    "shipper": "",
    "billOfLading": "",
    "tractorNumber": "",
    "trailerNumber": "",
    "latitude": 0,
    "longitude": 0,
    "locatedAt": ""
}
```

---

## Resources
> [Collection] [Tracking_Locations_API.postman_collection.json](./Tracking_Locations_API.postman_collection.json)
&nbsp;

> [Environment Variables] [Tracking_Locations_API.postman_environment.json](./Tracking_Locations_API.postman_environment.json)

---

## Additional Information
A brief explanation of the fields that need to be sent.

| Key | Description | Example |
| --- | --- | --- |
|`shipper`|The internal code to identify the shipper|124df|
|`billOfLading`|The load/shipment lumber|423987672|
|`tractorNumber`|The truck plate|ABC1234|
|`trailerNumber`|The trailer plate|FKT2K20|
|`latitude`|The Latitude in decimal format|60.16952|
|`longitude`|The Longitude in decimal formal|24.93545|
|`locatedAt`|The date and time formatted as YYYY-MM-DD HH:MM:SS|2020-01-25 17:30:43|

Additional information can be sent. Please, check FourKites documentation to 
* [Tracking Locations](https://support.fourkites.com/hc/en-us/articles/115007622407-Tracking-Locations-Batch#TrackingLocations-Batch-REQUESTFORMAT "Request Format")
* [Tracking Locations Batch](https://support.fourkites.com/hc/en-us/articles/115007779288-Tracking-Locations#TrackingLocations-REQUESTFORMAT "Request Format")