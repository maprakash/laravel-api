<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Passport\Passport;
use Tests\TestCase;
use Illuminate\Foundation\Testing\

class AdminUserTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * A basic test example.
     *
     * @return void
     */
    /* Positive cases */
    /** @test */
    public function can_create_a_team()
    {
        $user = factory(User::class)->create();
        Passport::actingAs($user);

        //See Below
        //$token = $user->generateToken();
        $payload =
        $headers = [ 'Accept' => 'Application/Json'];
        $response = $this->json('POST', '/api/login', $payload, $headers);
        //$token = $response->assertJson();


        // Storage::fake('avatars');

        // $file = UploadedFile::fake()->image('avatar.jpg');

        // $response = $this->json('POST', '/avatar', [
        //     'avatar' => $file,
        // ]);

        // // Assert the file was stored...
        // Storage::disk('avatars')->assertExists($file->hashName());

        // // Assert a file does not exist...
        // Storage::disk('avatars')->assertMissing('missing.jpg');

        // $headers = [ 'Authorization' => 'Bearer $token'];
        // $payload = [
        //     'name'=>'UnitTest',
        //     'logoURI' => 'image.jpg'
        // ];



        // $response = $this->json('POST', '/api/teams', $payload, $headers);

        // $response->assertStatus(200);
                // ->assertJson([
                //     //...
                // ]);

    }

    // public function can_modify_a_team_by_id()
    // {
    //     $response = $this->get('/api/teams/1');

    //     $response->assertStatus(200);
    // }

    // public function can_delete_a_team_by_id()
    // {
    //     $response = $this->get('/api/teams/name/Mark');

    //     $response->assertStatus(200);
    // }

    //   /* Positive cases */
    //   public function can_view_teams_list()
    //   {
    //       $response = $this->get('/api/teams');

    //       $response->assertStatus(200);
    //   }

    //   public function can_view_team_details_by_id()
    //   {
    //       $response = $this->get('/api/teams/1');

    //       $response->assertStatus(200);
    //   }

    //   public function can_view_team_details_by_name()
    //   {
    //       $response = $this->get('/api/teams/name/Mark');

    //       $response->assertStatus(200);
    //   }

}
