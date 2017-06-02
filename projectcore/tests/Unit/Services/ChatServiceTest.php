<?php
namespace Tests\Unit\Services;

use App\Models\Thread;
use App\Models\Message;
use App\Models\User;
use App\Services\ChatService;
use Illuminate\Database\Eloquent\Collection;

class ChatServiceTest extends \TestCase
{
    /**
     * @test
     */
    public function testGenerateThreadIdentifier()
    {
        $thread = \Mockery::mock(Thread::class);
        $message = \Mockery::mock(Message::class);
        $chatService = new ChatService($thread, $message);

        $this->assertSame('1.4', $chatService->generateThreadIdentifier(1, 4));
        $this->assertSame('1.100', $chatService->generateThreadIdentifier(1, 100));
        $this->assertSame('100.111', $chatService->generateThreadIdentifier(111, 100));
        $this->assertNotSame('1.100', $chatService->generateThreadIdentifier(1, 10));
        $this->assertNotSame('1.10', $chatService->generateThreadIdentifier(11, 10));
    }

    /**
     * @test
     */
    public function testGetExistingThreadIdentifier()
    {
        $thread = \Mockery::mock(Thread::class)
            ->shouldReceive('getThreadIdentifier')
            ->andReturn('10.12')->getMock();
        $message = \Mockery::mock(Message::class);

        $chatService = new ChatService($thread, $message);

        $this->assertEquals('10.12', $chatService->getThreadIdentifier(4, 5));
    }

    /**
     * @test
     */
    public function testGetThreadIdentifier()
    {
        $thread = \Mockery::mock(Thread::class)
            ->shouldReceive('getThreadIdentifier')
            ->andReturn(null)->getMock();
        $message = \Mockery::mock(Message::class);

        $chatService = new ChatService($thread, $message);

        $this->assertEquals('4.5', $chatService->getThreadIdentifier(5, 4));
    }

    /**
     * @test
     */
    public function testGetLesserUserId()
    {
        $thread = \Mockery::mock(Thread::class)
            ->shouldReceive('getThreadIdentifier')
            ->andReturn(null)->getMock();
        $message = \Mockery::mock(Message::class);

        $chatService = new ChatService($thread, $message);

        $this->assertEquals(4, $chatService->getLesserUserId(4, 10));
        $this->assertEquals(10, $chatService->getLesserUserId(41, 10));
        $this->assertEquals(10, $chatService->getLesserUserId(10, 10));
    }

    /**
     * @test
     */
    public function testGetGreaterUserId()
    {
        $thread = \Mockery::mock(Thread::class)
            ->shouldReceive('getThreadIdentifier')
            ->andReturn(null)->getMock();
        $message = \Mockery::mock(Message::class);

        $chatService = new ChatService($thread, $message);

        $this->assertEquals(10, $chatService->getGreaterUserId(4, 10));
        $this->assertEquals(41, $chatService->getGreaterUserId(41, 10));
        $this->assertEquals(10, $chatService->getGreaterUserId(10, 10));
    }

    /**
     * @test
     */
    public function testPrepareUserThreads()
    {
        $usersCollection = $this->getDataToTest();

        $thread = \Mockery::mock(Thread::class)
            ->shouldReceive('getThreadIdentifier')
            ->andReturn(null)->getMock();
        $message = \Mockery::mock(Message::class);

        $chatService = new ChatService($thread, $message);

        $expected = $this->getExpectedData();

        $results = $chatService->prepareUserThreads($usersCollection);
        $this->checkData($results, $expected);
    }

    /**
     * @test
     */
    public function testPrepareSingleUserThreads()
    {
        $thread1 = new Thread();
        $thread1->id = 1;
        $thread1->first_user = 12;
        $thread1->second_user = 2;
        $thread1->thread_id = '2.12';

        $thread2 = new Thread();
        $thread2->id = 2;
        $thread2->first_user = 121;
        $thread2->second_user = 1;
        $thread2->thread_id = '1.121';

        $user = new User();
        $user->id = 12;
        $user->avatar = 'avatar3';
        $user->threads = new Collection([$thread1, $thread2]);

        $thread = \Mockery::mock(Thread::class)
            ->shouldReceive('getThreadIdentifier')
            ->andReturn(null)->getMock();
        $message = \Mockery::mock(Message::class);

        $chatService = new ChatService($thread, $message);

        $expectedUser = new User();
        $expectedUser->id = 12;
        $expectedUser->avatar = 'avatar3';
        $expectedUser->thread = '1.121';

        $result = $chatService->prepareSingleUserThreads($user);

        $this->assertEquals($result->id, $expectedUser->id);
        $this->assertEquals($result->avatar, $expectedUser->avatar);
        $this->assertEquals($result->thread, $expectedUser->thread);
    }

    /**
     * @test
     */
    public function testExtractUserIds()
    {
        $thread = \Mockery::mock(Thread::class)
            ->shouldReceive('getThreadIdentifier')
            ->andReturn(null)->getMock();
        $message = \Mockery::mock(Message::class);

        $chatService = new ChatService($thread, $message);

        $threads = $this->getDataForExtractIdsTest();

        $this->assertEquals([11, 11, 12], $chatService->extractUserIds($threads, 10));
    }

    /**
     * @param $results
     * @param $expectedResults
     */
    private function checkData($results, $expectedResults)
    {
        for ($i = 0; $i < count($results); $i++) {
            $this->assertEquals($results[$i]->id, $expectedResults[$i]->id);
            $this->assertEquals($results[$i]->avatar, $expectedResults[$i]->avatar);
            $this->assertEquals($results[$i]->thread, $expectedResults[$i]->thread);
        }
    }

    /**
     * @return Collection
     */
    private function getDataForExtractIdsTest()
    {
        $user1 = new User();
        $user1->id = 10;

        $user2 = new User();
        $user2->id = 11;

        $user3 = new User();
        $user3->id = 12;

        $thread1 = new Thread();
        $thread1->users = new Collection([$user1, $user2]);

        $thread2 = new Thread();
        $thread2->users = new Collection([$user1, $user2, $user3]);

        return new Collection([$thread1, $thread2]);
    }

    /**
     * @return Collection
     */
    private function getDataToTest()
    {
        $thread1 = new Thread();
        $thread1->id = 1;
        $thread1->first_user = 12;
        $thread1->second_user = 2;
        $thread1->thread_id = '2.12';

        $thread2 = new Thread();
        $thread2->id = 2;
        $thread2->first_user = 121;
        $thread2->second_user = 1;
        $thread2->thread_id = '1.121';

        $thread3 = new Thread();
        $thread3->id = 3;
        $thread3->first_user = 11;
        $thread3->second_user = 10;
        $thread3->thread_id = '10.11';

        $user1 = new User();
        $user1->id = 10;
        $user1->avatar = 'avatar1';
        $user1->threads = new Collection([$thread1, $thread3]);

        $user2 = new User();
        $user2->id = 11;
        $user2->avatar = 'avatar2';
        $user2->threads = new Collection([$thread3, $thread2]);

        $user3 = new User();
        $user3->id = 12;
        $user3->avatar = 'avatar3';
        $user3->threads = new Collection([$thread1, $thread2]);

        return new Collection([$user1, $user2, $user3]);
    }

    /**
     * @return array
     */
    private function getExpectedData()
    {
        $expectedUser1 = new User();
        $expectedUser1->id = 10;
        $expectedUser1->avatar = 'avatar1';
        $expectedUser1->thread = '10.11';

        $expectedUser2 = new User();
        $expectedUser2->id = 11;
        $expectedUser2->avatar = 'avatar2';
        $expectedUser2->thread = '1.121';

        $expectedUser3 = new User();
        $expectedUser3->id = 12;
        $expectedUser3->avatar = 'avatar3';
        $expectedUser3->thread = '1.121';

        return [$expectedUser1, $expectedUser2, $expectedUser3];
    }
}