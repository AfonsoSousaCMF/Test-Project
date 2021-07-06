<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Post;
use Illuminate\Auth\Access\HandlesAuthorization;

class PostPolicy
{
    use HandlesAuthorization;

    public function update(User $user, Post $post) 
    {
        return $post->author_id == $user->id;
    }

    public function create(User $user, Post $post)
    {
        $author = $post->author_id == $user->id;
        return $author->posts()->count() < 10;
    }
}
