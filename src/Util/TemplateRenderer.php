<?php

namespace app\Util;


class TemplateRenderer
{
    public function renderHtml(string $html, array $data = []): string
    {
        $template = file_get_contents(TEMPLATE_PATH . '/' . $html);
        if ($data){
            foreach ($data as $key => $value) {
                $template = str_replace($key, $value, $template);
            }
        }


        return $template;
    }

    /**
     * @throws \DateMalformedStringException
     */
    public function renderPosts(string $html, array $data): string
    {
        $template = file_get_contents(TEMPLATE_PATH . '/' . $html);
        $postsHtml = '';

        foreach ($data as $post) {
            $postImage = '';
            if (!empty($post['image'])) {
                $postImage .= '<img src="' . $post['image'] . '" class="post-image" alt="Post Image">';
            }
            $postTimestamp = new \DateTime($post['created_at']);
            $postsHtml .= '<div class="post-container">
                    <div class="post-header">
                        <h5>  <img src="avatars/' . $post['avatar'] . '" class="border border-2 avatar-post" alt="avatar"> ' . $post["user_name"] . ' 
                            <span class="text-muted">@' . $post["user_name"] . ' · ' . $postTimestamp->format('Y-m-d H:i') . '</span>
                        </h5>
                    </div>
                    <div class="post-body">
                        <p class="post-title"><strong>' . $post['title'] . '</strong></p>
                        <p class="post-content">' . $post['content'] . '</p>
                        <p class="post-link"> <a href="' . $post['link'] . '">' . $post['link'] . '</a></p>'
                . $postImage .
                ' <div class="comment-section">
                <a href="/post?postID=' . $post['post_id'] . '" style="  color: inherit; text-decoration: none; /">
                    <img src="comment.svg" alt="comment" class="comment-icon">
                </a>
                <span class="comment-count">' . $post['comment_count'] . '</span>
            </div>
        </div>
    </div>';
        }



        return str_replace('{{Post}}', $postsHtml, $template);
    }

    public function renderPost(string $html, array $post): string
    {
        $template = file_get_contents(TEMPLATE_PATH . '/' . $html);
        $postHtml = '';


            $postImage = '';
            if (!empty($post['image'])) {
                $postImage = '<img src="' . $post['image'] . '" class="post-image" alt="Post Image">';
            }
            $postTimestamp = new \DateTime($post['created_at']);
            $postHtml .= '<div class="post-container">
                        <div class="post-header">
                            <h5>  <img src="avatars/' . $post['avatar'] . '" class = "border border-2 avatar-post" alt="avatar"> ' . $post["user_name"] . ' 
                                <span class="text-muted">@' . $post["user_name"] . ' · ' . $postTimestamp->format('Y-m-d H:i') . '</span>
                            </h5>
                        </div>
                        <div class="post-body">
                            <p class="post-title"><strong>' . $post['title'] . '</strong></p>
                            <p class="post-content">' . $post['content'] . '</p>
                            <p class="post-link">' . $post['link'] . '</p>'
                . $postImage .
                '</div>
            </div>';



        return str_replace('{{Post}}', $postHtml, $template);
    }

    public function renderComments(string $html, array $data)
    {
        $template = file_get_contents(TEMPLATE_PATH . '/' . $html);
        $commentsHtml = '';

        foreach ($data as $comment) {
            $commentTimestamp = new \DateTime($comment['created_at']);
            $commentsHtml .= '
            <div class="post-header">
                        <div class="comment-box">
                            <h5>  <img src="avatars/' . $comment['avatar'] . '" class = "border border-2 avatar-post" alt="avatar"> ' . $comment["user_name"] . ' 
                                <span class="text-muted">@' . $comment["user_name"] . ' · ' . $commentTimestamp->format('Y-m-d H:i') . '</span>
                            </h5>
                        </div>
                        <div class="comment-body">
                            <p class="comment-content">' . $comment['content'] . '</p>
                      </div>
            </div>';
        }


        return str_replace('{{Comment}}', $commentsHtml, $template);

    }
}

