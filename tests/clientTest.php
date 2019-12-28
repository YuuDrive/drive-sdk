<?php
use PHPUnit\Framework\TestCase;
use YuuDrive\DriveSDK\Client;

class YuuTest extends TestCase
{
    public function setUp(): void
    {
        $client_id = '';
        $client_secret = '';
        $developer_key = '';
        $redirect_uri = 'http://example.com/callback';

        $this->client = new Client($client_id, $client_secret, $developer_key, $redirect_uri);
    }

    public function testRefreshToken() {
        $refresh = $this->client->fetchAccessTokenWithRefreshToken("YOUR_REFRESH_TOKEN");
        $this->assertSame($refresh->getResponseCode(), 200);
    }
    
    public function testGetFile() {
        try {
            $getFile = $this->client->getFile('1ZPzioGIjIHuPST3HoJdsC-K1UkrzQluy');
            $this->assertSame($getFile->getResponseCode(), 200);
        } catch (\YuuDrive\DriveSDK\Exceptions\FileNotFoundException $e) {
            $this->assertSame($e->getCode(), 404);
        }
    }
}