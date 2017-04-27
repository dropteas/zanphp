<?php
namespace Zan\Framework\Test\Network\Http;

use Zan\Framework\Network\Common\HttpClient;
use Zan\Framework\Testing\TaskTest;

use Zan\Framework\Foundation\Coroutine\Task;
use Zan\Framework\Test\Foundation\Coroutine\Context;

class HttpClientTest extends TaskTest
{
    public function testTaskCall()
    {
        $context = new Context();
        $task = new Task($this->makeCoroutine($context), null, 8);
        $task->run();
    }

    private function makeCoroutine($context)
    {
        $params = [
            'txt' => 'aaa',
            'size' => 200,
            'margin' => 20,
            'level' => 0,
            'hint' => 2,
            'case' => 1,
            'ver' => 1,
            'fg_color' => '000000',
            'bg_color' => 'ffffff',
        ];
        $httpClient = new HttpClient('127.0.0.1', 12345);
        $response = (yield $httpClient->get('', $params));
        $result = $response->getBody();

        $this->assertEquals($result, http_build_query($params), "Http request failed");
    }
}