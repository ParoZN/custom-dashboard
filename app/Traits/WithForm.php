<?php 

namespace App\Traits;

use Illuminate\Support\MessageBag;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

trait WithForm
{
    public $model;
    public $data = [];
    public $rules = [];
    public $messages = [];
    public $validationAttributes = [];
    public $successMessage = 'Saved successfully!';
    public $cancelRoute;
    
    public function initializeWithForm()
    {
        logger()->info('Initializing WithForm trait');
        if (empty($this->data)) {
            $this->data = $this->model ? $this->model->toArray() : [];
        }
        $this->rules = $this->getFormRules();
        $this->messages = $this->getFormValidationMessages();
        $this->validationAttributes = $this->getFormValidationAttributes();
        logger()->info('WithForm initialized with:', [
            'data' => $this->data,
            'rules' => $this->rules
        ]);
    }

    public function save()
    {
        logger()->info('WithForm save method called');
        logger()->info('Current data:', $this->data);
        logger()->info('Validation rules:', $this->rules);

        try {
            $validatedData = $this->validate([
                'data' => 'required|array',
                ...collect($this->rules)->mapWithKeys(function($rules, $key) {
                    return ["data.".str_replace('data.', '', $key) => $rules];
                })->toArray()
            ], $this->messages, $this->validationAttributes);
            
            logger()->info('Validation passed:', $validatedData);

            DB::beginTransaction();
            try {
                $modelClass = $this->getModelClass();
                
                if ($this->model && $this->model->exists) {
                    logger()->info('Updating existing model');
                    $updated = $this->model->update($validatedData['data']);
                    logger()->info('Update result:', ['updated' => $updated]);
                } else {
                    logger()->info('Creating new model');
                    $this->model = $modelClass::create($validatedData['data']);
                    logger()->info('Created model:', ['model' => $this->model->toArray()]);
                }
                
                DB::commit();

                session()->flash('success', $this->successMessage);
                logger()->info('Model saved successfully');
                
                return $this->afterSave();
            } catch (\Exception $e) {
                DB::rollBack();
                logger()->error('Database error:', [
                    'message' => $e->getMessage(),
                    'trace' => $e->getTraceAsString(),
                    'data' => $validatedData['data']
                ]);
                session()->flash('error', 'Error saving: ' . $e->getMessage());
                throw $e;
            }
        } catch (\Exception $e) {
            logger()->error('Error in save method:', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            session()->flash('error', 'Error saving: ' . $e->getMessage());
            throw $e;
        }
    }

    public function cancel()
    {
        return redirect()->route($this->cancelRoute);
    }

    protected function getFormRules()
    {
        return [];
    }

    protected function getFormValidationMessages()
    {
        return [];
    }

    protected function getFormValidationAttributes()
    {
        return [];
    }

    protected function afterSave()
    {
        return redirect()->route($this->cancelRoute);
    }

    protected function getModelClass(): string
    {
        throw new \Exception('You must implement getModelClass() in your component.');
    }

    // Helper methods for form fields
    protected function field($name, $type = 'text', $options = [])
    {
        return array_merge([
            'name' => $name,
            'type' => $type,
            'label' => ucwords(str_replace('_', ' ', $name)),
            'placeholder' => 'Enter ' . strtolower(str_replace('_', ' ', $name)),
            'value' => data_get($this->data, $name),
            'required' => false,
            'help' => null,
            'class' => '',
        ], $options);
    }

    protected function select($name, $options, $settings = [])
    {
        return $this->field($name, 'select', array_merge([
            'options' => $options,
            'placeholder' => 'Select ' . strtolower(str_replace('_', ' ', $name)),
        ], $settings));
    }

    protected function textarea($name, $options = [])
    {
        return $this->field($name, 'textarea', array_merge([
            'rows' => 3,
        ], $options));
    }

    protected function checkbox($name, $options = [])
    {
        return $this->field($name, 'checkbox', array_merge([
            'checked' => (bool) data_get($this->data, $name),
        ], $options));
    }

    protected function date($name, $options = [])
    {
        return $this->field($name, 'date', $options);
    }

    protected function file($name, $options = [])
    {
        return $this->field($name, 'file', array_merge([
            'accept' => '*/*',
            'multiple' => false,
        ], $options));
    }
}
