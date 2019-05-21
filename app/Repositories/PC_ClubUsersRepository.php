<?php


namespace App\Repositories;

use App\Models\User as Model_User;
use Illuminate\Database\Eloquent\Collection;
/**
 * Class PC_ClubSesRepository
 *
 * @package App\Repositories
 */
class PC_ClubUsersRepository extends CoreRepository
{
    /**
     * @return string
     */
    protected function getModelClass()
    {
        return Model_User::class;
    }

    /**
     * Получить список User для вывода в выподающем списке
     *
     * @return Collection
     */
    public function getForComboBoxUser()
    {
        //return $this->startConditions()->all();

        $columns = implode(', ', [
                'id',
                'CONCAT (id, ". ", login) AS id_login',
        ]);

        /*$result[] = $this->startConditions()->all('id', 'login');
        $result[] = $this
            ->startConditions()
            ->select('users.*',
                \DB::raw('CONCAT (id, ". ", login) AS id_login'))
            ->toBase()
            ->get();*/

        $result = $this
            ->startConditions()
            ->selectRaw($columns)
            ->toBase()
            ->get();

        //dd($result);

        return $result;
    }
}