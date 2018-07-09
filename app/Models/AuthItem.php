<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AuthItem extends Model
{
    protected $table = 'auth_item';
    public $timestamps = true;

    const TYPE_ROLE = 1;
    const TYPE_PERMISSION = 2;

    /**
     * Get permissions
     * @return array
     */
    public function getPermission()
    {
        return $this->getItems(self::TYPE_PERMISSION);
    }

    /**
     * Get Roles
     * @return array
     */
    public function getRole()
    {
        return $this->getItems(self::TYPE_ROLE);
    }

    /**
     * Get Items
     * @return array
     */
    public function getItems(int $type)
    {
        $result = [];
        $this->where(['type' => $type])->orderBy('created_at', 'desc')->chunk(100, function ($items) use(&$result) {
            foreach ($items as $item) {
                $result[] = $item->toArray();
            }
        });

        if ($type == self::TYPE_PERMISSION) {
            $route      = [];
            $permission = [];

            foreach ($result as $value) {
                if ($value['name'][0] == '/') {
                    $route[] = $value;
                } else {
                    $permission[] = $value;
                }
            }

            $item = [
                'route' => $route,
                'permission' => $permission,
            ];
        } else {
            $item = $result;
        }
        
        return $item;
    }

    /**
     * Save
     * 
     * @return primark_id
     */
    public function setItem(array $data)
    {
        $count = $this->where(['name' => $data['name'], 'method' => $data['method']])->count();
        if ($count == 0) {
            // Create
            $this->name        = $data['name'];
            $this->method      = $data['method'];
            $this->type        = $data['type'];
            $this->description = isset($data['description']) ? $data['description'] : '';
            
            return $this->save() ? true : false;
        } else {
            // Update
            $result = $this->where(['name' => $data['name'], 'method' => $data['method']])->update([
                'name'        => $data['name'],
                'method'      => $data['method'],
                'type'        => $data['type'],
                'description' => isset($data['description']) ? $data['description'] : '',
            ]);

            return $result ? true : false;
        }
    }

    /**
     * Remove by (name & method)
     * 
     * @return bool
     */
    public function removeItem(array $data)
    {
        $count = $this->where(['name' => $data['name'], 'method' => $data['method']])->count();
        if ($count == 0) {
            return true;
        }

        $m = new AuthItemChild;
        $m->removeItemChild(['parent' => $data['name'], 'method' => $data['method']]);
        
        return $this->where(['name' => $data['name'], 'method' => $data['method']])->delete();
    }
}
