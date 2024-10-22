<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\BlogEntry;

class BlogEntrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        BlogEntry::create([
            'title' => ['en' => 'The first title for the post', 'ru' => 'Первый заголовок поста'],
            'text' => [
                'en' => 'Fill in description field and start your stories. This text will be shown as a specification in a news card', 
                'ru' => 'Заполните поле описания и начните вашу историю. Текст будет отображаться как описание к новой карточке.'
            ],
            'is_published' => true,
        ])->addMedia(resource_path() . '/blog-img/blog-1.jpg')->preservingOriginal()->toMediaCollection('blog');

        BlogEntry::create([
            'title' => ['en' => 'The seсond title for the post', 'ru' => 'Второй заголовок поста'],
            'text' => [
                'en' => 'Fill in description field and start your stories. This text will be shown as a specification in a news card', 
                'ru' => 'Заполните поле описания и начните вашу историю. Текст будет отображаться как описание к новой карточке.'
            ],
            'is_published' => true,
        ])->addMedia(resource_path() . '/blog-img/blog-2.jpg')->preservingOriginal()->toMediaCollection('blog');

        BlogEntry::create([
            'title' => ['en' => 'The third title for the post', 'ru' => 'Третий заголовок поста'],
            'text' => [
                'en' => 'Fill in description field and start your stories. This text will be shown as a specification in a news card', 
                'ru' => 'Заполните поле описания и начните вашу историю. Текст будет отображаться как описание к новой карточке.'
            ],
            'is_published' => true,
        ])->addMedia(resource_path() . '/blog-img/blog-3.jpg')->preservingOriginal()->toMediaCollection('blog');

        BlogEntry::create([
            'title' => ['en' => 'The fourth title for the post', 'ru' => 'Четвертый заголовок поста'],
            'text' => [
                'en' => 'Fill in description field and start your stories. This text will be shown as a specification in a news card', 
                'ru' => 'Заполните поле описания и начните вашу историю. Текст будет отображаться как описание к новой карточке.'
            ],
            'is_published' => true,
        ])->addMedia(resource_path() . '/blog-img/blog-4.jpg')->preservingOriginal()->toMediaCollection('blog');

        BlogEntry::create([
            'title' => ['en' => 'The fifth title for the post', 'ru' => 'Пятый заголовок поста'],
            'text' => [
                'en' => 'Fill in description field and start your stories. This text will be shown as a specification in a news card', 
                'ru' => 'Заполните поле описания и начните вашу историю. Текст будет отображаться как описание к новой карточке.'
            ],
            'is_published' => true,
        ])->addMedia(resource_path() . '/blog-img/blog-5.jpg')->preservingOriginal()->toMediaCollection('blog');

        BlogEntry::create([
            'title' => ['en' => 'The sixth title for the post', 'ru' => 'Шестой заголовок поста'],
            'text' => [
                'en' => 'Fill in description field and start your stories. This text will be shown as a specification in a news card', 
                'ru' => 'Заполните поле описания и начните вашу историю. Текст будет отображаться как описание к новой карточке.'
            ],
            'is_published' => true,
        ])->addMedia(resource_path() . '/blog-img/blog-6.jpg')->preservingOriginal()->toMediaCollection('blog');
    }
}
