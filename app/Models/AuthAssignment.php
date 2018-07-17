<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class AuthAssignment extends Model
{
    protected $table = 'auth_assignment';
    public $timestamps = true;

    /**
     * Get auth assignment (by user_id,group_id)
     *
     * @param string $user_id (required)
     * @param int $group_id=0
     *
     * @return array
     */
    public function getAuthAssignment(string $user_id, int $group_id)
    {
        $result = [];
        $this->where([
            'user_id' => $user_id,
            'group_id' => $group_id
        ])->orderBy('item_name', 'asc')->chunk(100, function ($items) use (&$result) {
            foreach ($items as $item) {
                $result[] = $item->toArray();
            }
        });

        return $result;
    }
}
