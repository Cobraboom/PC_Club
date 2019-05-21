<?php


namespace App\Repositories;

use App\Models\PC_ClubSes as Model_Ses;
use Illuminate\Database\Eloquent\Collection;

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
        $columns =['id', 'id_pc', 'user_id', 'time_start', 'time_end'];

        $result = $this
            ->startConditions()
            ->select($columns)
            ->paginate($perPage);

        return $result;
    }

    /**
     * Проверка time_start и time_end
     *
     */

    public function getCheckTime(){

    }
}