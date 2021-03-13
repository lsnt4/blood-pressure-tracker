<?php

namespace App\Http\Livewire;

use App\Models\Record;
use App\Models\Profile;
use Livewire\Component;
use Livewire\WithPagination;

class Dashboard extends Component
{
    use WithPagination;

    public $name;
    public $gender;
    public $age;

    public $profileId;
    public $profileName;
    public $addRecordModalStatus;
    public $addProfileModalStatus;
    public $removeProfileModalStatus;

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
        $profileId = $this->profileId;

        $profiles = Profile::select('id', 'name')->where('owner_id', auth()->id())->latest()->get();
        $records = Record::whereIn('profile_id', function ($query) {
                $query->select('id')->from('profiles')
                    ->where('owner_id', auth()->id());
            })
            ->when($profileId != '', function ($query) use ($profileId) {
                $query->where('profile_id', $profileId);
            })
            ->latest()
            ->paginate(10);

        return view('livewire.dashboard', [
                'profiles' => $profiles,
                'records' => $records,
            ]
        )->layout('layouts.app');
    }

    public function mount()
    {
        $this->addRecordModalStatus = false;
        $this->addProfileModalStatus = false;
        $this->removeProfileModalStatus = false;
    }

    public function submitProfile()
    {
        $validatedData = $this->validate([
            'name' => 'required|min:2|max:32|regex:/^[a-zA-Z\s]*$/',
            'gender' => 'required|in:male,female,other',
            'age' => 'required|numeric|digits_between:0,180'
        ]);

        $profile = new Profile();
        $profile->owner_id = auth()->id();
        $profile->name = $this->name;
        $profile->gender = $this->gender;
        $profile->age = $this->age;
        $profile->save();

        $this->reset();

        $this->setCurrentProfile($profile->id);
    }

    public function setCurrentProfile($profileId = null)
    {
        $this->profileId = $profileId;

        $profile = Profile::where('id', $this->profileId)->first();

        if ($profile) {
            $this->profileName = $profile->name;
        } else {
            $this->profileName = 'All Profiles';
        }

        $this->gotoPage(1);
    }

    public function removeCurrentProfile()
    {
        Profile::where('id', $this->profileId)->first()->delete();
        $this->reset();
    }
}
