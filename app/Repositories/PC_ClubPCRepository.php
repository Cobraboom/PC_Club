<?php


namespace App\Repositories;

use App\Models\PC_ClubPC as Model_PC;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class PC_ClubPCRepository
 *
 * @package App\Repositories
 */
class PC_ClubPCRepository extends CoreRepository
{
    /**
     * @return string
     */
    protected function getModelClass()
    {
        return Model_PC::class;
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
        $columns =['id', 'PC_Name', 'PC_info'];

        $result = $this
            ->startConditions()
            ->select($columns)
            ->paginate($perPage);

        return $result;
    }

    /**
     * Получить список PC для вывода в выпадающем списке.
     *
     * @return Collection
     */
    public function getForComboBoxPC()
    {
        /*return $this->startConditions()->all();

        $result[] = $this->startConditions()->all();*/

        $columns = implode(', ', [
            'id',
            'CONCAT (id, ". ", PC_Name) AS id_PCname'
        ]);

        $result = $this
            ->startConditions()
            ->selectRaw($columns)
            ->toBase()
            ->get();

        //dd($result);

        return $result;
    }

    /**
     * Проверка полей при update
     *
     * @param $PC_item
     * @param $data
     * @param int $id
     * @return \Illuminate\Http\Response\
     *
     */
    public function getCheckFormUpdate($PC_item, $data, $id){

        // Запрос на существование данных
        $check = \DB::select('SELECT * FROM `p_c__club_p_c_s` WHERE (`id` != '.$id.') AND (`PC_Name` = "'.$data['PC_Name'].'")');

        // Проверка на существование записи
        if (empty($PC_item)){
            return back()
                ->withErrors(['msg' => "Запись id=[{$id}] не найдена"])
                ->withInput();
        }

        // Проверка на заполнение полей
        if (empty($data['PC_Name'] && $data['PC_Info'])){
            return back()
                ->withErrors(['msg' => "Заполните поля"])
                ->withInput();
        }

        // Проверка на существование данных
        if($check == true){
            return back()
                ->withErrors(['msg' => "Данное имя уже занято"])
                ->withInput();
        }
        else {
            $result = $PC_item->fill($data)->save();

            if ($result){
                return redirect()
                    ->route('PC_Club.admin.PC.edit', $PC_item->id)
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
     * Проверка полей при store
     *
     * @param $data
     *
     * @return \Illuminate\Http\Response\
     *
     */
    public function getCheckFormStore($data){

        // Запрос на существование данных
        $check_1 = \DB::select('SELECT * FROM `p_c__club_p_c_s` WHERE (`PC_Name` = "'.$data['PC_Name'].'")');

        // Проверка на заполнение полей
        if (empty($data['PC_Name'] && $data['PC_Info'])){
            return back()
                ->withErrors(['msg' => "Заполните поля"])
                ->withInput();
        }

        if($check_1 == true){
            return back()
                ->withErrors(['msg' => "Данное имя уже занято"])
                ->withInput();
        }
        else {

            // Создаем и добавление объекта в БД
            $PC_item = (new Model_PC())->create($data);

            if ($PC_item){
                return redirect()
                    ->route('PC_Club.admin.PC.edit', $PC_item->id)
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