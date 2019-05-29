<?php

namespace App\Http\Controllers\PC_Club\Admin;

use App\Http\Requests\PC_ClubPCCreateRequest;
use App\Http\Requests\PC_ClubPCUpdateRequest;
use App\Models\PC_ClubPC;
use App\Repositories\PC_ClubPCRepository;

class PC_Controller extends BaseController
{

    /**
     * @var PC_ClubPCRepository
     */

    private

        $PC_ClubPCRepository;

    public function __construct()
    {
        parent::__construct();

        $this->PC_ClubPCRepository = app(PC_ClubPCRepository::class);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $paginator = $this->PC_ClubPCRepository->getAllWithPaginate(5);

        return view('PC_Club.admin.PC.index', compact('paginator'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $PC_item = new PC_ClubPC();
        $PC_list = $this -> PC_ClubPCRepository -> getForComboBoxPC();
        //$User_list = $this -> PC_ClubUsersRepository -> getForComboBoxUser();

        return view('PC_Club.admin.PC.create',
            compact('PC_item', 'PC_list'
            /*,'User_list'*/));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PC_ClubPCCreateRequest $request)
    {
        $data =$request->input();
        $check_store = $this ->PC_ClubPCRepository ->getCheckFormStore($data);

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

        $PC_item   =   $this  ->   PC_ClubPCRepository    ->  getEdit($id);
        if (empty($PC_item)){
            abort(404);
        }
        //dd($PC_item);
        return view('PC_Club.admin.PC.edit',
            compact('PC_item'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PC_ClubPCUpdateRequest $request, $id)
    {
        $PC_item = $this -> PC_ClubPCRepository -> getEdit($id);
        $data = $request -> input();
        $check_update = $this -> PC_ClubPCRepository ->getCheckFormUpdate($PC_item, $data, $id);

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
        $result = PC_ClubPC::destroy($id);
        if ($result){
            return redirect()
                ->route('PC_Club.admin.Ses.index')
                ->with(['success' => "Запись id[$id] удалена"]);
        }
        else{
            return back()->withErrors(['msg' => 'Ошибка удаления']);
        }
    }
}