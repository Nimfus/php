<?php
namespace App\Services;

use App\Models\Message;
use App\Models\Thread;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

class ChatService
{
    /**
     * @var Thread
     */
    protected $thread;

    /**
     * @var Message
     */
    protected $message;

    /**
     * ChatService constructor.
     *
     * @param Thread $thread
     * @param Message $message
     */
    public function __construct(Thread $thread, Message $message)
    {
        $this->thread = $thread;
        $this->message = $message;
    }

    /**
     * @param int $fromUser
     * @param int $toUser
     *
     * @return null|string
     */
    public function getThreadIdentifier(int $fromUser, int $toUser)
    {
        $identifier = $this->generateThreadIdentifier($fromUser, $toUser);

        $threadIdentifier = $this->thread->getThreadIdentifier($identifier);

        return is_null($threadIdentifier) ? $identifier : $threadIdentifier;
    }

    /**
     * @param int $fromUser
     * @param int $toUser
     *
     * @return string
     */
    public function generateThreadIdentifier(int $fromUser, int $toUser): string
    {
        return $fromUser > $toUser ? $toUser . '.' . $fromUser : $fromUser . '.' . $toUser;
    }

    /**
     * @param Collection $users
     *
     * @return Collection
     */
    public function prepareUserThreads(Collection $users)
    {
        foreach ($users as $user) {
            foreach ($user->threads as $thread) {
                $user->thread = $thread->thread_id;
            }
        }

        return $users;
    }

    /**
     * @param User $user
     *
     * @return User
     */
    public function prepareSingleUserThreads(User $user)
    {
        foreach ($user->threads as $thread) {
            $user->thread = $thread->thread_id;
        }

        return $user;
    }

    /**
     * @param Collection $threads
     * @param int $excludeId
     *
     * @return array
     */
    public function extractUserIds(Collection $threads, int $excludeId): array
    {
        $ids = [];
        foreach ($threads as $thread) {
            foreach ($thread->users as $user) {
                if ($user->id != $excludeId) {
                    $ids[] = $user->id;
                }
            }
        }

        return $ids;
    }

    /**
     * @param int $fromUser
     * @param int $toUser
     *
     * @return int
     */
    public function getGreaterUserId(int $fromUser, int $toUser): int
    {
        return $fromUser > $toUser ? $fromUser : $toUser;
    }

    /**
     * @param int $fromUser
     * @param int $toUser
     *
     * @return int
     */
    public function getLesserUserId(int $fromUser, int $toUser): int
    {
        return $fromUser < $toUser ? $fromUser : $toUser;
    }
}