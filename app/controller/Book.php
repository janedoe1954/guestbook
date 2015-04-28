<?php

class Controller_Book extends Framework_Controller
{
    public function overview()
    {
        $view = $this->view()->load('Book_Overview');
        $model = $this->model()->load('Post');

        $postQuantity = $model->getQuantity();
        $page = $this->request()->get('page');

        $maxPage = ceil($postQuantity / 10);
        if (!is_numeric($page) || $page > $maxPage || $page < 1) {

            $page = 1;
        }

        $posts = $model->getAllPaginated($page);

        $view->posts = $posts;
        $view->page = $page;
        $view->maxPage = $maxPage;

        if ($this->request()->get('success')) {
            $view->success = $this->request()->get('success');
        }

        return $view->render();
    }

    public function detail()
    {
        $postId = $this->request()->get('id');
        $view = $this->view()->load('Book_Detail');

        $postModel = $this->model()->load('Post');
        $commentModel = $this->model()->load('Comment');

        $post = $postModel->get($postId);
        $comments = $commentModel->getByPostId($postId);

        $view->post = $post;
        $view->comments = $comments;

        return $view->render();
    }

    public function add()
    {
        $view = $this->view()->load('Book_Add');
        $model = $this->model()->load('Post');

        if ($this->request()->isPost()) {

            $error = false;
            $data = $this->request()->getPosts();

            if (empty($data['name'])) {
                $error = 'Please enter your name';
            }
            if (strlen($data['message']) < 20) {
                $error = 'Your message should have at least 20 characters';
            }
            if (!preg_match('/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$/isU', $data['mail'])) {
                $error = 'Please enter a valid e-mail address';
            }

            if ($error) {
                $view->data = $data;
                $view->error = $error;
            }
            else {
                $model->insert($data);

                $this->redirect()->gotoRoute('Book', 'overview', array(
                    'success' => 'Post added!'
                ));
            }
        }

        return $view->render();
    }

    public function addComment()
    {
        $name = $this->request()->get('name');
        $comment = $this->request()->get('comment');
        $postId = $this->request()->get('postId');

        if (!empty($name) && !empty($comment) && is_numeric($postId)) {
            $model = $this->model()->load('Comment');
            $model->insert(array(
                'name' => $name,
                'comment' => $comment,
                'post_id' => $postId,
            ));
        }
    }

    public function getComments()
    {
        $model = $this->model()->load('Comment');
        $comments = $model->getAll();

        return json_encode($comments);
    }

    public function deletePost()
    {
        $postId = $this->request()->get('postId');
        $model = $this->model()->load('Post');

        return $model->delete($postId);
    }
}