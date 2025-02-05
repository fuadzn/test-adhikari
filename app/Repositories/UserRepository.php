<?php

namespace App\Repositories;

use Illuminate\Support\Facades\Http;


use App\Models\User;

class UserRepository
{
    public function getAll()
    {
        return User::all();
    }

    public function findById($id)
    {
        return User::findOrFail($id);
    }

    public function create(array $data)
    {
        return User::create($data);
    }

    public function update($id, array $data)
    {
        $user = User::findOrFail($id);
        $user->update($data);
        return $user;
    }

    public function delete($id)
    {
        $user = User::findOrFail($id);
        return $user->delete();
    }

    public function getBy()
    {
        $response = Http::get('https://ogienurdiana.com/career/ecc694ce4e7f6e45a5a7912cde9fe131');

        if ($response->successful()) {
            $data = $response->json();

            $rows = explode("\n", trim($data['DATA']));

            $headers = explode('|', array_shift($rows));
            $columns = array_flip($headers);

            $collection = collect($rows)->map(function ($row) use ($columns) {
                $values = explode('|', $row);
                return [
                    'NIM'  => $values[$columns['NIM']] ?? NULL,
                    'NAMA' => $values[$columns['NAMA']] ?? NULL,
                    'YMD'  => $values[$columns['YMD']] ?? NULL,
                ];
            });
            return $collection;
        } else {
            return response()->json(['error' => 'Failed to fetch data'], 500);
        }
    }

    public function getByNama($nama)
    {
        $filteredData = $this->getBy()->where('NAMA', $nama);

        return response()->json($filteredData);
    }

    public function getByNIM($NIM)
    {
        $filteredData = $this->getBy()->where('NIM', $NIM);

        return response()->json($filteredData);
    }

    public function getByYMD($YMD)
    {
        $filteredData = $this->getBy()->where('YMD', $YMD);

        return response()->json($filteredData);
    }
}
