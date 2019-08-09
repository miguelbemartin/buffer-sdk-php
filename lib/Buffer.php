<?php

/**
 * This library allows you to use the Public Buffer API.
 *
 * PHP Version - 7.1, 7.2
 *
 * @package   BufferSDK
 * @author    Miguel Ángel Martín <miguel@cromattica.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 * @version   GIT: <git_id>
 * @link      http://packagist.org/packages/miguelbemartin/buffer-php
 */

namespace BufferSDK;

use BufferSDK\Auth\AuthorizationTokenInterface;
use BufferSDK\Http\Client;
use BufferSDK\Http\ClientInterface;
use BufferSDK\Service\ProfileService;
use BufferSDK\Service\UpdateService;
use BufferSDK\Service\UserService;

class Buffer
{
    /** Library version */
    const VERSION = '1.0.0';

    /** @var string */
    protected $namespace = 'BufferSDK';

    /** @var string */
    protected $url = 'https://api.bufferapp.com/1/';

    /** @var string */
    public $version = self::VERSION;

    /** @var ClientInterface */
    private $client;

    /** @var AuthorizationTokenInterface */
    private $auth;

    /** @var UserService */
    public $userService;

    /** @var ProfileService */
    public $profileService;

    /** @var UpdateService */
    public $updateService;

    /**
     * Buffer Client Constructor.
     *
     * @param $auth
     */
    public function __construct(AuthorizationTokenInterface $auth)
    {
        $this->auth = $auth;
        $this->client = new Client($this->auth);
        $this->userService = new UserService($this->client);
        $this->profileService = new ProfileService($this->client);
        $this->updateService = new UpdateService($this->client);
    }
}
