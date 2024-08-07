<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;

class UsersExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $users = User::where('name', 'like', '%' . request('name') . '%')
        ->orderBy('id', 'desc')->get();

        return $users;
    }
}
