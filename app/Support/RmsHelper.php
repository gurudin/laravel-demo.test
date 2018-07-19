<?php

namespace App\Support;

use App\Models\Menu;
use App\Models\User;
use App\Models\AuthGroupChild;
use App\Models\AuthGroup;
use App\Models\AuthAssignment;

class RmsHelper
{
    public static $admin = [
        '4008353@qq.com',
    ];

    public static function getAuthUser(User $user, int $group_id)
    {
        $groupChildModel = new AuthGroupChild;
        $groupModel      = new AuthGroup;

        if (in_array($user->email, self::$admin)) {
            $user_res  = $user->getUser();
            $child_res = $groupChildModel->extendProfile($user_res);
            $group_res = $groupModel->extendProfile($child_res, 'group_id');

            foreach ($child_res as &$child) {
                foreach ($group_res as $group) {
                    if ($group['id'] == $child['group_id']) {
                        $child['name'] = $group['name'];
                    }
                }
            }
            unset($child);

            foreach ($user_res as &$value) {
                foreach ($child_res as $child) {
                    if ($value['id'] == $child['child']) {
                        $value['group'][] = ['id' => $child['group_id'], 'name' => $child['name']];
                    }
                }
            }
            unset($value);
        } else {
            $user_to_group = $groupChildModel->getGroupUserChild($group_id);
            $group_res     = $groupModel->getGroup($group_id);
            $user_res      = $user->extendProfile($user_to_group, 'child');

            foreach ($user_res as &$value) {
                $value['group'][] = ['id' => $group_res->id, 'name' => $group_res->name];
            }
            unset($value);
        }

        return $user_res;
    }

    /**
     * Get auth group by user
     * 
     * @param User $user
     * 
     * @return array
     */
    public static function authGroup(User $user)
    {
        $m = new AuthGroupChild;
        
        $group_arr = $m->getGroupByType($m::TYPE_USER, $user->id);

        $result = (new AuthGroup)->extendProfile($group_arr, 'group_id');

        return $result;
    }

    /**
     * Get auth menu by user
     * 
     * @param User $user
     * @param int $group_id
     * 
     * @return array
     */
    public static function authMenu(User $user, int $group_id = 0)
    {
        if (in_array($user->email, self::$admin)) {
            $menu_res = (new Menu)->getMenu();
        } else {
            $assign_res = (new AuthAssignment)->getAuthAssignment($user->id, $group_id);
        }
        
        $menu_item = [];
        foreach ($menu_res as $menu) {
            $menu_item[] = [
                'id'     => $menu['id'],
                'text'   => $menu['title'],
                'href'   => $menu['route'],
                'icon'   => $menu['data'] ? json_decode($menu['data'])->icon : '',
                'parent' => $menu['parent'],
            ];
        }
        unset($menu);

        $tree = self::getTree($menu_item, null);
        
        return $tree;
    }

    public static function getTree($data, $pId)
    {
        $tree = array();
        
        foreach($data as $k => $v) {
            if($v['parent'] == $pId) {    
                $v['children'] = self::getTree($data, $v['id']);
                $tree[] = $v;
                unset($data[$k]);
            }
        }
        
        return $tree;
    }
}
