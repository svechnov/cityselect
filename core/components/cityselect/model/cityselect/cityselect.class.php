<?php
/**
 * The base class for cityselect.
 */

include_once dirname(__FILE__) . '/SxGeo/SxGeo.php';

class cityselect {
	/* @var modX $modx */
	public $modx;
	/** @var array $config */
	public $config;
	/** @var array $initialized */
	public $initialized = array();
	/**
	 * @param modX $modx
	 * @param array $config
	 */
	function __construct(modX &$modx, array $config = array()) {
		$this->modx =& $modx;

		$corePath = $this->modx->getOption('cityselect_core_path', $config, $this->modx->getOption('core_path') . 'components/cityselect/');
		$assetsUrl = $this->modx->getOption('cityselect_assets_url', $config, $this->modx->getOption('assets_url') . 'components/cityselect/');
		$assetsPath = $this->modx->getOption('cityselect_assets_path', $config, $this->modx->getOption('assets_path') . 'components/cityselect/');
		$this->modx->lexicon->load('cityselect:default');

		$this->config = array_merge([
			'assetsUrl' => $assetsUrl,
			'cssUrl' => $assetsUrl . 'css/',
			'jsUrl' => $assetsUrl . 'js/',


			'corePath' => $corePath,
			'assetsPath' => $assetsPath,

			'modelPath' => $corePath . 'model/',
			'chunksPath' => $corePath . 'elements/chunks/',
			//'templatesPath' => $corePath . 'elements/templates/',

			'snippetsPath' => $corePath . 'elements/snippets/',
			//'processorsPath' => $corePath . 'processors/',

			'frontend_css' => '[[+assetsUrl]]css/default.css',
			'frontend_js' => '[[+assetsUrl]]js/default.js',

			'key' => $this->modx->getOption('cityselect_key', null, 'default'),
			'token' => $this->modx->getOption('cityselect_token', null, 'default'),

		], $config);


	}

///////
	public function initialize($ctx = 'web', $scriptProperties = array()) {
		$this->config = array_merge($this->config, $scriptProperties);
		$this->config['ctx'] = $ctx;
		if (!empty($this->initialized[$ctx])) {
			return true;
		}

		switch ($ctx) {
			case 'mgr': break;
			default:
				if (!defined('MODX_API_MODE') || !MODX_API_MODE) {
					if ($css = trim($this->config['frontend_css'])) {
						if (preg_match('/\.css/i', $css)) {
							$this->modx->regClientCSS(str_replace('[[+assetsUrl]]', $this->config['assetsUrl'], $css));
						}
					}

					$config_js = preg_replace(array('/^\n/', '/\t{6}/'), '', '
						cityConfig = {
							token: "'.$this->config['token'].'"
  							,key: "'.$this->config['key'].'"

						};
					');
					if (file_put_contents($this->config['assetsPath'] . 'js/config.js', $config_js)) {
						$this->modx->regClientStartupScript($this->config['assetsUrl'] . 'js/config.js');
					}
					else {
						$this->modx->regClientStartupScript("<script type=\"text/javascript\">\n".$config_js."\n</script>", true);
					}

					if ($js = trim($this->config['frontend_js'])) {
						if (preg_match('/\.js/i', $js)) {
							$this->modx->regClientScript(preg_replace(array('/^\n/', '/\t{7}/'), '', '
								<script type="text/javascript">
									if(typeof jQuery == "undefined") {
										document.write("<script src=\"'.$this->config['assetsUrl'].'js/lib/jquery.min.js\" type=\"text/javascript\"><\/script>");
									}
								</script>
							'), true);
							$this->modx->regClientScript(str_replace('[[+assetsUrl]]', $this->config['assetsUrl'], $js));
						}
					}
				}
				$this->initialized[$ctx] = true;
				break;
		}

		return true;
	}
//////////


}