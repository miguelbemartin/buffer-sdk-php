<?php

namespace BufferSDK\Service;

use BufferSDK\Http\ClientInterface;
use BufferSDK\Model\Schedule;

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
        return $this->client->createHttpRequest('GET', "profiles/{$profileID}.json");
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
        return $this->client->createHttpRequest('GET', "profiles/{$profileID}/schedules.json");
    }

    /**
     * Set the posting schedule for the specified social media profile.
     *
     * @param string $profileID
     * @param Schedule $schedule
     *
     * @return array
     */
    public function updateSchedule(string $profileID, Schedule $schedule): array
    {
        $payload = ['schedules' => []];
        $payload['schedules'][] = [
            'days' => $schedule->getDays(),
            'times' => $schedule->getTimes(),
        ];

        return $this->client->createHttpRequest(
            'POST',
            "profiles/{$profileID}/schedules/update.json",
            [
                'body' => $payload,
            ]
        );
    }
}
