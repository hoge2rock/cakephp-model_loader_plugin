<?php
class ModelLoaderBehavior extends ModelBehavior {

	function loadModel(&$model, $modelClass = null, $id = null) {
		if ($modelClass === null) {
			return false;
		}
		$object = null;
		$plugin = null;
		
		list($plugin, $modelClass) = pluginSplit($modelClass, true, $plugin);

		if (!PHP5) {
			$this->{$modelClass} =& ClassRegistry::init(array(
				'class' => $plugin . $modelClass, 'alias' => $modelClass, 'id' => $id
			));
		} else {
			$this->{$modelClass} = ClassRegistry::init(array(
				'class' => $plugin . $modelClass, 'alias' => $modelClass, 'id' => $id
			));
		}

		if (!$this->{$modelClass}) {
			return $this->cakeError('missingModel', array(array(
				'className' => $modelClass, 'webroot' => '', 'base' => $this->base
			)));
		}

		return true;
	}
}