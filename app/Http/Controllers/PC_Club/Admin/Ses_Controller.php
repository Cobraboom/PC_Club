<?php

namespace App\Http\Controllers\PC_Club\Admin;

use App\Http\Requests\PC_ClubSesCreateRequest;
use App\Http\Requests\PC_ClubSesUpdateRequest;
use App\Models\PC_ClubSes;
use App\Repositories\PC_ClubSesRepository;
use App\Repositories\PC_ClubUsersRepository;
use App\Repositories\PC_ClubPCRepository;


class Ses_Controller extends BaseController
{

    /**
     * @var PC_ClubSesRepository
     * @var PC_ClubUsersRepository
     * @var PC_ClubPCRepository
     */

    private $PC_ClubSesRepository,
            $PC_ClubUsersRepository,
            $PC_ClubPCRepository;

    public function __construct()
    {
        parent::__construct();

        $this->PC_ClubSesRepository = app(PC_ClubSesRepository::class);
        $this->PC_ClubUsersRepository = app(PC_ClubUsersRepository::class);
        $this->PC_ClubPCRepository = app(PC_ClubPCRepository::class);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$paginator = PC_ClubSes::paginate(5);
        $paginator = $this->PC_ClubSesRepository->getAllWithPaginate(5);

        return view('PC_Club.admin.Ses.index', compact('paginator'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $ses_item = new PC_ClubSes();
        $PC_list = $this -> PC_ClubPCRepository -> getForComboBoxPC();
        $User_list = $this -> PC_ClubUsersRepository -> getForComboBoxUser();

        return view('PC_Club.admin.Ses.create',
            compact('ses_item', 'PC_list', 'User_list'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PC_ClubSesCreateRequest $request)
    {
        $data =$request->input();
        $check_store = $this -> PC_ClubSesRepository ->getConditionCheckStore($data);

        return $check_store;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $ses_item   =   $this  ->   PC_ClubSesRepository    ->  getEdit($id);
        if (empty($ses_item)){
            abort(404);
        }
        $PC_list    =   $this  ->   PC_ClubPCRepository     ->  getForComboBoxPC();
        $User_list  =   $this  ->   PC_ClubUsersRepository  ->  getForComboBoxUser();

        /*$ses_item   =   PC_ClubSes::findOrFail($id);
        $PC_list = PC_ClubPC::all();
        $User_list = User::all('id', 'login');*/

        //dd($ses_item);
        return view('PC_Club.admin.Ses.edit',
            compact('ses_item', 'PC_list', 'User_list'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PC_ClubSesUpdateRequest $request, $id)
    {
        $ses_item = $this -> PC_ClubSesRepository -> getEdit($id);
        $data = $request->input();
        $check_update = $this -> PC_ClubSesRepository -> getConditionCheckUpdate($ses_item, $data, $id);

        return $check_update;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
