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
     * @return array
     */
    public function getUpdates(string $profileID)
    {
        return $this->client->createHttpRequest('GET', 'updates/'.$profileID.'.json');
    }

    /**
     * Returns an array of updates that are currently in the buffer for an
     * individual social media profile.
     *
     * @param string $profileID
     * @return array
     */
    public function getPendingUpdates(string $profileID)
    {
        //TODO: Add parameters
        return $this->client->createHttpRequest('GET', 'profiles/'.$profileID.'/updates/pending.json');
    }

    /**
     * Returns an array of updates that have been sent from the buffer for an
     * individual social media profile.
     *
     * @param string $profileID
     * @return array
     */
    public function getSentUpdates(string $profileID)
    {
        //TODO: Add parameters
        return $this->client->createHttpRequest('GET', 'profiles/'.$profileID.'/updates/sent.json');
    }

    /**
     * Edit the order at which statuses for the specified social media profile will
     * be sent out of the buffer.
     *
     * @param string $profileID
     * @param array $order
     * @return array
     */
    public function reorderUpdates(string $profileID, array $order)
    {
        //TODO: Validate parameters
        //TODO: Add parameters
        return $this->client->createHttpRequest(
            'POST',
            'profiles/'.$profileID.'/updates/reorder.json',
            [
                'body' => $order,
            ]
        );
    }

    /**
     * Randomize the order at which statuses for the specified social media profile
     * will be sent out of the buffer.
     *
     * @param string $profileID
     * @return array
     */
    public function shuffleUpdates(string $profileID)
    {
        //TODO: Validate parameters
        //TODO: Add parameters
        return $this->client->createHttpRequest(
            'POST',
            'profiles/'.$profileID.'/updates/shuffle.json',
            [
                'body' => null,
            ]
        );
    }

    /**
     * Create a new status update for one or more profiles.
     *
     * @param Update $update
     */
    public function createUpdate(Update $update)
    {
    }

    /**
     * Edit an existing, individual status update.
     *
     * @param Update $update
     */
    public function updateUpdate(Update $update)
    {
    }

    /**
     * Immediately shares a single pending update and recalculates times for updates
     * remaining in the queue.
     *
     * @param Update $update
     */
    public function shareUpdate(Update $update)
    {
    }

    /**
     * Permanently delete an existing status update.
     *
     * @param Update $update
     */
    public function deleteUpdate(Update $update)
    {
    }

    /**
     * Move an existing status update to the top of the queue and recalculate times
     * for all updates in the queue. Returns the update with its new posting time.
     *
     * @param string $updateID
     * @return array
     */
    public function moveToTopUpdate(string $updateID)
    {
        return $this->client->createHttpRequest(
            'POST',
            'updates/'.$updateID.'/move_to_top.json'
        );
    }

    /**
     * Returns an object with a the numbers of shares a link has had using Buffer.
     *
     * @param string $url string URL-encoded URL of the page for which the number of shares is requested.
     * @return array
     */
    public function getSharesLink(string $url)
    {
        return $this->client->createHttpRequest('GET', 'links/shares.json?url='.$url);
    }
}
