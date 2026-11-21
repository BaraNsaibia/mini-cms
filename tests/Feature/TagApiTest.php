<?php

use App\Models\Post;
use App\Models\Tag;

it('lists tags with their published post count', function () {
    $tag = Tag::factory()->create();
    $publishedPost = Post::factory()->published()->create();
    $draftPost = Post::factory()->create();

    $publishedPost->tags()->attach($tag);
    $draftPost->tags()->attach($tag);

    $this->getJson('/api/tags')
        ->assertOk()
        ->assertJsonStructure([
            'data' => [
                '*' => ['id', 'name', 'slug', 'posts_count'],
            ],
        ])
        ->assertJsonPath('data.0.slug', $tag->slug)
        ->assertJsonPath('data.0.posts_count', 1);
});

it('filters posts by tag slug', function () {
    $tag = Tag::factory()->create();
    $taggedPost = Post::factory()->published()->create(['title' => 'Article avec tag']);
    $otherPost = Post::factory()->published()->create(['title' => 'Article sans tag']);

    $taggedPost->tags()->attach($tag);

    $this->getJson('/api/posts?tag='.$tag->slug)
        ->assertOk()
        ->assertJsonCount(1, 'data')
        ->assertJsonPath('data.0.id', $taggedPost->id)
        ->assertJsonPath('data.0.title', 'Article avec tag');
});

it('returns a JSON 404 for an unknown tag', function () {
    $this->getJson('/api/tags/999999')
        ->assertNotFound()
        ->assertJsonStructure(['message']);
});
