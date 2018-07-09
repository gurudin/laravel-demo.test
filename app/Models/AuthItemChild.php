<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AuthItemChild extends Model
{
    protected $table = 'auth_item_child';
    public $timestamps = false;

    /**
     * Remove auth item child
     * 
     * @param array $data = [
     *      'parent' => '',
     *      'method' => '',
     *      'child'  => [
     *          'child1',
     *          'child2',
     *          ...
     *       ]
     * ];
     * 
     * @return bool
     */
    public function removeItemChild(array $data)
    {
        $query = $this->where(['parent' => $data['parent'], 'method' => $data['method']]);
        if (isset($data['child'])) {
            $query->whereIn('child', $data['child']);
        }

        return $query->delete();
    }
}
