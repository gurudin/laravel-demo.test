<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AuthGroup extends Model
{
    protected $table = 'auth_group';
    public $timestamps = false;

    /**
     * Get group (by id)
     */
    public function getGroup(int $id = 0)
    {
        if ($id == 0) {
            $result = [];
            $this->orderBy('id', 'desc')->chunk(100, function ($items) use(&$result) {
                foreach ($items as $item) {
                    $result[] = $item->toArray();
                }
            });

            return $result;
        } else {
            return $this->where(['id' => $id])->first();
        }
    }

    /**
     * Save
     * 
     * @return primark_id
     */
    public function setGroup(array $data)
    {
        if (isset($data['id']) && !empty($data['id'])) {
            // Update
            $result = $this->where(['id' => $data['id']])->update([
                'name' => $data['name'],
                'description' => $data['description'] ? $data['description'] : ''
            ]);

            return $result ? $data['id'] : false;
        } else {
            // Create
            $this->name = $data['name'];
            $this->description = $data['description'] ? $data['description'] : '';

            return $this->save() ? $this->id : false;
        }
    }

    /**
     * Remove group by id
     * 
     * @param int $group_id
     * 
     * @return bool
     */
    public function removeGroup(int $id)
    {
        return $this->where(['id' => $id])->delete();
    }
}
