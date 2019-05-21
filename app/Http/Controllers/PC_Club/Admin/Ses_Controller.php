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

        if (empty($data['time_start'] && $data['time_end'])){
            return back()
                ->withErrors(['msg' => "Вы не указали дату и время"])
                ->withInput();
        }

        $bron = \DB::select('SELECT * FROM `p_c__club_ses` WHERE (`id_pc` = '.$data['id_pc'].') AND (((`time_start` < "'.$data['time_start'].'")
        AND (`time_end` > "'.$data['time_end'].'")) OR ((`time_start` > "'.$data['time_start'].'")
        AND (`time_end` < "'.$data['time_end'].'")) OR ((`time_end` > "'.$data['time_start'].'")
        AND (`time_start` < "'.$data['time_end'].'")))');

        //dd($bron);
        //$bron = true;

        if($bron == true ){
            return back()
                ->withErrors(['msg' => "Данный компьютер занят в данный промежуток времени"])
                ->withInput();
        }
        else {

            // Создаем и добавление объекта в БД
            $ses_item = (new PC_ClubSes())->create($data);

            if ($ses_item){
                return redirect()
                    ->route('PC_Club.admin.Ses.edit', $ses_item->id)
                    ->with(['success' => 'Успешно сохранено']);
            }
            else {
                return back()
                    ->withErrors(['msg' => "Ошибка при сохранении"])
                    ->withInput();
            }

        }

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

        dd($ses_item);
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

        //dd($ses_item);
        if (empty($ses_item)){
            return back()
                ->withErrors(['msg' => "Запись id=[{$id}] не найдена"])
                ->withInput();
        }

        $data = $request -> all();
        //dd($data);

        if (empty($data['time_start'] &&  $data['time_end'])){
            return back()
                ->withErrors(['msg' => "Вы не указали дату и время"])
                ->withInput();
        }

        $bron = \DB::select('SELECT * FROM `p_c__club_ses` WHERE (`id_pc` = '.$data['id_pc'].') AND (((`time_start` < "'.$data['time_start'].'")
        AND (`time_end` > "'.$data['time_end'].'")) OR ((`time_start` > "'.$data['time_start'].'")
        AND (`time_end` < "'.$data['time_end'].'")) OR ((`time_end` > "'.$data['time_start'].'")
        AND (`time_start` < "'.$data['time_end'].'")))');

        if($bron == true ){
            return back()
                ->withErrors(['msg' => "Данный компьютер занят в данный промежуток времени"])
                ->withInput();
        }
        else {
            $result = $ses_item->fill($data)->save();

            if ($result){
                return redirect()
                    ->route('PC_Club.admin.Ses.edit', $ses_item->id)
                    ->with(['success' => 'Успешно сохранено']);
            }
            else {
                return back()
                    ->withErrors(['msg' => "Ошибка при сохранении"])
                    ->withInput();
            }
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
        //
    }
}
