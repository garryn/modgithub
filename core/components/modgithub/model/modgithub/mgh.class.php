<?php
/**
 * @package modgithub
 */
 
class MGH {
    /**
     * Constructs the MGH object
     *
     * @param modX &$modx A reference to the modX object
     * @param array $config An array of configuration options
     */
    public function __construct(modX &$modx,$config = array()) {
        $this->modx =& $modx;

        $basePath = $this->modx->getOption('mgh.base_path',$config,$this->modx->getOption('core_path').'components/modgithub/');
        $assetsUrl = $this->modx->getOption('mgh.assets_url',$config,$this->modx->getOption('assets_url').'components/modgithub/');
        $this->config = array_merge(array(
            'basePath' => $basePath,
            'corePath' => $basePath,
            'modelPath' => $basePath.'model/',
            'processorsPath' => $basePath.'processors/',
            'chunksPath' => $basePath.'chunks/',
            'jsUrl' => $assetsUrl.'js/',
            'cssUrl' => $assetsUrl.'css/',
            'assetsUrl' => $assetsUrl,
            'connectorUrl' => $assetsUrl.'connector.php',
        ),$config);

        if ($this->modx->getOption('mgh.debug',$this->config,false)) {
            error_reporting(E_ALL);ini_set('display_errors',true);
            $modx->setLogTarget('ECHO');
        }
        
        
        require_once $this->config['modelPath'].'github/lib/phpGitHubApi.php';
        if (class_exists('phpGitHubApi')) {
            $this->api = new phpGitHubApi();
            $this->user = $modx->getOption('mgh.user', null, '');
        } else {
            return 'Failed to bootstrap GitHub API';
        }
    }
    
    public function getRepositories($cache = true, $ttl = 60) {
    	if ($this->user =='') return array();
        $data = $this->modx->cacheManager->get('github/repositories');
        if ($data == null || $cache == false) {
            $data = $this->api->getRepoApi()->getUserRepos($this->user);       
            if ($cache == true) $this->modx->cacheManager->set('github/repositories', $data, $ttl);
        }
        return $data;
    }
    
    public function getCommits($repository, $branch, $cache = true, $ttl = 60) {
    	if ($this->user =='') return array();
        $data = $this->modx->cacheManager->get('github/commits' . '_' . $repository . '_' . $branch);
        if ($data == null || $cache == false) {
            $data = $this->api->getCommitApi()->getBranchCommits($this->user, $repository, $branch);       
            if ($cache == true) $this->modx->cacheManager->set('github/commits' . '_' . $repository . '_' . $branch, $data, $ttl);
        }
        return $data;
    }
    
    /**
     * Gets a Chunk and caches it; also falls back to file-based templates
     * for easier debugging.
     *
     * @access public
     * @param string $name The name of the Chunk
     * @param array $properties The properties for the Chunk
     * @return string The processed content of the Chunk
     */
    public function getChunk($name,$properties = array()) {
        $chunk = null;
        if (!isset($this->chunks[$name])) {
            $chunk = $this->_getTplChunk($name);
            if (empty($chunk)) {
                $chunk = $this->modx->getObject('modChunk',array('name' => $name),true);
                if ($chunk == false) return false;
            }
            $this->chunks[$name] = $chunk->getContent();
        } else {
            $o = $this->chunks[$name];
            $chunk = $this->modx->newObject('modChunk');
            $chunk->setContent($o);
        }
        $chunk->setCacheable(false);
        return $chunk->process($properties);
    }
    
    /**
     * Returns a modChunk object from a template file.
     *
     * @access private
     * @param string $name The name of the Chunk. Will parse to name.chunk.tpl
     * @return modChunk/boolean Returns the modChunk object if found, otherwise
     * false.
     */
    private function _getTplChunk($name) {
        $chunk = false;
        $f = $this->config['chunksPath'].strtolower($name).'.chunk.tpl';
        if (file_exists($f)) {
            $o = file_get_contents($f);
            $chunk = $this->modx->newObject('modChunk');
            $chunk->set('name',$name);
            $chunk->setContent($o);
        }
        return $chunk;
    }   
}