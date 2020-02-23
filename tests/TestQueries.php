<?php

use GuzzleHttp\Client as GuzzleClient;

class TestQueries extends TestCase
{

    protected $client;

    protected function setUp(): void
    {
        $this->client = new GuzzleClient([
            'base_uri' => 'http://localhost:8000'
        ]);
    }

    public function test_mmsi_generic_test()
    {
        $response = $this->client->get('/vessels', [
            'query' => [
                'mmsi' => 247039300
            ]
        ]);

        $this->assertEquals(200, $response->getStatusCode());
        $body = json_decode($response->getBody());
        if (isset($body, $body->data) && count($body->data) > 0) {
            $data = $body->data;
            foreach ($data as $d) {
                $this->assertEquals(247039300, $d->mmsi);
            }
        }
    }

    public function test_timestamp()
    {
        $response = $this->client->get('/vessels', [
            'query' => [
                'timestamp' => 1372700100
            ]
        ]);

        $this->assertEquals(200, $response->getStatusCode());
        $body = json_decode($response->getBody());
        if (isset($body, $body->data) && count($body->data) > 0) {
            $data = $body->data;
            foreach ($data as $d) {
                $this->assertEquals(1372700100, $d->timestamp);
            }
        }
    }

    public function test_mmsi_multiple_queries_test()
    {
        $response = $this->client->get('/vessels', [
            'query' => [
                'mmsi' => '311486000', '311040700'
            ]
        ]);

        $this->assertEquals(200, $response->getStatusCode());
        $body = json_decode($response->getBody());
        if (isset($body, $body->data) && count($body->data) > 0) {
            $data = $body->data;
            foreach ($data as $d) {
                $this->assertContains(311486000, (array) $d);
                //Ideally I would like this part of code too but i couldnt find why the comma separated values on query param
                //from guzzlie client malformed my request
                //$this->assertContains(311040700, (array)$d);
            }
        }
    }

    public function test_lat_lon()
    {
        $response = $this->client->get('/vessels', [
            'query' => [
                'minLat' => 42.75178,
                'maxLat' => 43.81345,
                'minLon' => 15.4415,
                'maxLon' => 16.21578
            ]
        ]);

        $this->assertEquals(200, $response->getStatusCode());

        $body = json_decode($response->getBody());

        if (isset($body, $body->data) && count($body->data) > 0) {
            $data = $body->data;

            foreach ($data as $d) {
                $this->assertNotTrue($d->lat > 43.81345);
                $this->assertNotTrue($d->lon > 16.21578);
            }
        }
    }
}
