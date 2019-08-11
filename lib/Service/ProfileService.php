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
     * Returns an array of social media profiles connected to a users account.
     *
     * @return array
     */
    public function getProfiles(): array
    {
        return $this->client->createHttpRequest('GET', 'profiles.json');
    }

    /**
     * Returns details of the single specified social media profile.
     *
     * @param string $profileID
     *
     * @return array
     */
    public function getProfile(string $profileID): array
    {
        return $this->client->createHttpRequest('GET', 'profiles/'.$profileID.'.json');
    }

    /**
     * Returns details of the posting schedules associated with a social media profile.
     *
     * @param string $profileID
     *
     * @return array
     */
    public function getSchedules(string $profileID): array
    {
        return $this->client->createHttpRequest('GET', 'profiles/'.$profileID.'/schedules.json');
    }

    /**
     * Set the posting schedules for the specified social media profile.
     *
     * @param string $profileID
     * @param array $schedules
     *
     * @return array
     */
    public function updateSchedules(string $profileID, array $schedules): array
    {
        if (is_array($schedules)) {
            //TODO: Implement array
        }

        $payload = array('schedules' => array());
        $payload['schedules'][] = array(
            'days'  => $schedules->getDays(),
            'times' => $schedules->getTimes(),
        );

        return $this->client->createHttpRequest(
            'POST',
            'profiles/'.$profileID.'/schedules/update.json',
            [
                'body' => $payload,
            ]
        );
    }
}
