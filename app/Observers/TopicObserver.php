<?php

namespace App\Observers;

use App\Handlers\TranslateHandler;
use App\Models\Topics;

class TopicObserver
{
    public function saving(Topics $topic)
    {
        // XSS 过滤
        $topic->body = clean($topic->body, 'user_topic_body');

        // 生成摘要
        $topic->excerpt = $this->makeExcerpt($topic->body);
        if (! $topic->slug) {
            $topic->slug = app(TranslateHandler::class)->translateText($topic->title);
        }
    }

    private function makeExcerpt($text, $length = 200)
    {
        $excerpt = trim(preg_replace('/\r\n|\r|\n+/', ' ', strip_tags($text)));

        return str_limit($excerpt, $length);
    }
}
