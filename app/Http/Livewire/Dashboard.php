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

    public $systole;
    public $diastole;
    public $pulse;
    public $is_irregular_hb;
    public $pulse_pressure;
    public $mean_arterial_pressure;
    public $location;
    public $posture;
    public $note;
    public $created_at;

    public $setRecordId;
    public $setProfileId;
    public $setSystole;
    public $setDiastole;
    public $setPulse;
    public $setIsIrregularHb;
    public $setPulsePressure;
    public $setMeanArterialPressure;
    public $setLocation;
    public $setPosture;
    public $setNote;
    public $setCreatedAt;

    public $currentProfileId;
    public $currentProfileName;
    public $currentProfileGender;
    public $currentProfileAge;

    public $addRecordModalStatus;
    public $addProfileModalStatus;
    public $updateProfileModalStatus;
    public $removeProfileModalStatus;
    public $updateRecordModalStatus;

    protected $rules = [
        'name' => 'required|min:2|max:32',
        'gender' => 'required',
        'age' => 'required|min:1|max:150',
        'systole' => 'required|numeric|min:0|max:350|gt:diastole',
        'diastole' => 'required|numeric|min:0|max:350|lt:systole',
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
        $currentProfileId = $this->currentProfileId;

        $profiles = Profile::select('id', 'name')->where('owner_id', auth()->id())->latest()->get();
        $records = Record::whereIn('profile_id', function ($query) {
                $query->select('id')->from('profiles')
                    ->where('owner_id', auth()->id());
            })
            ->when($currentProfileId != '', function ($query) use ($currentProfileId) {
                $query->where('profile_id', $currentProfileId);
            })
            ->latest()
            ->paginate(25);

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
        $this->updateProfileModalStatus = false;
        $this->removeProfileModalStatus = false;
        $this->updateRecordModalStatus = false;
    }

    public function submitProfile()
    {
        $validatedData = $this->validate([
            'name' => 'required|min:2|max:32|regex:/^[a-zA-Z\s]*$/',
            'gender' => 'required|in:male,female,other',
            'age' => 'nullable|numeric|digits_between:0,180'
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

    public function submitUpdateProfile()
    {
        $validatedData = $this->validate([
            'currentProfileName' => 'required|min:2|max:32|regex:/^[a-zA-Z\s]*$/',
            'currentProfileGender' => 'required|in:male,female,other',
            'currentProfileAge' => 'nullable|numeric|digits_between:0,180',
        ], [
        ], [
            'currentProfileName' => 'name',
            'currentProfileGender' => 'gender',
            'currentProfileAge' => 'age',
        ]);

        $profile = Profile::find($this->currentProfileId);
        $profile->owner_id = auth()->id();
        $profile->name = $this->currentProfileName;
        $profile->gender = $this->currentProfileGender;
        $profile->age = $this->currentProfileAge;
        $profile->update();

        $this->reset();

        $this->setCurrentProfile($profile->id);
    }

    public function submitRecord()
    {
        $validatedData = $this->validate([
            'systole' => 'required|numeric|min:0|max:350|gt:diastole',
            'diastole' => 'required|numeric|min:0|max:350|lt:systole',
            'pulse' => 'required|numeric|min:0|max:350',
            'is_irregular_hb' => 'nullable',
            'pulse_pressure' => 'nullable',
            'mean_arterial_pressure' => 'nullable',
            'location' => 'nullable',
            'posture' => 'nullable',
            'note' => 'nullable',
            'created_at' => 'nullable',
        ]);

        $record = new Record();
        $record->profile_id = $this->currentProfileId;
        $record->systole = $this->systole;
        $record->diastole = $this->diastole;
        $record->pulse = $this->pulse;
        $record->is_irregular_hb = $this->is_irregular_hb;
        $record->pulse_pressure = $this->pulse_pressure;
        $record->mean_arterial_pressure = $this->mean_arterial_pressure;
        $record->location = $this->location;
        $record->posture = $this->posture;
        $record->note = $this->note;
        $record->created_at = $this->created_at;
        $record->save();

        $this->reset();
        
        $this->setCurrentProfile($record->profile->id);
    }

    public function setRecord($recordId)
    {
        $record = Record::find($recordId);

        $this->setRecordId = $record->id;
        $this->setProfileId = $record->profile_id;
        $this->setSystole = $record->systole;
        $this->setDiastole = $record->diastole;
        $this->setPulse = $record->pulse;
        $this->setIsIrregularHb = $record->is_irregular_hb;
        $this->setPulsePressure = $record->pulse_pressure;
        $this->setMeanArterialPressure = $record->mean_arterial_pressure;
        $this->setLocation = $record->location;
        $this->setPosture = $record->posture;
        $this->setNote = $record->note;
        $this->setCreatedAt = $record->created_at->format('Y-m-d H:i:s');

        $this->updateRecordModalStatus = true;
    }

    public function submitUpdateRecord()
    {
        $validatedData = $this->validate([
            'setSystole' => 'required|numeric|min:0|max:350|gt:setDiastole',
            'setDiastole' => 'required|numeric|min:0|max:350|lt:setSystole',
            'setPulse' => 'required|numeric|min:0|max:350',
            'setIsIrregularHb' => 'nullable',
            'setPulsePressure' => 'nullable',
            'setMeanArterialPressure' => 'nullable',
            'setLocation' => 'nullable',
            'setPosture' => 'nullable',
            'setNote' => 'nullable',
            'setCreatedAt' => 'nullable',
        ]);

        $record = Record::find($this->setRecordId);
        $record->systole = $this->setSystole;
        $record->diastole = $this->setDiastole;
        $record->pulse = $this->setPulse;
        $record->is_irregular_hb = $this->setIsIrregularHb;
        $record->pulse_pressure = $this->setPulsePressure;
        $record->mean_arterial_pressure = $this->setMeanArterialPressure;
        $record->location = $this->setLocation;
        $record->posture = $this->setPosture;
        $record->note = $this->setNote;
        $record->created_at = $this->setCreatedAt;
        $record->update();

        $this->reset();

        $this->setCurrentProfile($record->profile->id);
    }

    public function setCurrentProfile($currentProfileId = null)
    {
        $this->currentProfileId = $currentProfileId;

        $profile = Profile::where('id', $this->currentProfileId)->first();
        
        if ($profile) {
            $this->currentProfileName = $profile->name;
            $this->currentProfileGender = $profile->gender;
            $this->currentProfileAge = $profile->age;
        } else {
            $this->currentProfileName = 'All Profiles';
        }

        $this->created_at = now()->format('Y-m-d H:i:s');

        $this->gotoPage(1);
    }

    public function removeCurrentProfile()
    {
        Profile::where('id', $this->currentProfileId)->first()->delete();
        $this->reset();
    }
}
