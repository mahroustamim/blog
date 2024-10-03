<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Category;

class CategoryPolicy
{
    public function admin(User $user) 
    {
        return $user->status == 'admin';
    }
}
