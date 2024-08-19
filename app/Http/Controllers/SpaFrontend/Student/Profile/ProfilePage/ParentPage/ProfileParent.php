<?php

namespace App\Http\Controllers\SpaFrontend\Student\Profile\ProfilePage\ParentPage;

use App\Models\Backend\UserManagement\Student;
use Livewire\Component;

class ProfileParent extends Component
{
    public $first_name, $last_name, $email, $description;
    public $current_password, $new_password, $confirm_password;

    public function mount()
    {
        $this->first_name   = auth()->user()->student->first_name ?? '';
        $this->last_name   = auth()->user()->student->last_name ?? '';
        $this->email   = auth()->user()->student->email ?? '';
        $this->description   = auth()->user()->student->description ?? '';
    }

    protected function resetProfileForm()
    {
        $this->first_name   = auth();
    }
    protected function resetPasswordForm()
    {
        $this->current_password = '';
        $this->new_password = '';
        $this->confirm_password = '';
    }

    public function render()
    {
        return view('spa-frontend.student.profile.profile-page.parent-page.profile-parent')->layout('spa-frontend.student-master');
    }

    public function updateStudentProfile()
    {
        $user = auth()->user();
        $student    = Student::where('user_id', $user->id)->first();
        if ($student)
        {
            $student->first_name   = $this->first_name;
            $student->last_name   = $this->last_name;
            $user->email   = $this->email;
            $student->email   = $this->email;
            $student->description   = $this->description;
            $student->save();
            $user->save();
        }

    }

    public function updatePassword()
    {
        if (password_verify($this->current_password, auth()->user()->password))
        {
            if ($this->new_password == $this->confirm_password)
            {
                $user = auth()->user();
                $user->password = bcrypt($this->new_password);
                $user->save();
                $this->resetPasswordForm();
            }
        }
    }
}
