<?php

namespace ThihaMorph\MyanMap\Trait;

use ThihaMorph\MyanMap\Exception\MyanMapException;
use ThihaMorph\MyanMap\Eloquent\State;
use ThihaMorph\MyanMap\Eloquent\City;
use ThihaMorph\MyanMap\Eloquent\Township;

trait CommandMapTrait
{
    public function create(string $value,array $subValue = [])
    {
        $model = get_class($this);

        $value ? $model::firstOrCreate([$value]) : throw new MyanMapException('တန်ဖိုး ထည့်ရပါမည်။');

        $this->createValidationAndSave($model, $subValue);
    }

    public function createValidationAndSave($model, $subValue)
    {
            switch ($model) {
                case State::class:
                    if(!$this->areAllIntegers($subValue) && count($subValue) > 0){
                        throw new MyanMapException('Array ထဲတွင် တန်ဖိုးရှိရမည်ဖြစ်ပြီး တန်ဖိုးအားလုံးသည် ကိန်းပြည့်ဖြစ်ရမည်။');
                    }
                    $model->cities()->attach($subValue);
                    break;
                case City::class:
                    if(!$this->areAllIntegers($subValue) && count($subValue) > 0){
                        throw new MyanMapException('Array ထဲတွင် တန်ဖိုးရှိရမည်ဖြစ်ပြီး တန်ဖိုးအားလုံးသည် ကိန်းပြည့်ဖြစ်ရမည်။');
                    }
                    $model->townships()->attach($subValue);
                    break;
                case Township::class:
                    break;
                default:
                    throw new MyanMapException('မြို့နယ်တွင် ချိတ်စရာ Array မရှိပါ။');
                    break;
            }
    }

    public function update(string $newValue, string $model,array $subValue = [],int $id)
    {
        $model = get_class($this);

        $model-findOrFail($id);
        $newValue ? $model::update([$newValue]) : throw new MyanMapException('တန်ဖိုး ထည့်ရပါမည်။');

        $this->updateValidationAndSave($model, $subValue);
    }

    public function updateValidationAndSave($model, $subValue)
    {
        switch ($model) {
            case State::class:
                if(!$this->areAllIntegers($subValue) && count($subValue) > 0){
                    throw new MyanMapException('Array ထဲတွင် တန်ဖိုးရှိရမည်ဖြစ်ပြီး တန်ဖိုးအားလုံးသည် ကိန်းပြည့်ဖြစ်ရမည်။');
                }
                $model->cities()->updateExistingPivot($subValue);
                break;
            case City::class:
                if(!$this->areAllIntegers($subValue) && count($subValue) > 0){
                    throw new MyanMapException('Array ထဲတွင် တန်ဖိုးရှိရမည်ဖြစ်ပြီး တန်ဖိုးအားလုံးသည် ကိန်းပြည့်ဖြစ်ရမည်။');
                }
                $model->townships()->updateExistingPivot($subValue);
                break;
            case Township::class:
                break;
            default:
                throw new MyanMapException('မြို့နယ်တွင် ချိတ်စရာ Array မရှိပါ။');
                break;
        }
    }

    public function delete(int $id)
    {
        $model = get_class($this);

        $model::findOrFail($id);
        $model->delete();
    }

    function areAllIntegers($array)
    {
        foreach ($array as $value) {
            if (!is_int($value)) {
                return false;
            }
        }
        return true;
    }
}

