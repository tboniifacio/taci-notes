<?php

namespace Tests\Feature;

use App\Models\Note;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Crypt;
use Tests\TestCase;

class NoteTest extends TestCase
{
    use RefreshDatabase;

    private function makeUser(): User
    {
        $user = new User();
        $user->username = 'user@example.com';
        $user->password = bcrypt('secret123');
        $user->save();

        return $user;
    }

    private function makeNote(User $user, string $title = 'Grocery list', string $text = 'Milk, eggs, bread.'): Note
    {
        $note = new Note();
        $note->user_id = $user->id;
        $note->title = $title;
        $note->text = $text;
        $note->save();

        return $note;
    }

    private function loginAs(User $user): self
    {
        return $this->withSession(['user' => ['id' => $user->id, 'username' => $user->username]]);
    }

    public function test_home_shows_only_the_logged_in_users_notes(): void
    {
        $user = $this->makeUser();
        $otherUser = $this->makeUser();
        $otherUser->username = 'other@example.com';
        $otherUser->save();

        $this->makeNote($user, 'My note');
        $this->makeNote($otherUser, 'Not my note');

        $response = $this->loginAs($user)->get('/');

        $response->assertStatus(200);
        $response->assertSee('My note');
        $response->assertDontSee('Not my note');
    }

    public function test_user_can_create_a_note(): void
    {
        $user = $this->makeUser();

        $response = $this->loginAs($user)->post('/newNoteSubmit', [
            'text_title' => 'Trip planning',
            'text_note' => 'Book flights and hotel.',
        ]);

        $response->assertRedirect('/');
        $this->assertDatabaseHas('notes', [
            'user_id' => $user->id,
            'title' => 'Trip planning',
            'text' => 'Book flights and hotel.',
        ]);
    }

    public function test_creating_a_note_requires_minimum_length(): void
    {
        $user = $this->makeUser();

        $response = $this->loginAs($user)->post('/newNoteSubmit', [
            'text_title' => 'ab',
            'text_note' => 'ok',
        ]);

        $response->assertSessionHasErrors(['text_title', 'text_note']);
        $this->assertDatabaseCount('notes', 0);
    }

    public function test_user_can_edit_their_note(): void
    {
        $user = $this->makeUser();
        $note = $this->makeNote($user);

        $response = $this->loginAs($user)->post('/editNoteSubmit', [
            'note_id' => Crypt::encrypt($note->id),
            'text_title' => 'Updated title',
            'text_note' => 'Updated text content.',
        ]);

        $response->assertRedirect('/');
        $this->assertDatabaseHas('notes', [
            'id' => $note->id,
            'title' => 'Updated title',
            'text' => 'Updated text content.',
        ]);
    }

    public function test_edit_note_form_loads_with_existing_values(): void
    {
        $user = $this->makeUser();
        $note = $this->makeNote($user, 'Original title');

        $response = $this->loginAs($user)->get('/editNote/' . Crypt::encrypt($note->id));

        $response->assertStatus(200);
        $response->assertSee('Original title');
    }

    public function test_delete_note_shows_confirmation_without_deleting(): void
    {
        $user = $this->makeUser();
        $note = $this->makeNote($user);

        $response = $this->loginAs($user)->get('/deleteNote/' . Crypt::encrypt($note->id));

        $response->assertStatus(200);
        $this->assertDatabaseHas('notes', ['id' => $note->id]);
    }

    public function test_delete_note_confirm_removes_the_note(): void
    {
        $user = $this->makeUser();
        $note = $this->makeNote($user);

        $response = $this->loginAs($user)->get('/deleteNoteConfirm/' . Crypt::encrypt($note->id));

        $response->assertRedirect('/');
        $this->assertDatabaseMissing('notes', ['id' => $note->id]);
    }

    public function test_guest_cannot_access_note_routes(): void
    {
        $this->get('/newNote')->assertRedirect('/login');
        $this->post('/newNoteSubmit', [])->assertRedirect('/login');
    }
}
