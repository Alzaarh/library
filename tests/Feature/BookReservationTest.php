<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Book;

class BookReservationTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_book_can_be_added_to_the_library()
    {
        $this->withoutExceptionHandling();

        $response = $this->post('/api/book', [
            'title' => 'title-1',
            'author' => 'author-1',
            'desc' => 'This is a great book',
        ]);

        $response->assertOk();
        $this->assertCount(1, Book::all());
    }

    /** @test */
    public function a_title_is_required()
    {
        $response = $this->post('/api/book', [
            'title' => '',
        ]);

        $response->assertSessionHasErrors('title');
    }

    /** @test */
    public function a_book_can_be_updated()
    {
        $this->withoutExceptionHandling();

        $this->post('/api/book', [
            'title' => 'title-1',
            'author' => 'author-1',
            'desc' => 'This is a great book',
        ]);

        $book = Book::first();

        $response = $this->patch('/api/book/'. $book->id, [
            'title' => 'new-title',
        ]);

        $response->assertOk();
        $this->assertEquals('new-title', Book::first()->title);
    }
}
