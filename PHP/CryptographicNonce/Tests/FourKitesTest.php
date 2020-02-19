<?php

declare(strict_types=1);

namespace FourKites\Test;

use FourKites\FourKitesAPI;
use PHPUnit\Framework\TestCase;

class FourKitesTest extends TestCase
{
    const DEMO_CLIENT_ID = 'e9d353fe-42fb-4eb4-b0b4-a11f4cb6c191';
    const DEMO_CLIENT_SECRET = 'a71ed2db684480d110f76699983d195fb77af45910fff945d1ab3707a4b56fe5=';

    public function samplePayloadProvider()
    {
        return [
            [
                'https://tracking-api.fourkites.com/api/v1/tracking?shipper=xyzshipper&load_ids=12345&pickup_start_date=2015-09-01&client_id=e9d353fe-42fb-4eb4-b0b4-a11f4cb6c191&timestamp=20150929095116&signature=Zit_p9uXdRne5eWseSnMvW63kPI=',
                '/api/v1/tracking',
                false,
                20150929095116,
                [
                    'shipper' => 'xyzshipper',
                    'load_ids' => '12345',
                    'pickup_start_date' => '2015-09-01'
                ]
            ],
            [
                'https://tracking-api-staging.fourkites.com/api/v1/tracking/locations?client_id=e9d353fe-42fb-4eb4-b0b4-a11f4cb6c191&timestamp=20150929095116&signature=pJwYfd9Bz6DviWbkVmdOSC-ULJo=',
                '/api/v1/tracking/locations',
                true,
                20150929095116,
                []
            ]
        ];
    }

    /**
     * @dataProvider samplePayloadProvider
     */
    public function testGenerateSampleSignature($expectedURL, $uri, $staging, $timestamp, $params)
    {
        $fourkites = new FourKitesAPI(
            self::DEMO_CLIENT_ID,
            self::DEMO_CLIENT_SECRET
        );
        $fourkites->setStagingEnvironment($staging);
        $fourkites->setTimeStamp($timestamp);
        $this->assertSame(
            $expectedURL,
            $fourkites->getSignatureURL($uri, $params)
        );
    }

    public function testSendTrackingLocationsRequest()
    {
        $fourkites = new FourKitesAPI(
            getenv('CLIENT_ID'),
            getenv('CLIENT_SECRET')
        );
        $fourkites->setStagingEnvironment(false);

        $response = $fourkites->sendRequest(
            '/api/v1/tracking/locations',
            [],
            [
                'shipper' => 'xyzshipper',
                'billOfLading' => 'BILL12345',
                'tractorNumber' => '12345',
                'trailerNumber' => '1122',
                'driverPhone' => '786-221-4477',
                'latitude' => '25.7745',
                'longitude' => '-80.1709',
                'scac' => '12311', 
                'railEquipmentInitials' => 'ABCD',
                'railEquipmentNumber' => '123456',
                'isBrokeredLoad' => 'true',
                'leg' => '2'
            ]
        );
        $this->assertSame(200, $response['statusCode']);
    }

    public function testSendTrackingLocationsBatchRequest()
    {
        $fourkites = new FourKitesAPI(
            getenv('CLIENT_ID'),
            getenv('CLIENT_SECRET')
        );
        $fourkites->setStagingEnvironment(false);
        $response = $fourkites->sendRequest(
            '/api/v1/tracking/batch_locations',
            [],
            [
                'locations' => [
                    [
                        'shipper' => 'xyzshipper',
                        'billOfLading' => 'BILL12345',
                        'tractorNumber' => '12345',
                        'trailerNumber' => '1122',
                        'driverPhone' => '786-221-4477',
                        'latitude' => '25.7745',
                        'longitude' => '-80.1709',
                        'scac' => '12311', 
                        'railEquipmentInitials' => 'ABCD',
                        'railEquipmentNumber' => '123456',
                        'isBrokeredLoad' => 'true',
                        'leg' => '2'
                    ],
                    [
                        'shipper' => 'abcshipper',
                        'billOfLading' => 'BILL56678',
                        'tractorNumber' => '54321',
                        'trailerNumber' => '2211',
                        'driverPhone' => '786-112-2234',
                        'latitude' => '40.7128',
                        'longitude' => '-74.0060',
                        'scac' => '3322', 
                        'railEquipmentInitials' => 'EFGH',
                        'railEquipmentNumber' => '654321',
                        'isBrokeredLoad' => 'true',
                        'leg' => '1'
                    ]
                ]
            ]
        );
        $this->assertSame(200, $response['statusCode']);
    }
}
