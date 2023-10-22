<?php

namespace ThihaMorph\MyanMap\Trait;

use ThihaMorph\MyanMap\Exception\MyanMapException;
use ThihaMorph\MyanMap\Eloquent\State;
use ThihaMorph\MyanMap\Eloquent\City;
use ThihaMorph\MyanMap\Eloquent\Township;

trait CommandMapTrait
{
    public function create(string $value,string $model,array $subValue = [])
    {
        $value ? $model::firstOrCreate([$value]) : throw new MyanMapException('တန်ဖိုး ထည့်ရပါမည်။');

        $this->createValidationAndSave();
    }

    public function createValidationAndSave($model, $subValue){
            switch ($model) {
                case 'state':
                    if(!$this->areAllIntegers($subValue) && count($subValue) > 0){
                        throw new MyanMapException('Array ထဲတွင် တန်ဖိုးရှိရမည်ဖြစ်ပြီး တန်ဖိုးအားလုံးသည် ကိန်းပြည့်ဖြစ်ရမည်။');
                    }
                    $model->cities()->attach($subValue);
                    break;
                case 'city':
                    if(!$this->areAllIntegers($subValue) && count($subValue) > 0){
                        throw new MyanMapException('Array ထဲတွင် တန်ဖိုးရှိရမည်ဖြစ်ပြီး တန်ဖိုးအားလုံးသည် ကိန်းပြည့်ဖြစ်ရမည်။');
                    }
                    $model->townships()->attach($subValue);
                    break;
                case 'township':
                    break;
                default:
                    throw new MyanMapException('မြို့နယ်တွင် ချိတ်စရာ Array မရှိပါ။');
                    break;
            }
    }

    public function update(string $newValue, string $model,array $subValue = [],int $id)
    {
        $model-findOrFail($id);
        $newValue ? $model::update([$newValue]) : throw new MyanMapException('တန်ဖိုး ထည့်ရပါမည်။');

        $this->updateValidationAndSave();
    }

    public function updateValidationAndSave($model, $subValue){
        switch ($model) {
            case 'state':
                if(!$this->areAllIntegers($subValue) && count($subValue) > 0){
                    throw new MyanMapException('Array ထဲတွင် တန်ဖိုးရှိရမည်ဖြစ်ပြီး တန်ဖိုးအားလုံးသည် ကိန်းပြည့်ဖြစ်ရမည်။');
                }
                $model->cities()->updateExistingPivot($subValue);
                break;
            case 'city':
                if(!$this->areAllIntegers($subValue) && count($subValue) > 0){
                    throw new MyanMapException('Array ထဲတွင် တန်ဖိုးရှိရမည်ဖြစ်ပြီး တန်ဖိုးအားလုံးသည် ကိန်းပြည့်ဖြစ်ရမည်။');
                }
                $model->townships()->updateExistingPivot($subValue);
                break;
            case 'township':
                break;
            default:
                throw new MyanMapException('မြို့နယ်တွင် ချိတ်စရာ Array မရှိပါ။');
                break;
        }
    }

    public function delete(int $id)
    {
        $model-findOrFail($id);
        $model->delete();
    }

    function areAllIntegers($array) {
        foreach ($array as $value) {
            if (!is_int($value)) {
                return false;
            }
        }
        return true;
    }
}

