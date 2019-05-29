<?php


namespace App\Repositories;



use App\Models\PC_ClubSes as Model_Ses;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;

/**
 * Class PC_ClubSesRepository
 *
 * @package App\Repositories
 */
class PC_ClubSesRepository extends CoreRepository
{
    /**
     * @return string
     */
    protected function getModelClass()
    {
        return Model_Ses::class;
    }


    /**
     * Получить модель для редактирования в Админке
     *
     * @param int $id
     *
     * @return Model
     */
    public function getEdit($id)
    {
        return $this->startConditions()->find($id);
    }

    /**
     * Получить категорию для вывода пагинатором
     *
     *@param int|null $perPage
     *
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getAllWithPaginate($perPage = null)
    {
        if (\Auth::check()){

            $user_id = Auth::user()->id;
            $is_admin = Auth::user()->is_admin;


            //dd($user_id, $is_admin);
            if ($is_admin == true){

                $columns =['id', 'id_pc', 'user_id', 'time_start', 'time_end'];
                $result = $this
                    ->startConditions()
                    ->select($columns)
                    ->orderBy('id', 'DESC')
                    ->with(['user:id,login'])
                    ->paginate($perPage);
                //dd($result -> first());
                return $result;

            }
            else{
                $columns =['id', 'id_pc', 'user_id', 'time_start', 'time_end'];
                $result = $this
                    ->startConditions()
                    ->select($columns)
                    ->orderBy('id', 'DESC')
                    ->with(['user:id,login'])
                    ->latest('user_id')
                    ->where('user_id', '=', $user_id)
                    ->paginate($perPage);

                return $result;
            }
        }


    }

    /**
     * Проверка time_start и time_end,
     *
     * И прочих условий при update.
     *
     * @param  $ses_item
     * @param  int  $id
     * @param  $data
     * @return \Illuminate\Http\Response
     */

    public function getConditionCheckUpdate($ses_item, $data, $id){

        $bron = \DB::select('SELECT * FROM `p_c__club_ses` WHERE (`id_pc` = '.$data['id_pc'].') AND (((`time_start` < "'.$data['time_start'].'")
        AND (`time_end` > "'.$data['time_end'].'")) OR ((`time_start` > "'.$data['time_start'].'")
        AND (`time_end` < "'.$data['time_end'].'")) OR ((`time_end` > "'.$data['time_start'].'")
        AND (`time_start` < "'.$data['time_end'].'")))');

        if (empty($ses_item)){
            return back()
                ->withErrors(['msg' => "Запись id=[{$id}] не найдена"])
                ->withInput();
        }

        if (empty($data['time_start'] &&  $data['time_end'])){
            return back()
                ->withErrors(['msg' => "Вы не указали дату и время"])
                ->withInput();
        }

        if($bron == true ){
            return back()
                ->withErrors(['msg' => "Данный компьютер занят в данный промежуток времени"])
                ->withInput();
        }
        else {
            $result = $ses_item->update($data);
            //dd($result);
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
     * Проверка time_start и time_end,
     *
     * И прочих условий при store.
     *
     * @param  $data
     * @return \Illuminate\Http\Response
     */
    public function getConditionCheckStore($data){

        $bron = \DB::select('SELECT * FROM `p_c__club_ses` WHERE (`id_pc` = '.$data['id_pc'].') AND (((`time_start` < "'.$data['time_start'].'")
        AND (`time_end` > "'.$data['time_end'].'")) OR ((`time_start` > "'.$data['time_start'].'")
        AND (`time_end` < "'.$data['time_end'].'")) OR ((`time_end` > "'.$data['time_start'].'")
        AND (`time_start` < "'.$data['time_end'].'")))');

        if (empty($data['time_start'] && $data['time_end'])){
            return back()
                ->withErrors(['msg' => "Вы не указали дату и время"])
                ->withInput();
        }

        if($bron == true ){
            return back()
                ->withErrors(['msg' => "Данный компьютер занят в данный промежуток времени"])
                ->withInput();
        }
        else {
            // Создаем и добавление объекта в БД

            $is_admin =Auth::user()->is_admin;

            if ($is_admin == false){
                $user_id = Auth::user()->id;
                $data = [
                    '_token' => $data['_token'],
                    'user_id' => $user_id,
                    'time_start' => $data['time_start'],
                    'time_end' => $data['time_end'],
                    'id_pc' => $data['id_pc']
                ];
                $ses_item = (new Model_Ses())->create($data);

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
            else{
                $ses_item = (new Model_Ses())->create($data);

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
    }
}