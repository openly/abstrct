<?php 

class AbstrctAppDesc extends AbstrctDataClass
{
	function __construct()
	{
		$this->data = Spyc::YAMLLoad(__DIR__ . '/../../conf/app.yaml');
	}

	function getModelDesc($model){
		ExceptionUtil::notNull($this->models[$model],"Description for Model [$model]",'Load Model Description');
		return $this->models[$model];
	}

	function getModelSchema($model){
		$modelDesc = $this->getModelDesc($model);
		return $modelDesc['fields'];
	}

	function getFormDesc($form){
		ExceptionUtil::notNull($this->forms[$form],"Description for Form [$form]",'Load Form Description');
		$form = &$this->forms[$form];
		if($form['model']){
			$model = $this->getModelDesc($form['model']);
			foreach ($form['fields'] as $field => &$data) {
				ArrayUtil::checkAndMerge($model['fields'][$field],$data);
			}
		}
		return $form;
	}
	function getValidationDesc($validation){
		$validations = $this->validations[$validation];
		if($validations && isset($validations['form'])){
			if(!is_array($validations['rules'])) $validations['rules'] = array();
			$validations['rules'] += $this->getFormValidations($validations['form']);
		}
		else
			$validations = array('rules' => $this->getFormValidations($validation));

		ExceptionUtil::notNull($validations,"Description for Validation [$validation]",'Load Validation Description');
		return $validations;
	}

	function getFormValidations($name){
		if(!isset($this->forms[$name])) return array();
		$form = $this->getFormDesc($name);
		$rules = array();
		foreach ($form['fields'] as $key => $field) {
			if($field['validations']){
				$rules[$key] = $field['validations'];
				$rules[$key]['field-label'] = $field['label'];
			}
		}
		return $rules;
	}

	function getViewDesc($view){
		return $this->views[$view];
	}

	function getDataInterface($name){
		ExceptionUtil::notNull($this->data_interfaces[$name],"Description for Data Interface [$name]",'Load Data Interface Description');
		return $this->data_interfaces[$name];
	}
}