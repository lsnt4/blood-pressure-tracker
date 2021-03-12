<?php

namespace App\Http\Livewire;

use App\Models\Record;
use App\Models\Profile;
use Livewire\Component;
use Livewire\WithPagination;

class Dashboard extends Component
{
    use WithPagination;

    public $profileId;
    public $profileName;
    public $toggleAddRecordModalStatus;
    public $toggleAddProfileModalStatus;

    protected $rules = [
        'name' => 'required|min:2|max:32',
        'gender' => 'required',
        'age' => 'required|min:1|max:150',
        'systolic' => 'required|numeric|min:0|max:350|gt:diastolic',
        'diastolic' => 'required|numeric|min:0|max:350|lt:systolic',
        'pulse' => 'required|numeric|min:0|max:350',
        'is_irregular_hb' => 'nullable',
        'pulse_pressure' => 'nullable',
        'mean_arterial_pressure' => 'nullable',
        'location' => 'nullable',
        'posture' => 'nullable',
        'note' => 'nullable',
    ];

    public function render()
    {
        $profiles = Profile::select('id', 'name')->where('owner_id', auth()->id())->get();
        $records = Record::whereIn('profile_id', function ($query) {
            $query->select('id')->from('profiles')
                ->where('owner_id', auth()->id());
        })->paginate(10);

        return view('livewire.dashboard', [
                'profiles' => $profiles,
                'records' => $records,
            ]
        )->layout('layouts.app');
    }

    public function mount()
    {
        $this->toggleAddRecordModalStatus = false;
        $this->toggleAddProfileModalStatus = false;
    }

    public function toggleAddRecordModal()
    {
        $this->toggleAddRecordModalStatus = !$this->toggleAddRecordModalStatus;
    }

    public function toggleAddProfileModal()
    {
        $this->toggleAddProfileModalStatus = !$this->toggleAddProfileModalStatus;
    }

    public function setCurrentProfile($profileId)
    {
        $this->profileId = $profileId;

        $this->profileName = Profile::find($this->profileId)->first()->name;
    }
}
