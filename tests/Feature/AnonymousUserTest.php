<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AnonymousUserTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    /* Positive cases */
    public function can_view_teams_list()
    {
        $response = $this->get('/api/teams');

        $response->assertStatus(200);
    }

    public function can_view_team_details_by_id()
    {
        $response = $this->get('/api/teams/1');

        $response->assertStatus(200);
    }

    public function can_view_team_details_by_name()
    {
        $response = $this->get('/api/teams/name/Mark');

        $response->assertStatus(200);
    }

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
