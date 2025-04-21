<div class="card">
    <div class="border rounded mt-5 p-4 bg-transparent">
        <h1 class="text-md font-semibold text-slate-800 capitalize mb-3 text-center">{{ $exam->name }}</h1>
        <p class="text-slate-500 font-light text-center text-sm"><span class="text-slate-700 font-medium">Catatan:
            </span>{{ $exam->note }}</p>
    </div>
    {{-- <form> --}}
    <div class="card-body">
        <div class="grid grid-cols-1 gap-3 my-10">
            @foreach ($question as $quest)
                <div class="flex flex-col justify-center items-start border rounded-lg mb-5 p-5">
                    @if (isset($quest->question_image))
                        <div class="flex justify-start w-full">
                            <img src="{{ asset('storage/' . $quest->question_image) }}" alt="gambar-soal"
                                class="max-w-full mb-3">
                        </div>
                    @endif
                    <div class="flex w-full items-center mb-4">
                        <label>{{ $loop->iteration }}. </label>
                        <input type="text" wire:keydown="updateQuestion({{ $quest->id }})"
                            class="border-b w-full block p-2 ms-2  text-gray-600" placeholder="Masukkan pertanyaan..."
                            value="{{ $quest->question }}" wire:model="question_text.{{ $quest->id }}">
                    </div>
                    <form class="flex gap-3 my-3 flex-wrap" wire:submit="updateQuestion({{ $quest->id }})">
                        <div>
                            <input type="file" class="border-b block text-gray-600"
                                placeholder="Masukkan pertanyaan..." wire:model="question_image.{{ $quest->id }}">
                            <h1 class="text-xs font-light text-slate-600 italic mt-2">Opsional | Format: jpeg, png,
                                jpg, gif
                            </h1>
                        </div>
                        <button type="submit" class="bg-teal-500 text-white w-12 h-12 rounded"><i
                                class="bi bi-save"></i></button>
                    </form>
                    <div class="w-full">
                        @foreach ($answer as $ans)
                            @if ($ans->question_id == $quest->id)
                                @if ($quest->type == 'multi')
                                    <div class="form-group my-2 w-100">

                                        <input type="radio" name="answer_key{{ $quest->id }}"
                                            {{ $ans->answer_key ? 'checked' : '' }} class="border me-2"
                                            wire:click="updateAnswerKey({{ $quest->id }}, {{ $ans->id }})"
                                            value="option{{ $ans->id }}">
                                        <label for="" style="min-width: 50%; max-width:70%"><input
                                                type="text" class="border-0 bg-transparent w-100"
                                                value="{{ $ans->answer }}"
                                                wire:model="answer_text.{{ $ans->id }}"
                                                wire:keydown="updateAnswer({{ $ans->id }})"></label>
                                        <button type="button" class="badge bg-secondary border-0"
                                            wire:click="deleteAnswer({{ $ans->id }})"><i
                                                class="bi bi-trash"></i></button>
                                    </div>
                                @elseif ($quest->type == 'binary')
                                    <div class="form-group my-2">
                                        <input type="radio" name="answer_key{{ $quest->id }}"
                                            {{ $ans->answer_key ? 'checked' : '' }} class="border me-2"
                                            wire:click="updateAnswerKey({{ $quest->id }}, {{ $ans->id }})"
                                            value="option{{ $ans->id }}">
                                        <label for=""><input type="text" class="border-0 bg-transparent"
                                                value="{{ $ans->answer }}"
                                                wire:model="answer_text.{{ $ans->id }}"
                                                wire:keydown="updateAnswer({{ $ans->id }})"></label>
                                    </div>
                                @endif
                            @endif
                        @endforeach

                        @if ($quest->type == 'essay')
                            <div class="">
                                <textarea class="text-slate-600 text-sm mt-2 w-full rounded-lg border p-2"></textarea>
                            </div>
                        @endif
                        @if ($quest->type == 'multi')
                            <div class="flex justify-start gap-4 flex-wrap">
                                <button type="button" wire:click="addNewAnswer({{ $quest->id }})"
                                    class="btn-block px-3 py-2 mt-3 bg-secondary-subtle border"><i
                                        class="bi bi-patch-plus"></i>
                                    Tambah
                                    Jawaban</button>
                                <button type="button" id="clearAnswer"
                                    wire:click="clearAnswerKey({{ $quest->id }})"
                                    class="clearAnswer btn-block px-3 py-2 mt-3 bg-slate-700 text-white border"><i
                                        class="bi bi-patch-minus"></i>
                                    Hapus Kunci Jawaban</button>
                            </div>
                        @endif
                    </div>
                    <div class="flex gap-3 border-t w-full mt-5 py-3 justify-between">
                        <select wire:click="updateQuestion({{ $quest->id }})" wire:model="type.{{ $quest->id }}"
                            class=" block w-full rounded-lg border p-2.5 text-sm text-gray-600 focus:border-red-500 focus:ring-red-500"
                            style="max-width: 250px" aria-label="Default select example">
                            <option value="{{ $quest->type }}">
                                @if ($quest->type == 'multi')
                                    Multi Option
                                @elseif($quest->type == 'binary')
                                    Binary Option
                                @else
                                    Essay
                                @endif
                            </option>
                            <option value="multi">Multi Option
                            </option>
                            <option value="binary">Binary
                                Option</option>
                            <option value="essay">Essay
                            </option>
                        </select>
                        <div class="flex gap-3 items-center">
                            <label for="point" class="text-slate-600 font-light">Poin/Nilai: </label>
                            <input wire:model="pointQuest.{{ $quest->id }}" type="number"
                                class="border w-full block p-2 ms-2  text-gray-600 quest-poin" {{ $quest->poin }}
                                style="width: 80px" placeholder="Poin"
                                wire:keydown="updateQuestion({{ $quest->id }})">

                            <button type="button" class="bg-red-600 text-white h-10 w-10 rounded"
                                wire:click="deleteQuestion({{ $quest->id }})"><i class="bi bi-trash"></i></button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <button type="button" wire:click="addNewQuestion"
            class="block w-full py-2 mt-3 bg-white rounded border hover:bg-slate-100 ease-in"><i
                class="bi bi-patch-plus"></i>
            Tambah
            Pertanyaan</button>
    </div>
    {{-- </form> --}}
</div>

@push('js')
    <script>
        let clearAnswerButtons = document.querySelectorAll('.clearAnswer');

        clearAnswerButtons.forEach(button => {
            button.addEventListener('click', function() {
                setTimeout(() => {
                    location.reload();
                }, 500);
            });
        });

        const inputFields = document.querySelectorAll('.quest-poin');

        inputFields.forEach(input => {
            input.addEventListener('change', (event) => {
                const value = event.target.value.trim();
                const inputValue = parseInt(value);

                if (value === '' || isNaN(inputValue) || inputValue < 0) {
                    event.target.value = 0;
                }
            });
        });


        const radios = document.querySelectorAll('input[type="radio"]');
        radios.forEach(radio => {
            // radio.checked = false;
        });
    </script>
@endpush
