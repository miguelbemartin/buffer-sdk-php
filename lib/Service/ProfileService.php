<?php

namespace BufferSDK\Service;

use BufferSDK\Http\ClientInterface;

class ProfileService
{
    /** @var ClientInterface */
    private $client;

    /**
     * ProfileService constructor.
     *
     * @param $client
     */
    public function __construct(ClientInterface $client)
    {
        $this->client = $client;
    }

    /**
     * @return array
     */
    public function getProfiles()
    {
        return $this->client->createHttpRequest('GET', 'profiles.json');
    }

    /**
     * @param string $profileID
     * @return array
     */
    public function getProfile(string $profileID)
    {
        return $this->client->createHttpRequest('GET', 'profiles/'.$profileID.'.json');
    }

    /**
     * @param string $profileID
     * @return array
     */
    public function getSchedules(string $profileID)
    {
        return $this->client->createHttpRequest('GET', 'profiles/'.$profileID.'/schedules.json');
    }

    /**
     * @param string $profileID
     * @param array $schedules
     * @return array
     */
    public function updateSchedules(string $profileID, array $schedules)
    {
        return $this->client->createHttpRequest(
            'POST',
            'profiles/'.$profileID.'/schedules/update.json',
            [
                'body' => $schedules,
            ]
        );
    }
}
