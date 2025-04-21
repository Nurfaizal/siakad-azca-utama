<?php

namespace App\Livewire;

use App\Models\Answer;
use App\Models\Exam;
use App\Models\Question;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\WithFileUploads;

class CreateExamQuestions extends Component
{
    use WithFileUploads;

    public $exam = null;
    public $question = [];
    public $answer = [];
    public $id_exam;

    public $type = [];
    public $pointQuest = [];
    public $question_text = [];
    public $question_image = [];
    public $answer_text = [];
    public $answerKey = [];

    public function render()
    {
        return view('livewire.create-exam-questions');
    }

    public function mount($id_exam)
    {
        $this->id_exam = Crypt::decrypt($id_exam);
        $this->exam = Exam::find($this->id_exam)->first();
        $this->question = Question::where('exam_id', $this->id_exam)->get();
        $this->answer = Answer::all();
        foreach ($this->question as $q) {
            $this->question_text += [$q->id => $q->question];
            $this->type += [$q->id => $q->type];
            $this->pointQuest += [$q->id => $q->point];
        }

        // dd($this->pointQuest);

        foreach ($this->answer as $a) {
            $this->answer_text += [$a->id => $a->answer];
            $this->answerKey += [$a->id => $a->answer_key];
        }
        // dd($this->answerKey);
    }

    #[On('updateView')]
    public function updateView()
    {
        $this->question = Question::where('exam_id', $this->id_exam)->get();
        $this->answer = Answer::all();
        foreach ($this->question as $q) {
            $this->question_text += [$q->id => $q->question];
            $this->type += [$q->id => $q->type];
            $this->pointQuest += [$q->id => $q->point];
        }

        foreach ($this->answer as $a) {
            $this->answer_text += [$a->id => $a->answer];
            $this->answerKey += [$a->id => $a->answer_key];
        }
    }

    public function addNewQuestion()
    {
        Question::create([
            'exam_id' => $this->id_exam,
            'question' => "Masukkan pertanyaan...",
            'type' => 'multi', // ['multi', 'binary', 'essay']
            'point' => 0
        ]);

        $this->dispatch('updateView');
    }

    public function addNewAnswer($questId)
    {
        Answer::create([
            'question_id' => $questId,
            'answer' => "Masukkan jawaban...",
        ]);

        $this->dispatch('updateView');
    }

    #[On('updateQuestion')]
    public function updateQuestion($id)
    {
        $this->validate([
            "question_image.$id" => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            "question_text.$id" => 'required|string',
            "type.$id" => 'required|in:multi,binary,essay',
            "pointQuest.$id" => 'nullable|numeric|min:0',
        ]);

        if ($this->question_text[$id] == null || $this->type[$id] == null) {
            return;
        }


        $quest = Question::find($id);

        $imagePath = $quest->question_image ? $quest->question_image : null;
        if (isset($this->question_image[$id])) {
            $quest->question_image ? Storage::disk()->delete($quest->question_image) : '';
            $imagePath = $this->question_image[$id]->store('question_images');
        }

        Question::find($id)->update([
            'exam_id' => $this->id_exam,
            'question' => $this->question_text[$id],
            'question_image' => $imagePath ?? null,
            'type' => $this->type[$id], // ['multi', 'binary', 'essay']
            'point' => intval($this->pointQuest[$id]),
        ]);


        if ($this->type[$id] != $quest->type) {
            Answer::where('question_id', $id)->delete();
            if ($this->type[$id] == 'binary') {
                Answer::create([
                    'question_id' => $id,
                    'answer' => 'True',
                    'answer_key' => true,
                ]);
                Answer::create([
                    'question_id' => $id,
                    'answer' => 'False',
                    'answer_key' => false,
                ]);
            }
        }

        $this->dispatch('updateView');
    }

    #[On('updateAnswer')]
    public function updateAnswer($id)
    {
        if ($this->answer_text[$id] == null) {
            return;
        }

        Answer::where('id', $id)->update([
            'answer' => $this->answer_text[$id],
            'answer_key' => $this->answerKey[$id],
        ]);

        $this->dispatch('updateView');
    }

    #[On('updateAnswerKey')]
    public function updateAnswerKey($questId, $id)
    {
        Answer::where('question_id', $questId)->update([
            'answer_key' => false,
        ]);
        Answer::find($id)->update([
            'answer_key' => true,
        ]);

        $this->dispatch('updateView');
    }

    public function clearAnswerKey($id)
    {


        Answer::where('question_id', $id)->update([
            'answer_key' => false,
        ]);
        $this->dispatch('updateView');

        return redirect()->back();
    }

    public function deleteQuestion($id)
    {
        $quest = Question::find($id);
        $quest->question_image ? Storage::disk()->delete($quest->question_image) : '';
        $quest::destroy($id);
        Answer::where('question_id', $id)->delete();
        $this->dispatch('updateView');
    }

    public function deleteAnswer($id)
    {
        Answer::where('id', $id)->delete();
        $this->dispatch('updateView');
    }
}
