<?php

use App\Post;
use App\Tag;
use App\Category;
use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $category1 = Category::create([
            'name' => 'News'
        ]);

        $category2 = Category::create([
            'name' => 'Marketing'
        ]);

        $category3 = Category::create([
            'name' => 'Partnership'
        ]);

        $author1 = User::create([
            'name' => 'John Doe',
            'email' => 'John@doe.com',
            'password' => Hash::make('secret')

        ]);

        $author2 = User::create([
            'name' => 'Jean Doe',
            'email' => 'Jean@doe.com',
            'password' => Hash::make('secret')

        ]);

        $author3 = User::create([
            'name' => 'Stellar igabor',
            'email' => 'sigabor@workandconnect.net',
            'password' => Hash::make('secret')

        ]);

        $post1 = Post::create([
            'name' => 'We relocated our office to a new designed garage',
            'description' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s',
            'content'=>'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s,',
            'category_id' =>  $category1->id,
            'image' => 'posts/2.jpg',
            'user_id' => $author1->id
        ]); 

        $post2 = $author1->posts()->create([
            'name' => 'Top 5 brilliant content marketing strategies',
            'description' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s',
            'content'=>'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s,',
            'category_id' =>  $category1->id,
            'image' => 'posts/4.jpg'
        ]);

        $post3 = $author2->posts()->create([
            'name' => 'Best practices for minimalist design with example',
            'description' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s',
            'content'=>'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s,',
            'category_id' =>  $category2->id,
            'image' => 'posts/5.jpg'
        ]);

        $post4 = $author2->posts()->create([
            'name' => 'Congratulate and thank to Maryam for joining our team',
            'description' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s',
            'content'=>'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s,',
            'category_id' =>  $category2->id,
            'image' => 'posts/6.jpg'
        ]);

        $post5 = $author3->posts()->create([
            'name' => 'New published books to read by a product designer',
            'description' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s',
            'content'=>'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s,',
            'category_id' =>  $category3->id,
            'image' => 'posts/7.jpg'
        ]);

        $post6 = $author3->posts()->create([
            'name' => 'This is why it\'s time to ditch dress codes at work',
            'description' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s',
            'content'=>'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s,',
            'category_id' =>  $category3->id,
            'image' => 'posts/8.jpg'
        ]);

        $tag1 = Tag::create([
            'name' => 'Record'
        ]);

        $tag2 = Tag::create([
            'name' => 'Customers'
        ]);

        $tag3 = Tag::create([
            'name' => 'Job'
        ]);

        $tag4 = Tag::create([
            'name' => 'Record'
        ]);

        $post1->tags()->attach([$tag1->id, $tag2->id]);
        $post2->tags()->attach([$tag1->id, $tag2->id]);
        $post3->tags()->attach([$tag2->id, $tag3->id]);
        $post4->tags()->attach([$tag2->id, $tag3->id]);
        $post5->tags()->attach([$tag1->id, $tag4->id]);
        $post6->tags()->attach([$tag4->id, $tag1->id]);

        

    }
}
