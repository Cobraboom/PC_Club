<?php

namespace App\Http\Controllers\PC_Club\Admin;

use App\Models\PC_ClubPC;
use App\Models\PC_ClubSes;
use App\Models\User;
use Illuminate\Http\Request;


class Ses_Controller extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $paginator = PC_ClubSes::paginate(5);

        return view('PC_Club.admin.Ses.index', compact('paginator'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        $ses_item = PC_ClubSes::findOrFail($id);
        $PC_list = PC_ClubPC::all();
        $User_list = User::all('id', 'login');

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
    public function update(Request $request, $id)
    {
        //dd(__METHOD__, $request->all(), $id);
        $ses_item = PC_ClubSes::find($id);

        //dd($ses_item);
        if (empty($ses_item)){
            return back()
                ->withErrors(['msg' => "Запись id=[{$id}] не найдена"])
                ->withInput();
        }

        $data =$request->all();
        //dd($data);

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