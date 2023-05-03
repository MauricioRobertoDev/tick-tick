<?php

namespace App\Http\Livewire;

use App\Models\Tag;
use Livewire\Component;
use Livewire\WithPagination;

class TagList extends Component
{
    use WithPagination;

    public Tag $tag;

    public bool $showModal = false;

    public bool $showDeleteModal = false;

    public int $editedTagId = 0;

    public int $deleteTagId = 0;

    public function openModal()
    {
        $this->showModal = true;

        $this->tag = new Tag();
    }

    public function showDeleteModal($id)
    {
        $this->showDeleteModal = true;
        $this->deleteTagId = $id;
    }

    public function render()
    {
        $tags = Tag::paginate(100);

        return view('livewire.tag-list', [
            'tags' => $tags,
        ]);
    }

    public function save()
    {
        $this->validate();
        $this->tag->save();

        $this->resetValidation();
        $this->reset('showModal', 'editedTagId');
    }

     public function editTag($tagId)
    {
        $this->resetValidation();
        $this->editedTagId = $tagId;
        $this->tag = Tag::find($tagId);
    }

    public function delete()
    {
        Tag::findOrFail($this->deleteTagId)->delete();
        $this->reset('showDeleteModal', 'deleteTagId');
    }

    public function cancelTagEdit()
    {
        $this->resetValidation();
        $this->reset('editedTagId');
    }

    protected function rules(): array
    {
        return [
            'tag.name' => ['required', 'string', 'min:3'],
        ];
    }
}
