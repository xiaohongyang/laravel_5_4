<?php

namespace App\Policies;

use App\User;
use App\AppModelArticle;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Auth;
use App\Models\Article;

class ArticlePolicy
{
    use HandlesAuthorization;

    public function before(User $user, $ability){

//        if($user->isAdmin())
//            return true;
//        else
//            return false;
    }

    /**
     * Determine whether the user can view the appModelArticle.
     *
     * @param  \App\User  $user
     * @param  \App\AppModelArticle  $appModelArticle
     * @return mixed
     */
    public function view(User $user, Article $appModelArticle)
    {
        //

    }

    public function list(User $user){

        return Auth::user();
    }

    /**
     * Determine whether the user can create appModelArticles.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the appModelArticle.
     *
     * @param  \App\User  $user
     * @param  \App\AppModelArticle  $appModelArticle
     * @return mixed
     */
    public function update(User $user, Article $article)
    {
        //

        return $user->id == $article->user_id;
    }

    /**
     * Determine whether the user can delete the appModelArticle.
     *
     * @param  \App\User  $user
     * @param  \App\AppModelArticle  $appModelArticle
     * @return mixed
     */
    public function delete(User $user, AppModelArticle $appModelArticle)
    {
        //
    }

    public function listAll(User $user){
        return $user->isAdmin();
    }
}
