<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\TeamCreateRequest;
use App\Http\Requests\TeamUpdateRequest;
use App\Http\Resources\TeamResource;
use App\Repositories\TeamRepositoryInterface;

use App\Traits\FileUploadTrait;
use Config;
use ErrorException;
use Exception;
use Symfony\Component\HttpFoundation\Response;

class TeamController extends Controller
{
    use FileUploadTrait;
    private $teamRepository;

    public function __construct(TeamRepositoryInterface $teamRepository)
    {
        $this->teamRepository = $teamRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /* Fetch all teams with players */
            $columns = ['id','name','logoURI'];
            $relations = ['players:id,firstName,lastName,playerImageURI,team_id'];
            return TeamResource::collection($this->teamRepository->all($columns, $relations));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TeamCreateRequest $request)
    {

        \Gate::authorize('edit', 'teams');
        /* Upload Team's image*/
        $team = [];
        $team['name'] = $request->input('name');
        if($request->file('logoURI'))
        {
            $fileOriginal = $request->file('logoURI')->getClientOriginalName();
            $url = $this->uploadFile($request->file('logoURI'),$fileOriginal,'images/teams');
            if($url)
            {
                $playerImageURI = env('APP_URL')."/".$url;
                $team['logoURI'] = $playerImageURI;
            }
            else{
                throw new ErrorException("File Upload error", 500);
            }

        }

        return response(new TeamResource($this->teamRepository->create($team)), Response::HTTP_CREATED);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function show($column, $value)
    // {

    // }

    public function showByID($id)
    {
        $columns = ['id','name','logoURI'];
        $relations = ['players:id,firstName,lastName,playerImageURI,team_id'];

        return new TeamResource($this->teamRepository->findById($id, $columns, $relations));

    }

    public function showByName($name)
    {
        $filterColumns = ['name']; //this must be defined when finding data by Name
        $columns = ['id','name','logoURI'];
        $relations = ['players:id,firstName,lastName,playerImageURI,team_id'];

        $team = $this->teamRepository->findByName($name,$filterColumns,$columns, $relations);

        if($team)
        {
            return new TeamResource($team);
        }
        return  response()->json(['message'=>"No records found"], Response::HTTP_NOT_FOUND);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TeamUpdateRequest $request, $id)
    {
        \Gate::authorize('edit', 'teams');

        /* set the data to be updated */
        $updatedTeam = [];
        if($request->input('name'))
        {
            $updatedTeam['name'] = $request->input('name');
        }

        /* Upload player's image*/
        if($request->file('logoURI'))
        {
            $fileOriginal = $request->file('logoURI')->getClientOriginalName();
            $url = $this->uploadFile($request->file('logoURI'),$fileOriginal,'images/teams');
            if($url)
            {
                $playerImageURI = env('APP_URL')."/".$url;
                $updatedTeam['logoURI'] = $playerImageURI;
            }
            else{
                throw new ErrorException("File Upload error", 500);
            }

        }

        if($this->teamRepository->update($id, $updatedTeam))
        {
            return  response()->json(['message'=>"Modified successfully"], Response::HTTP_CREATED);
        }
        else{
            return  response()->json(['message'=>"Not modified due to some error"], Response::HTTP_NOT_MODIFIED);
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        \Gate::authorize('delete', 'teams');
        /* Delete a team */
        if($this->teamRepository->deleteById($id))
        {
            return  response()->json(['message'=>"Deleted"], Response::HTTP_OK);
        }
        else{
            return  response()->json(['message'=>"Not deleted due to some error"], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

    }
}
