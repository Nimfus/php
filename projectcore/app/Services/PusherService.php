<?php
/**
 * Created by PhpStorm.
 * User: Nimfus
 * Date: 18.02.17
 * Time: 16:54
 */

namespace App\Services;

use App\Models\Message;
use Vinkla\Pusher\PusherManager;

class PusherService
{
    protected $pusherManager;

    public function __construct(PusherManager $pusherManager)
    {
        $this->pusherManager = $pusherManager;
    }

    public function dispatchToPusher(string $channel, Message $message)
    {
        $this->pusherManager->trigger('t-' . $channel, 'new-message', $message->toArray());
    }
}