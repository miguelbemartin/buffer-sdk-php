<?php

namespace BufferSDK\Service;

use BufferSDK\Http\ClientInterface;
use BufferSDK\Model\Update;

class UpdateService
{
    /** @var ClientInterface */
    private $client;

    /**
     * UpdateService constructor.
     *
     * @param $client
     */
    public function __construct(ClientInterface $client)
    {
        $this->client = $client;
    }

    /**
     * Returns a single social media update.
     *
     * @param string $profileID
     *
     * @return array
     */
    public function getUpdates(string $profileID): array
    {
        return $this->client->createHttpRequest('GET', "updates/{$profileID}.json");
    }

    /**
     * Returns an array of updates that are currently in the buffer for an
     * individual social media profile.
     *
     * @return array
     */
    public function getPendingUpdates(string $profileID, int $page = 1, int $count = 100, string $since = "", bool $utc = false): array
    {
        return $this->client->createHttpRequest('GET', "profiles/{$profileID}/updates/pending.json?page={$page}&count={$count}&since={$since}&utc={$utc}");
    }

    /**
     * Returns an array of updates that have been sent from the buffer for an
     * individual social media profile.
     *
     * @return array
     */
    public function getSentUpdates(string $profileID, int $page = 1, int $count = 100, string $since = "", bool $utc = false, string $filter = ""): array
    {
        return $this->client->createHttpRequest('GET', "profiles/{$profileID}/updates/sent.json?page={$page}&count={$count}&since={$since}&utc={$utc}&filter={$filter}");
    }

    /**
     * Edit the order at which statuses for the specified social media profile will
     * be sent out of the buffer.
     *
     * @param string $profileID
     * @param array $order
     *
     * @return array
     */
    public function reorderUpdates(string $profileID, array $order, ?int $offset = null, bool $utc = false): array
    {
        return $this->client->createHttpRequest(
            'POST',
            "profiles/{$profileID}/updates/reorder.json",
            [
                'body' => [
                    'order' => $order,
                    'offset' => $offset,
                    'utc' => $utc,
                ],
            ]
        );
    }

    /**
     * Randomize the order at which statuses for the specified social media profile
     * will be sent out of the buffer.
     *
     * @param string $profileID
     * @param int|null $count
     * @param bool $utc
     *
     * @return array
     */
    public function shuffleUpdates(string $profileID, ?int $count = null, bool $utc = false): array
    {
        return $this->client->createHttpRequest(
            'POST',
            "profiles/{$profileID}/updates/shuffle.json",
            [
                'body' => [
                    'count' => $count,
                    'utc' => $utc,
                ],
            ]
        );
    }

    /**
     * Create a new status update for one or more profiles.
     *
     * @param Update $update
     */
    public function createUpdate(Update $update): array
    {
        $update->validate();

        $payload = [
            'text' => $update->text,
            'profile_ids' => $update->profiles,
            'shorten' => $update->shorten,
            'now' => $update->now,
            'top' => $update->top,
        ];

        if (!empty($update->media)) {
            $payload['media'] = $update->media;
        }
        if (!is_null($update->scheduled_at)) {
            $payload['scheduled_at'] = $update->scheduled_at;
        }

        return $this->client->createHttpRequest(
            'POST',
            'updates/create.json',
            [
                'body' => $payload,
            ]
        );
    }

    /**
     * Edit an existing, individual status update.
     *
     * @param Update $update
     */
    public function updateUpdate(Update $update): array
    {
        $update->validate();

        $payload = [
            'text' => $update->text,
            'now' => $update->now,
        ];

        if (!empty($update->media)) {
            $payload['media'] = $update->media;
        }
        if (!is_null($update->scheduled_at)) {
            $payload['scheduled_at'] = $update->scheduled_at;
        }

        return $this->client->createHttpRequest(
            'POST',
            "updates/{$update->id}/update.json",
            [
                'body' => $payload,
            ]
        );
    }

    /**
     * Immediately shares a single pending update and recalculates times for updates
     * remaining in the queue.
     *
     * @param string $updateID
     */
    public function shareUpdate(string $updateID): array
    {
        return $this->client->createHttpRequest(
            'POST',
            "updates/{$updateID}/share.json"
        );
    }

    /**
     * Permanently delete an existing status update.
     *
     * @param string $updateID
     */
    public function deleteUpdate(string $updateID): array
    {
        return $this->client->createHttpRequest(
            'POST',
            "updates/{$updateID}/destroy.json"
        );
    }

    /**
     * Move an existing status update to the top of the queue and recalculate times
     * for all updates in the queue. Returns the update with its new posting time.
     *
     * @param string $updateID
     *
     * @return array
     */
    public function moveToTopUpdate(string $updateID): array
    {
        return $this->client->createHttpRequest(
            'POST',
            "updates/{$updateID}/move_to_top.json"
        );
    }

    /**
     * Returns an object with a the numbers of shares a link has had using Buffer.
     *
     * @param string $url string URL-encoded URL of the page for which the number of shares is requested.
     *
     * @return array
     */
    public function getSharesLink(string $url): array
    {
        return $this->client->createHttpRequest('GET', "links/shares.json?url={$url}");
    }
}
