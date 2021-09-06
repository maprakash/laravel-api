<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\PlayerCreateRequest;
use App\Http\Requests\PlayerUpdateRequest;
use App\Http\Resources\PlayerResource;
use App\Repositories\PlayerRepositoryInterface;
use App\Traits\FileUploadTrait;
use Config;
use ErrorException;
use Exception;
use Symfony\Component\HttpFoundation\Response;


class PlayerController extends Controller
{
    use FileUploadTrait;
    private $playerRepository;

    public function __construct(PlayerRepositoryInterface  $playerRepository)
    {
        $this->playerRepository = $playerRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $columns = ['*'];
        $relations = ['team:name,id'];

        return PlayerResource::collection($this->playerRepository->all($columns, $relations));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\PlayerRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PlayerCreateRequest $request)
    {
        \Gate::authorize('edit', 'players');
        /* Upload player's image,*/
        $player = [
            'firstName'=> $request->input('firstName'),
            'lastName'=> $request->input('lastName'),
            'team_id' => $request->input('team_id')
        ];
        if($request->file('playerImageURI'))
        {
            $file_original = $request->file('playerImageURI')->getClientOriginalName();
            $url = $this->uploadFile($request->file('playerImageURI'),$file_original,'images/players');

            if($url)
            {
                $playerImageURI = env('APP_URL')."/".$url;
                $player['playerImageURI'] = $playerImageURI;
            }
            else{
                throw new ErrorException("File Upload error", 500);
            }

        }

        return response(new PlayerResource($this->playerRepository->create($player)), Response::HTTP_CREATED);
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showByID($id)
    {
        $columns = ['*'];
        $relations = ['team:name,id'];
        return new PlayerResource($this->playerRepository->findById($id, $columns, $relations));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $name
     * @return \Illuminate\Http\Response
     */
    public function showByName($name)
    {
        $columns = ['*'];
        $relations = ['team:name,id'];
        $filterColumns = ['firstName','lastName']; //thase columns will be concatenated using space and filtered (wildcard)

        return new PlayerResource($this->playerRepository->findByName($name,$filterColumns, $columns, $relations));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PlayerUpdateRequest $request, $id)
    {
        \Gate::authorize('edit', 'players');

        /* set the data to be updated */
        $updatedPlayer = [];

        if($request->input('firstName'))
        {
            $updatedPlayer['firstName'] = $request->input('firstName');
        }
        if($request->input('lastName'))
        {
            $updatedPlayer['lastName'] = $request->input('lastName');
        }
        if($request->input('team_id'))
        {
            $updatedPlayer['team_id'] = $request->input('team_id');
        }

        /* Upload player's image  */
        if($request->file('playerImageURI'))
        {
            $file_original = $request->file('playerImageURI')->getClientOriginalName();
            $url = $this->uploadFile($request->file('playerImageURI'),$file_original,'images/players');

            if($url)
            {
                $playerImageURI = env('APP_URL')."/".$url;
                $updatedPlayer['playerImageURI'] = $playerImageURI;
            }
            else{
                throw new ErrorException("File Upload error", 500);
            }

        }

        if($this->playerRepository->update($id, $updatedPlayer))
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
        \Gate::authorize('delete', 'players');
        /* Delete a player */
        if($this->playerRepository->deleteById($id))
        {
            return  response()->json(['message'=>"Deleted"], Response::HTTP_OK);
        }
        else{
            return  response()->json(['message'=>"Not deleted due to some error"], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
