<?php

namespace ThihaMorph\MyanMap\Trait;

use ThihaMorph\MyanMap\Exception\MyanMapException;
use ThihaMorph\MyanMap\Eloquent\State;
use ThihaMorph\MyanMap\Eloquent\City;
use ThihaMorph\MyanMap\Eloquent\Township;

trait CommandMapTrait
{
    public function createCommand(string $value,array $subValue = [])
    {
        $model = get_class($this);

        $value ? $model::firstOrCreate(['name' => $value]) : throw new MyanMapException('တန်ဖိုး ထည့်ရပါမည်။');

        $this->createValidationAndSave($model, $subValue);
    }

    public function createValidationAndSave($model, $subValue)
    {
            switch ($model) {
                case State::class:
                    if(count($subValue) > 0 && $this->areAllIntegers($subValue)){
                        $model->cities()->attach($subValue);
                    }
                    break;
                case City::class:
                    if(count($subValue) > 0 && $this->areAllIntegers($subValue)){
                        $model->townships()->attach($subValue);
                    }
                    break;
                case Township::class:
                    if(count($subValue) > 0){
                        throw new MyanMapException('မြို့နယ်တွင် ချိတ်စရာ Array မရှိပါ။');
                    }
                    break;
                default:
                    break;
            }
    }

    public function updateCommand(string $newValue,int $id,array $subValue = [])
    {
        $model = get_class($this);

        $modelValue = $model::findOrFail($id);

        $newValue ? $modelValue->update([['name' => $newValue]]) : throw new MyanMapException('တန်ဖိုး ထည့်ရပါမည်။');

        $this->updateValidationAndSave($model, $subValue);
    }

    public function updateValidationAndSave($model, $subValue)
    {
        switch ($model) {
            case State::class:
                if(count($subValue) > 0 && $this->areAllIntegers($subValue)){
                    $model->cities()->updateExistingPivot($subValue);
                }
                break;
            case City::class:
                if(count($subValue) > 0 && $this->areAllIntegers($subValue)){
                    $model->townships()->updateExistingPivot($subValue);
                }
                break;
            case Township::class:
                if(count($subValue) > 0){
                    throw new MyanMapException('မြို့နယ်တွင် ချိတ်စရာ Array မရှိပါ။');
                }
                break;
            default:
                break;
        }
    }

    public function deleteCommand(int $id)
    {
        $model = get_class($this);

        $modelValue = $model::findOrFail($id);

        $modelValue->delete();
    }

    public function areAllIntegers($array)
    {
        foreach ($array as $value) {
            if (!is_int($value)) {
                return false;
            }
        }
        return true;
    }
}

