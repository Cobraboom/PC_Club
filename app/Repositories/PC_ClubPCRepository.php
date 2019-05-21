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

}