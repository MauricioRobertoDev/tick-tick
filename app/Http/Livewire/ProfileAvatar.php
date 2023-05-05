<?php

namespace App\Http\Livewire;

use App\Models\User;
use File;
use Livewire\Component;
use Livewire\WithFileUploads;
use Intervention\Image\ImageManager;
use Illuminate\Support\Facades\Storage;

class ProfileAvatar extends Component
{
    use WithFileUploads;

    /** @var \Livewire\TemporaryUploadedFile */
    public $avatar;

    public string $status;

    public User $user;

    public function mount()
    {
        $this->user = request()->user();
    }

    public function render()
    {
        return view('livewire.profile-avatar');
    }

    public function updatedAvatar()
    {
        $this->validate();
    }

    public function save()
    {
        $this->validate();

        $imagePath = 'avatars/' . $this->avatar->hashName();
        (new ImageManager())->make($this->avatar->path())->resize(80, 80)->save(public_path($imagePath), 100);

        if ($this->user->avatar && File::exists($this->user->avatar)) {
            File::delete($this->user->avatar);
        }

        $this->user->update([
            'avatar' => $imagePath,
        ]);

        $this->reset('avatar');

        $this->status = 'Imagem atualizada';
    }

    protected function rules()
    {
        return [
            'avatar' => 'required|image|max:1024|dimensions:min_width=80,min_height=80,ratio=1/1|mimes:jpg,jpeg,png,webp', // 1MB Max
        ];
    }

    protected function messages()
    {
        return [
            'avatar.dimensions' => 'A imagem deve ter ser um quadrado de no mínimo 80x80',
            'ratio' => 'A imagem deve ser um quadrado',
            'avatar.max' => 'A imagem deve ter no máximo 1MB',
        ];
    }
}
