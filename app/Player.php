<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Player
 *
 * @property int $id
 * @property string $firstName
 * @property string $lastName
 * @property string $playerImageURI
 * @property int $teamId
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Player newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Player newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Player query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Player whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Player whereFirstName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Player whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Player whereLastName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Player wherePlayerImageURI($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Player whereTeamId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Player whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \App\Team $team
 * @property int $team_id
 */
class Player extends Model
{
    protected $guarded = ['id'];
    public function team()
    {
        return $this->belongsTo(Team::class);
    }
}
