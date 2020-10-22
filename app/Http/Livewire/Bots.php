<?php

namespace App\Http\Livewire;


use App\Models\Telegram;
use Livewire\Component;

class Bots extends Component
{

    public $bots, $chatid, $question, $answer, $masa, $masacron, $tele_id;
    public $isOpen= 0;

    public function render()
    {

        $this->bots = Telegram::all();
        return view('livewire.bots');
    }

    public function create()
    {
        $this->resetInputFields();
        $this->openModal();
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function openModal()
    {
        $this->isOpen = true;
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function closeModal()
    {
        $this->isOpen = false;
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    private function resetInputFields()
    {
        $this->chatid = '';
        $this->question = '';
        $this->tele_id = '';
        $this->answer = '';
        $this->masa= '';
        $this->masacron = '';

    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function store()
    {
        $this->validate([
            'chatid' => 'required',
            'question' => 'required',
            'answer' => 'required',
            'masa' => 'required',
            'masacron' => 'required',
        ]);

        Telegram::updateOrCreate(['id' => $this->tele_id], [
            'chatid' => $this->chatid,
            'question' => $this->question,
            'answer' => $this->answer,
            'masa' => $this->masa,
            'masacron' => $this->masacron,
        ]);

        session()->flash(
            'message',
            $this->tele_id ? 'Blog Updated Successfully.' : 'Blog Created Successfully.'
        );

        $this->closeModal();
        $this->resetInputFields();
    }
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function edit($id)
    {
        $tele = Telegram::findOrFail($id);
        $this->tele_id = $id;
        $this->chatid = $tele->chatid;
        $this->question = $tele->question;
        $this->answer = $tele->answer;
        $this->masa = $tele->masa;
        $this->masacron = $tele->masacron;


        $this->openModal();
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function delete($id)
    {
        Telegram::find($id)->delete();
        session()->flash('message', 'Blog Deleted Successfully.');
    }
}
