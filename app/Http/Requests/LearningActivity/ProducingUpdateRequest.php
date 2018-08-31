<?php

namespace App\Http\Requests\LearningActivity;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class ProducingUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'datum' => 'required|date|date_in_wplp',
            'omschrijving' => 'required',
            'aantaluren' => 'required',
            'resource' => 'required|in:persoon,alleen,internet,boek,new',
            'moeilijkheid' => 'required|exists:difficulty,difficulty_id',
            'status' => 'required|exists:status,status_id',
            'chain_id' => 'canChain',
        ];
    }

    public function withValidator(Validator $validator): void
    {
        $validator->sometimes('newcat', 'sometimes|max:50', function ($input) {
            return 'new' === $input->category_id;
        });

        $validator->sometimes('category_id', 'required|exists:category,category_id', function ($input) {
            return 'new' !== $input->category_id;
        });

        $validator->sometimes('newswv', 'required|max:50', function ($input) {
            return 'new' === $input->personsource && 'persoon' === $input->resource;
        });

        $validator->sometimes('personsource', 'required|exists:resourceperson,rp_id', function ($input) {
            return 'new' !== $input->personsource && 'persoon' === $input->resource;
        });

        $validator->sometimes('internetsource', 'required|url|max:75', function ($input) {
            return 'internet' === $input->resource;
        });

        $validator->sometimes('booksource', 'required|max:75', function ($input) {
            return 'book' === $input->resource;
        });

        $validator->sometimes('newlerenmet', 'required|max:250', function ($input) {
            return 'new' === $input->resource;
        });

        $validator->sometimes('aantaluren_custom', 'required|numeric', function ($input) {
            return 'x' === $input->aantaluren;
        });
    }
}
