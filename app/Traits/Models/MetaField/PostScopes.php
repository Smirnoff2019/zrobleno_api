<?php

namespace App\Traits\Models\Post;

use App\Models\Post\Post;
use App\Models\PostType\FormPostType;
use App\Models\PostType\MenuPostType;
use App\Models\PostType\PagePostType;
use App\Models\PostType\PortfolioPostType;
use App\Models\PostType\PostPostType;
use App\Models\PostType\PostType;
use App\Models\PostType\WidgetPostType;
use Illuminate\Database\Eloquent\Builder;

trait PostScopes
{

    /**
     * Scope a query to only include posts who have this post type
     *
     * @param Builder $query
     * @param string[:\App\Models\PostType\PostType]  $slug
     * @return Builder
     */
    public function scopeHasPostType( Builder $query, string $slug): Builder
    {
        return $query->whereHas('postType', function (Builder $query) use ($slug) {
            $query->where(
                PostType::COLUMN_SLUG,
                $slug
            );
        });
    }

    /**
     * Scope a query to only include posts who have this post type Post
     *
     * @param Builder $query
     * @return Builder
     */
    public function scopePost(Builder $query): Builder
    {
        return $query->whereHas('postType', function (Builder $query) {
            $query->where(
                PostType::COLUMN_SLUG,
                PostPostType::DEFAULT_SLUG
            );
        });
    }

    /**
     * Scope a query to only include posts who have this post type Page
     *
     * @param Builder $query
     * @return Builder
     */
    public function scopePage(Builder $query): Builder
    {
        return $query->whereHas('postType', function (Builder $query) {
            $query->where(
                PostType::COLUMN_SLUG,
                PagePostType::DEFAULT_SLUG
            );
        });
    }

    /**
     * Scope a query to only include posts who have this post type Widget
     *
     * @param Builder $query
     * @return Builder
     */
    public function scopeWidget(Builder $query): Builder
    {
        return $query->whereHas('postType', function (Builder $query) {
            $query->where(
                PostType::COLUMN_SLUG,
                WidgetPostType::DEFAULT_SLUG
            );
        });
    }

    /**
     * Scope a query to only include posts who have this post type Form
     *
     * @param Builder $query
     * @return Builder
     */
    public function scopeForm(Builder $query): Builder
    {
        return $query->whereHas('postType', function (Builder $query) {
            $query->where(
                PostType::COLUMN_SLUG,
                FormPostType::DEFAULT_SLUG
            );
        });
    }

    /**
     * Scope a query to only include posts who have this post type Menu
     *
     * @param Builder $query
     * @return Builder
     */
    public function scopeMenu(Builder $query): Builder
    {
        return $query->whereHas('postType', function (Builder $query) {
            $query->where(
                PostType::COLUMN_SLUG,
                MenuPostType::DEFAULT_SLUG
            );
        });
    }

    /**
     * Scope a query to only include posts who have this post type Portfolio
     *
     * @param Builder $query
     * @return Builder
     */
    public function scopePortfolio(Builder $query): Builder
    {
        return $query->where(Post::COLUMN_POST_TYPE, PortfolioPostType::DEFAULT_SLUG);
    }

}
