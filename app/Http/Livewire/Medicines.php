<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Medicine;
use Livewire\WithPagination;

class Medicines extends Component
{
    use WithPagination;

    public $q;
    public $perPage = 30;

    protected $queryString = [
        'q' => ['except' => ''],
        'perPage' => ['except' => 30],
    ];

    public function render()
    {
        return view('livewire.medicines', ['medicines' => $this->load()]);
    }

    public function load()
    {
        $query = Medicine::query();
        $searchs = explode(' ', $this->q);
        foreach ($searchs as $paramete) {
            $query = $query->where('name', 'like', '%' . $paramete . '%');
        }
        $query = $query->orderBy('id');

        return $query->paginate($this->perPage);
    }
}